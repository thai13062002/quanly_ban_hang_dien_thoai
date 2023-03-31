<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\ColorProductDetail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Product\ProductRequest;
use App\Services\Admin\Product\ProductService;
use App\Http\Requests\Product\ProductDetailRequest;
use App\Http\Requests\Product\ColorProductDetailRequest;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        return view('admin.product.index', ['listProduct' => $this->productService->getListProduct($request)]);
    }
    public function create()
    {
        return view('admin.product.create', $this->productService->getDataCreate());
    }
    public function store(ProductRequest $request)
    {
        $response = $this->productService->create($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thêm sản phẩm thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Thêm sản phẩm thành công');
            return redirect()->route('admin.product.create_detail', ['id' => $response['data']]);
        }
    }

    public function edit($id)
    {
        // dd(Product::where('id', $id)->with('Img')->first()->toArray());
        return view('admin.product.edit', $this->productService->getInfoEdit($id));
    }
    public function update(ProductRequest $request)
    {
        $response = $this->productService->updateProduct($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Cập nhật sản phẩm thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Cập nhật sản phẩm thành công');
            return redirect()->route('admin.product.create_detail', ['id' => $response['data']]);
        }
    }
    public function deleteProduct(Request $request)
    {
        $response = $this->productService->deleteProduct($request->id);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Xoá sản phẩm thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Xoá sản phẩm thành công');
            return redirect()->back();
        }
    }
    public function changeStatus(Request $request)
    {
        return $this->productService->changeStatus($request);
    }
    public function changeOutstanding(Request $request)
    {
        return $this->productService->changeOutstanding($request);
    }
}
