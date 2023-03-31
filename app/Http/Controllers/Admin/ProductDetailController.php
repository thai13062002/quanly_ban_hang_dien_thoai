<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductDetailRequest;
use App\Models\ProductDetail;
use App\Services\Admin\Product\ProductDetailService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductDetailController extends Controller
{
    protected $productDetailService;
    public function __construct(ProductDetailService $productDetailService)
    {
        $this->productDetailService = $productDetailService;
    }
    public function create($id)
    {
        return view('admin.product.create_detail', $this->productDetailService->getInfoCreateDetail($id));
    }
    public function store(ProductDetailRequest $request)
    {
        $response = $this->productDetailService->createDetail($request);
        if ($response['success']) {
            return view('admin.product.component.item_detail', $response['data']);
        } else throw ValidationException::withMessages(['Thất bại']);
    }
    public function update(ProductDetailRequest $request)
    {
        return $this->productDetailService->updateProductDetail($request);
    }
    public function delete(Request $request)
    {
        return $this->productDetailService->deleteProductDetail($request->id);
    }
    public function listProductDetail($id)
    {
        // dd(ProductDetail::with('Color', 'ColorDetail')->where('product_id', $id)->get()->toArray());
        return view('admin.product.component.list-detail', ['listDetail' => ProductDetail::with('Color', 'ColorDetail', 'Img')->where('product_id', $id)->get()->toArray(), 'idProduct' => $id]);
    }
    public function deleteImg(Request $request)
    {
        // return $request->all();
        return $this->productDetailService->deleteImg($request, 'ProductDetail');
    }
    public function productDetail($id)
    {
        // dd(ProductDetail::with('Img')->where('id', $id)->first()->toArray());
        return view('admin.product.component.item_update_detail_product', ['porductDetail' => ProductDetail::with('Img')->where('id', $id)->first()->toArray()]);
    }
}
