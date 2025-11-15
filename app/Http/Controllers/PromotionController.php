<?php
namespace App\Http\Controllers;

use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::available()->orderBy('percent', 'desc')->get();
        return view('promotions.index', compact('promotions'));
    }
}
?>