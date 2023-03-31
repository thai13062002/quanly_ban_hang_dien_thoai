<?php

namespace App\Services\User\Product;

use App\Models\ColorProductDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Services\BaseService;


/**
 * Class ProductService.
 */
class ProductService extends BaseService
{
    /**
     * ProductService constructor.
     *
     * @param  Product  $user
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @param  Request  $request
     * lấy dữ liệu sản phẩm
     * @return  array
     */
    public function getListProduct($request)
    {
        // dd($request->all());

        $lisProduct = Product::where('status', '1')->with('Brand', 'Img', 'Category', 'ProductDetail')->whereHas('ProductDetail');
        if ($request->input('categories'))
            $lisProduct->where('cat_id', $request->input('categories'));
        if ($request->input('brands')) {
            $brands = explode('-', $request->input('brands'));
            $lisProduct->whereIn('brand_id', $brands);
        }
        return $lisProduct->get()->toArray();
    }

    /**
     * @param  Request  $request
     * lấy dữ liệu chi tiết sản phẩm
     * @return  array
     */
    public function getDetailProduct($request)
    {
        return [
            'product' => Product::with('Brand', 'Img', 'Category', 'ProductDetail')->where('id', $request->id)->first()->toArray(),
            'capcityId' => $request->capcityId ?? 0,
            'colorId' => $request->input('colorId') ? $request->input('colorId') : 0
        ];
    }
}
