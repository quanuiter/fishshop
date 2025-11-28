<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatchLog;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CatchLogController extends Controller
{
    // Hiển thị trang Tin tức (kiêm Nhật ký cần thủ)
    public function index()
    {
        // Lấy danh sách bài đăng mới nhất, kèm thông tin user và sản phẩm tag
        $logs = CatchLog::with(['user', 'products'])->latest()->paginate(10);

        // Lấy danh sách sản phẩm để user chọn khi đăng bài (cho vào dropdown)
        $products = Product::select('id', 'name')->get();

        return view('tintuc', compact('logs', 'products'));
    }

    // Xử lý đăng bài mới
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Tối đa 2MB
            'caption' => 'required|string|max:500',
            'product_ids' => 'nullable|array', // Mảng ID sản phẩm được tag
            'product_ids.*' => 'exists:products,id',
        ]);

        // Upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Lưu vào public/uploads/catchlogs
            $file->move(public_path('uploads/catchlogs'), $filename);
            $imagePath = 'uploads/catchlogs/' . $filename;
        }

        // Tạo bài đăng
        $log = CatchLog::create([
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'caption' => $request->input('caption'),
        ]);

        // Gắn tag sản phẩm (nếu có)
        if ($request->has('product_ids')) {
            $log->products()->attach($request->product_ids);
        }

        return redirect()->route('tintuc')->with('success', 'Đã khoe chiến tích thành công!');
    }
    public function destroy($id)
    {
        $log = CatchLog::findOrFail($id);

        // Kiểm tra quyền sở hữu
        if ($log->user_id !== auth()->id()) {
            abort(403);
        }

        // Xóa ảnh nếu cần
        if (file_exists(public_path($log->image))) {
            unlink(public_path($log->image));
        }

        $log->delete();

        return redirect()->route('tintuc')->with('success', 'Đã xóa bài viết thành công');
    }
}