<?php

namespace App\Services\Admin\Brand;

use Throwable;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Enums\TypeImgEnum;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\Admin\Product\ProductService;

/**
 * Class BrandService.
 */
class BrandService extends BaseService
{
    /**
     * BrandService constructor.
     *
     * @param  Brand  $brand
     */
    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }
    /**
     * @param  Request  $request
     * Tạo brand
     * @return  true, false
     */
    public function create($request)
    {

        try {
            DB::beginTransaction();
            $brand =  Brand::create([
                'name' => $request->name
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Brand');
                $file->move($location, $filename);
                Image::create([
                    'path' => $filename,
                    'object_id' => $brand->id,
                    'type' => TypeImgEnum::BRAND_IMG
                ]);
            }
            DB::commit();
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => [
                    $e
                ]
            ];
        }
    }
    /**
     * @param  Request  $request
     * Lấy dữ liệu tất cả banner
     * @return  array
     */
    public function getBrandWithImage($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $brandsWithImages = DB::table('brands')
            ->join('images', 'brands.id', '=', 'images.object_id')
            ->select('brands.*', 'images.path', 'images.type')
            ->where('images.type', TypeImgEnum::BRAND_IMG)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->distinct()
            ->latest()->paginate(10);

        return $brandsWithImages;
    }
    /**
     * @param  id
     * Lấy dữ liệu 1 banner
     * @return  collection
     */
    public function getBrand($id)
    {
        $result =  $this->model->with('Img')->findOrFail($id);
        return $result;
    }
    /**
     * @param  Request, $request, id
     * Cập nhật banner
     * @return  true,false
     */
    public function update($id, $request)
    {
        try {
            DB::beginTransaction();
            Brand::where('id', $id)->update([
                'name' => $request->name
            ]);
            $data =  $this->model->with('Img')->find($id);
            $path_old = $data->img[0]->path;
            if ($request->hasFile('file')) {
                deleteImgFromFile('Brand' . "\\" . $path_old);
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Brand');
                $file->move($location, $filename);
            } else {
                $filename = $path_old;
            }
            $image = Image::where('object_id', $id)->where('type', TypeImgEnum::BRAND_IMG)->first();
            $image->update([
                'path' => $filename,
                'type' => TypeImgEnum::BRAND_IMG
            ]);
            DB::commit();
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
    /**
     * @param   id
     * Cập nhật banner
     * @return  true,false
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data =  $this->model->with('Img')->findOrFail($id);

            $listProduct = Product::where('brand_id',  $id)->select('id')->get()->toArray();
            $productService = new ProductService(new Product());
            foreach ($listProduct as $item) {
                $productService->deleteProduct($item);
            }
            $data->delete();
            $path_img = $data->img[0]->path;
            deleteImgFromFile('Brand' . "\\" . $path_img);
            $data->img[0]->delete();
            DB::commit();
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}
