<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ColorProductDetailRequest;
use App\Models\ColorProductDetail;
use App\Services\Admin\Product\ColorProductDetailService;
use Illuminate\Http\Request;

class ColorProductDetailController extends Controller
{
    protected $colorProductDetailService;
    public function __construct(ColorProductDetailService $colorProductDetailService)
    {
        $this->colorProductDetailService = $colorProductDetailService;
    }
    public function create(ColorProductDetailRequest $request)
    {
        return $this->colorProductDetailService->createProductColor($request);
    }
    public function delete(Request $request)
    {
        return $this->colorProductDetailService->deleteColorProduct($request);
    }
    public function update(Request $request)
    {
        return $this->colorProductDetailService->updateColorProduct($request);
    }
    public function listColorProduct($id)
    {
        // dd(ColorProductDetail::with('Color')->get()->toArray());
        return view('admin.product.component.item_color_product_detail', ['listColor' => ColorProductDetail::with('Color', 'Img')->where('product_id', $id)->get()->toArray()]);
    }
}
