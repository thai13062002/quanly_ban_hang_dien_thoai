<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Services\User\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        return view('user.product.index', ['categories' => Category::get()->toArray(), 'brands' => Brand::get()->toArray()]);
    }
    public function listProduct(Request $request)
    {
        return $this->productService->getListProduct($request);
    }
    public function productDetail(Request $request)
    {
        return view('user.product.detail', $this->productService->getDetailProduct($request));
    }
}
