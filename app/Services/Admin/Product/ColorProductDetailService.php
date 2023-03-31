<?php

namespace App\Services\Admin\Product;

use App\Enums\TypeImgEnum;
use App\Models\Color;
use App\Models\ColorProductDetail;
use App\Models\Image;
use App\Models\ProductDetail;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Throwable;

use function PHPUnit\Framework\returnSelf;

/**
 * Class ProductService.
 */
class ColorProductDetailService extends BaseService
{
    /**
     * ProductService constructor.
     *
     * @param  ColorProductDetail  $user
     */
    public function __construct(ColorProductDetail $colorProductDetail)
    {
        $this->model = $colorProductDetail;
    }
    /**
     * @param  Request  $request
     * Lưu màu sản phẩm
     * @return  response json
     */
    public function createProductColor($request)
    {
        try {
            DB::beginTransaction();
            $this->model->create($request->except('_token', 'img'));
            // foreach ($request->file('photo') as $item) {
            //     $filename = time() . '_' . $item->getClientOriginalName();
            //     $location = storage_path('app/public/ProductDetailColor');
            //     $item->move($location, $filename);
            //     Image::create([
            //         'object_id' => $productDetail->id,
            //         'path' => $filename,
            //         'type' => TypeImgEnum::COLORPRODUCTDETAIL_IMG,
            //     ]);
            // }
            DB::commit();
            return ['success' => true, 'message' => 'thành công'];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => $e];
        }
    }
    /**
     * @param  Request  $request
     * Xóa chi tiết màu sản phẩm
     * @return  array
     */
    public function deleteColorProduct($request)
    {
        try {
            DB::beginTransaction();
            $colorProductDetail = $this->model->where('product_id', $request->product_id)->where('color_id', $request->color_id)->first();
            $quantity = $colorProductDetail->quantity;
            $colorProductDetail->delete();
            // $listImg = Image::where('object_id', $productColorDetail->id)->where('type', TypeImgEnum::COLORPRODUCTDETAIL_IMG);
            // foreach ($listImg as $item) {
            //     $image_path = public_path() . '\storage\ProductDetailColor' . "\\" . $item->path;
            //     if (file_exists($image_path))
            //         unlink($image_path);
            // }
            // $productColorDetail->delete();
            DB::commit();
            return ['success' => true, 'message' => 'Thành công'];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }
    /**
     * @param  Request  $request
     * cập nhật số lương sản phẩm theo màu
     * @return  array
     */
    public function updateColorProduct($request)
    {
        try {
            $this->model->where('product_id', $request->product_id)
                ->where('color_id', $request->color_id)->update(['quantity' => $request->quantity]);
            $quantity = $this->model->where('product_id', $request->product_id)->get()->sum('quantity');
            return ['success' => true, 'message' => 'Thành công', 'data' => $quantity];
        } catch (Throwable $e) {
            return $e;
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }
}
