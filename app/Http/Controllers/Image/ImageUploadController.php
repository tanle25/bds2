<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\ThemeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Str;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $watermark = $this->getWatermarkLink();
            $save_path = storage_path('app/public/image_uploads');
            $image_name = Str::random(15) . '.jpg';
            // Check if folder if not exsist
            if (!file_exists($save_path)) {
                mkdir($save_path, 777, true);
            }
            if (!file_exists($save_path . '/thumbs')) {
                mkdir($save_path . '/thumbs', 777, true);
            }
            // Create image and thumb
            $image = Image::make($request->file('file'));
            $thumb = Image::make($request->file('file'))->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // create water mark
            $width = $image->width();
            $water_mark_width = 0.2 * $width;
            $watermark = $this->createWatermark($water_mark_width);
            $watermark_thumb = $this->createWatermark(80);
            if (isset($watermark)) {
                $image->insert($watermark, 'center');
            }
            if (isset($watermark_thumb)) {
                $thumb->insert($watermark_thumb, 'center');
            }
            //save image
            $image->save(storage_path('app/public/image_uploads/' . $image_name));
            $thumb->save(storage_path('app/public/image_uploads/thumbs/' . $image_name));

            return [
                'path' => Storage::url('image_uploads/' . $image_name),
                'storage_path' => 'image_uploads/' . $image_name,
                'thumb' => $this->getThumb('image_uploads/' . $image_name),
            ];
        }
    }

    public function destroy(Request $request)
    {
        Storage::delete('public/' . $request->storage_path);
        Storage::delete('public/' . $this->getThumb($request->storage_path));
    }

    private function getWatermarkLink()
    {
        $image = ThemeOption::get('watermark_logo');
        if ($image) {
            $link = explode(',', $image)[0] ?? null;
            $watermark = Str::replaceFirst('/storage', '', $link);

            return storage_path('app/public' . $watermark);
        }
        return null;
    }

    private function createWatermark($width)
    {
        $link = $this->getWatermarkLink();
        try {
            $watermark = Image::make($link)
                ->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->opacity(90);
            return $watermark;
        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    private function getThumb($string)
    {
        return Str::replaceLast('/', '/thumbs/', $string);
    }
}