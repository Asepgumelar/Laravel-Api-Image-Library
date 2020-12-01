<?php

namespace App\Libraries;

use App\Models\Image;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImgResize;

class ImageLibrary
{
    public function save($file)
    {
        $path = storage_path('tmp\uploads\image');
        $resize = $this->resize($file, 128, 128);

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (Exception $e) {
            die('Failed to create folders...');
        }

        $file         = $file;
        $originalName = $file->getClientOriginalName();
        $name         = uniqid() . '_' . trim($originalName);
        $ext          = $file->getClientOriginalExtension();
        $url          = $path . '/' . $name;

        $file->move($path, $name);

        $data                = new Image();
        $data->name          = $name;
        $data->original_name = $originalName;
        $data->extension     = $ext;
        $data->path          = $path;
        $data->image_url     = $url;
        $data->data_type     = 'original';
        $data->save();

        return $data->id;
    }

    public function delete($driver, Image $model)
    {
        Storage::disk($driver)->delete($model->image_url);
    }

    public function resize($raw, $standardWidth = 750, $standardHeight = 410)
    {
        $image = ImgResize::make($raw);
        $image = $image->resize($standardWidth, $standardHeight);
        return $image;
    }
}
