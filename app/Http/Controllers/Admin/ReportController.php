<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function revenue(Request $request)
    {
        $groupBy = $request->get('group_by', 'day'); // 'day' | 'month'
        if (!in_array($groupBy, ['day', 'month'], true)) {
            $groupBy = 'day';
        }

        $allowedStatuses = ['completed'];
        $statuses = $request->get('statuses');
        if (is_string($statuses)) {
            $statuses = [$statuses];
        }
        if (!is_array($statuses) || empty($statuses)) {
            $statuses = ['completed'];
        }
        // Chỉ tính doanh thu đơn đã hoàn tất
        $statuses = array_values(array_intersect($statuses, $allowedStatuses));
        if (empty($statuses)) {
            $statuses = ['completed'];
        }

        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $to = $dateTo ? Carbon::parse($dateTo)->endOfDay() : Carbon::today()->endOfDay();
        $from = $dateFrom ? Carbon::parse($dateFrom)->startOfDay() : (clone $to)->subDays(29)->startOfDay();

        $base = Order::query()
            ->whereIn('status', $statuses)
            ->whereBetween('created_at', [$from, $to]);

        $totalRevenue = (clone $base)->sum('total_amount');
        $totalOrders = (clone $base)->count();
        $avgOrderValue = $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0;

        if ($groupBy === 'month') {
            $rows = (clone $base)
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-01') as period")
                ->selectRaw('SUM(total_amount) as revenue')
                ->selectRaw('COUNT(*) as orders')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-01')"))
                ->orderBy('period')
                ->get();
        } else {
            $rows = (clone $base)
                ->selectRaw('DATE(created_at) as period')
                ->selectRaw('SUM(total_amount) as revenue')
                ->selectRaw('COUNT(*) as orders')
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('period')
                ->get();
        }

        return view('admin.reports.revenue', [
            'rows' => $rows,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'avgOrderValue' => $avgOrderValue,
            'filters' => [
                'group_by' => $groupBy,
                'statuses' => $statuses,
                'date_from' => $from->toDateString(),
                'date_to' => $to->toDateString(),
            ],
        ]);
    }
}
