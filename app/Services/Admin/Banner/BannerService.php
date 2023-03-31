<?php

namespace App\Services\Admin\Banner;

use Throwable;
use App\Models\Image;
use App\Models\Banner;
use App\Enums\TypeImgEnum;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class BannerService.
 */
class BannerService extends BaseService
{
    /**
     * BannerService constructor.
     *
     * @param  Banner  $banner
     */

    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }
    /**
     * @param  Request  $request
     * lấy dữ liệu tất cả banner
     * @return  array 
     */
    public function get_all($request)
    {
        $keyword = "";
        if ($request->input('search')) {
            $keyword = $request->input('search');
        }
        $bannersWithImages = DB::table('banners')
            ->join('images', 'banners.id', '=', 'images.object_id')
            ->select('banners.*', 'images.path', 'images.type')
            ->where('images.type', TypeImgEnum::BANNER_IMG)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->distinct()
            ->latest()->paginate(10);

        return $bannersWithImages;
    }
    /**
     * @param  Request  $request
     * Tạo banner
     * @return  true, false
     */
    public function create($request)
    {
        try {
            DB::beginTransaction();
            $banner = $this->model->create([
                'name' => $request->name,
                'link' => $request->link
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Banner');
                $file->move($location, $filename);
                Image::create([
                    'path' => $filename,
                    'object_id' => $banner->id,
                    'type' => TypeImgEnum::BANNER_IMG,
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
                'error' => $e
            ];
        }
    }
    /**
     * @param  Request  $request
     * lấy dữ liệu banner theo id
     * @return collection 
     */
    public function get_banner($id)
    {
        $result =  $this->model->with('Img')->findOrFail($id);
        return $result;
    }
    /**
     * @param  Request  $request, $id
     * Cập nhật banner
     * @return  true, false
     */
    public function update($id, $request)
    {
        try {
            DB::beginTransaction();
            $this->model->find($id)->update([
                'name' => $request->name,
                'link' => $request->link,
            ]);
            $data =  $this->model->with('Img')->findOrFail($id);
            $path_old = $data->img[0]->path;
            if ($request->hasFile('file')) {
                deleteImgFromFile('Banner' . "\\" . $path_old);
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = storage_path('app/public/Banner');
                $file->move($location, $filename);
            } else {
                $filename = $path_old;
            }
            $image = Image::where('object_id', $id)->where('type', TypeImgEnum::BANNER_IMG)->first();
            $image->update([
                'path' => $filename,
                'type' => TypeImgEnum::BANNER_IMG,
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
     * @param $id
     * Xoá banner
     * @return  true, false
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data =  $this->model->with('Img')->find($id);
            $data->delete();
            $path_img = $data->img[0]->path;
            deleteImgFromFile('Banner' . "\\" . $path_img);
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
