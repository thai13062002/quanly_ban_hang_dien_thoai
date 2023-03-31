<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Brand\BrandRequest;
use App\Services\Admin\Brand\BrandService;

class BrandController extends Controller
{
    //
    protected $brandService;
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    public function index(Request $request)
    {
        $list_brands = $this->brandService->getBrandWithImage($request);
        return view('admin/brand/index', compact('list_brands'));
    }
    public function add()
    {
        return view('admin/brand/create');
    }
    public function store(BrandRequest $request)
    {
        $response = $this->brandService->create($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thêm thương hiệu thất bại');
            return redirect()->back();
        } else {
            return redirect('admin/brand');
        }
    }
    public function edit($id)
    {
        $brand = $this->brandService->getBrand($id);
        return view('admin/brand/edit', compact('brand'));
    }
    public function update(BrandRequest $request, $id)
    {
        $response = $this->brandService->update($id, $request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Cập nhật thương hiệu thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Cập nhật thương hiệu thành công');
            return redirect()->route('admin.brand.index');
        }
    }
    public function destroy($id)
    {
        $response =  $this->brandService->delete($id);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Cập nhật thương hiệu thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Cập nhật thương hiệu thành công');
            return redirect()->route('admin.brand.index');
        }
    }
}
