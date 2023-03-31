<?php

namespace App\Services\Admin\Product;

use App\Enums\TypeImgEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProductDetail;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Throwable;

use function PHPUnit\Framework\returnSelf;

/**
 * Class ProductService.
 */
class ProductService extends BaseService
{
    /**
     * ProductService constructor.
     *
     * @param array
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @param  Request  $request
     * Lấy danh sách sản phẩm
     *  @returna array
     */
    public function getListProduct($request)
    {
        // dd(Product::with('Brand', 'Img', 'Category', 'ProductDetail')->get()->toArray());
        $searchName = $request->input('search') ? $request->input('search') : '';
        return $this->model->with('Brand', 'Img', 'Category')->where('name', 'like', '%' . $searchName . '%')->paginate(6);
    }

    /**
     *
     * Lấy dữ liệu cho việc thêm sản phẩm
     * @return  array
     */
    public function getDataCreate()
    {
        $listParent = Category::where('parent_id', '!=', 0)->select('parent_id')->distinct()->get()->toArray();
        $categories = Category::whereNotIn('id', $listParent)->where('parent_id', 0)->get()->toArray();
        return ['brands' => Brand::get()->toArray(), 'categories' => $categories];
    }


    /**
     * @param  int  $id
     * Lấy dữ liệu để cập nhật sản phẩm
     * @return  array
     */
    public function getInfoEdit($id)
    {
        return  [
            'brands' => Brand::get()->toArray(), 'categories' => Category::get()->toArray(),
            'product' => $this->model->where('id', $id)->with('Img')->first()->toArray()
        ];
    }

    /**
     * @param  Request  $request
     * Lưu sản phẩm đã thêm
     * @return  array
     */
    public function create($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token', 'img', 'is_selling', 'is_outstanding', 'status');
            $data['is_selling'] = !empty($request->input('is_selling')) ? 1 : 0;
            $data['is_outstanding'] = !empty($request->input('is_outstanding')) ? 1 : 0;
            $data['status'] = !empty($request->input('status')) ? '1' : '0';
            $data['slug'] = str_replace(" ", "-", $data['name']);
            // dd($request->file('img'));
            $product = $this->model->create($data);
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = storage_path('app/public/Product');
            $file->move($location, $filename);
            Image::create([
                'object_id' => $product->id,
                'path' => $filename,
                'type' => TypeImgEnum::PRODUCT_IMG,
            ]);
            DB::commit();
            return ['success' => true, 'data' => $product->id]; //;redirect()->route('admin.product.create_detail', ['id' => $product->id]);
        } catch (Throwable $e) {
            DB::rollBack();
            // dd($e);
            return ['success' => false, 'error' => $e]; // redirect()->back()->withErrors(['msg' => 'Tạo thất bại']);
        }
    }













    /**
     * @param  Request  $request
     * Cập nhật thông tin sản phẩm
     *
     */
    public function updateProduct($request)
    {
        try {
            DB::beginTransaction();
            $data = $request;
            $data['is_selling'] = !empty($request->input('is_selling')) ? 1 : 0;
            $data['is_outstanding'] = !empty($request->input('is_outstanding')) ? 1 : 0;
            $data['status'] = !empty($request->input('status')) ? '1' : '0';
            $data['slug'] = str_replace(" ", "-", $data['name']);
            $product = $this->model->where('id', $request->id)->first();
            $product->update($data);
            if (!empty($request->file('img'))) {
                $oldImg = Image::where('object_id', $product->id)->where('type', TypeImgEnum::PRODUCT_IMG)->first(); //->delete();
                deleteImgFromFile('product' . "\\" . $oldImg->path);
                $oldImg->delete();
                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Product');
                $file->move($location, $filename);
                Image::create([
                    'object_id' => $product->id,
                    'path' => $filename,
                    'type' => TypeImgEnum::PRODUCT_IMG,
                ]);
            }
            DB::commit();
            return ['success' => true, 'data' => $product->id]; // redirect()->route('admin.product.create_detail', ['id' => $product->id]);
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => $e]; //redirect()->back()->withErrors(['msg' => 'Tạo thất bại']);
        }
    }



    /**
     * @param  int  $id
     * Xóa sản phẩm
     * @return array
     */
    public function deleteProduct($id)
    {
        try {
            DB::beginTransaction();
            $imgProduct = Image::where('object_id', $id)->where('type', TypeImgEnum::PRODUCT_IMG)->first(); //->delete();
            deleteImgFromFile('product' . "\\" . $imgProduct->path);
            $imgProduct->delete();
            $listProductDetail = ProductDetail::where('product_id', $id)->get();
            $productDetail = new ProductDetailService(new ProductDetail());
            foreach ($listProductDetail as $item) {
                $productDetail->deleteProductDetail($item->id);
            }
            Product::where('id', $id)->delete();
            DB::commit();
            return ['success' => true]; //redirect()->back()->with(['success' => "Xóa Thành công"]);
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => $e]; //redirect()->back()->withErrors(['error' => "Xóa thất bại"]);
        }
    }

    /**
     * @param  Request  $request
     * Thay đổi trạng thái sản phẩm
     * @return  array
     */
    public function changeStatus($request)
    {
        try {
            $this->model->where('id', $request->input('product_id'))->update(['status' => $request->input('status') ? '1' : '0']);
            return ['success' => true];
        } catch (Throwable $e) {
            DB::rollBack();
            return  ['success' => false, 'error' => $e];
        }
    }

    public function changeOutstanding($request)
    {
        try {
            $this->model->where('id', $request->input('product_id'))->update(['is_outstanding' => $request->input('is_outstanding')]);
            return ['success' => true];
        } catch (Throwable $e) {
            DB::rollBack();
            return  ['success' => false, 'error' => $e];
        }
    }
}
