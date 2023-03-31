<?php

namespace App\Services\Admin\Category;

use Throwable;
use App\Models\Product;
use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\Product\ProductService;

/**
 * Class CategoryService.
 */
class CategoryService extends BaseService
{
    /**
     * CategoryService constructor.
     *
     * @param  Category  $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
    /**
     * @param Request ,$request
     * Lấy tất cả danh mục, tìm kiếm
     * @return  array
     */
    public function get_all($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $categories = $this->model
            ->where('name', 'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);
        return $categories;
    }
    /**
     * @param Request ,$request
     * Tạo danh mục
     * @return true
     */
    public function create($request)
    {
        try {
            DB::beginTransaction();
            $this->model->create([
                'name' => $request->name,
                'parent_id' => $request->cat_id
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
     * @param Request ,$request
     * Cạp danh mục
     * @return true, flase
     */
    public function update($id, $request)
    {
        try {

            DB::beginTransaction();
            $category = $this->model->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->cat_id
            ]);
            return [
                'success' => true,
            ];
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
    /**
     * @param id
     * Xoá danh mục, xoá các sản phẩm liên quan đến danh mục
     * @return true false
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $category = $this->model->find($id);
            $listProduct = Product::where('cat_id',  $id)->select('id')->get()->toArray();
            $productService = new ProductService(new Product());
            foreach ($listProduct as $item) {
                $productService->deleteProduct($item);
            }
            $category->delete();
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
