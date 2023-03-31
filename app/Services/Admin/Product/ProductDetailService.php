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
class ProductDetailService extends BaseService
{
    /**
     * ProductService constructor.
     *
     * @param  ProductDetail  $user
     */
    public function __construct(ProductDetail $productdetail)
    {
        $this->model = $productdetail;
    }
    /**
     *  @param  int  $id
     * Lấy dữ liệu để thêm chi tiết sản phẩm
     * @return  array
     */
    public function getInfoCreateDetail($id)
    {
        return  [
            'id' => $id,
            'listDetail' => $this->model->with('ProductDetailColor')->where('product_id', $id)->get()->toArray(),
            'colors' => Color::get()->toArray()
        ];
    }
    /**
     * @param  Request  $request
     * Lưu chi tiết sản phẩm cần thêm
     * @return  array
     */
    public function createDetail($request)
    {
        try {
            DB::beginTransaction();
            $productDetail = $this->model->create($request->except('_token', 'img'));
            $img = [];
            foreach ($request->file('img') as $item) {
                $filename = time() . '_' . $item->getClientOriginalName();
                $location = storage_path('app/public/ProductDetail');
                $item->move($location, $filename);
                Image::create([
                    'object_id' => $productDetail->id,
                    'path' => $filename,
                    'type' => TypeImgEnum::PRODUCTDETAIL_IMG,
                ]);
                $img[] = $filename;
            }
            DB::commit();
            return ['success' => true, 'data' => ['productDetail' => $productDetail->toArray(), 'quantity' => 0]]; // view('admin.product.component.item_detail',);
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => $e];
        }
    }

    /**
     * @param  Request  $request
     * Cập nhật chi tiết sản phẩm (cập nhật dung lượng,giá)
     * @return  array
     */
    public function updateProductDetail($request)
    {
        try {
            DB::beginTransaction();
            $productDetail = $this->model->where('id', $request->id)->first();
            $productDetail->update($request->except('_token', 'img', 'id'));
            if (!empty($request->file('img'))) {
                foreach ($request->file('img') as $item) {
                    $filename = time() . '_' . $item->getClientOriginalName();
                    $location = storage_path('app/public/ProductDetail');
                    $item->move($location, $filename);
                    Image::create([
                        'object_id' => $productDetail->id,
                        'path' => $filename,
                        'type' => TypeImgEnum::PRODUCTDETAIL_IMG,
                    ]);
                }
            }
            DB::commit();
            return ['success' => true, 'message' => 'thành công'];
        } catch (Throwable $e) {
            DB::rollBack();
            // return $e;
            return ['success' => true, 'error' => 'Thất bại'];
        }
    }

    /**
     * @param  int  $id
     * Xóa chi tiết sản phẩm (theo dung lượng,màu ...)
     * @return  response json
     */
    public function deleteProductDetail($id)
    {
        try {
            DB::beginTransaction();
            $listImg = Image::where('object_id', $id)->where('type', TypeImgEnum::PRODUCTDETAIL_IMG); //->delete();
            foreach ($listImg->get() as $item) {
                deleteImgFromFile('ProductDetail' . "\\" . $item->path);
            }
            $listImg->delete();
            $listColorProduct = ColorProductDetail::where('product_id', $id);
            // $listIdColorProductdetail = $listColorProduct->select('id')->get()->toArray();
            // $listImgColor = Image::whereIn('object_id', $listIdColorProductdetail)->where('type', TypeImgEnum::COLORPRODUCTDETAIL_IMG);
            // foreach ($listImgColor->get() as $item) {
            //     // return 'ProductDetail' . "\\" . $item->path;
            //     deleteImgFromFile('ProductDetailColor' . "\\" . $item->path);
            // }
            // $listImgColor->delete();
            $listColorProduct->delete();
            $this->model->where('id', $id)->delete();
            DB::commit();
            return ['success' => true, 'message' => 'thành công'];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }

    /**
     * @param  Request  $request,String $folderName
     * Xóa ảnh sản phẩm
     * @return  response json
     */
    public function deleteImg($request, $folderName)
    {
        try {
            $img = Image::where('id', $request->id)->first();
            deleteImgFromFile($folderName . "\\" . $img->path);
            $img->delete();
            return ['success' => true, 'message' => 'thành công'];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }
}
