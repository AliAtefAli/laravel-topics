<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;


trait Uploadable
{
    public function uploadOne($file, $domain, $aspect = false, $width = null, $height = null)
    {
        /**
         * بشوف هل اللي مبعوت دا صورة فعلا ولا string زي عشان واحنا ال scope عند ال Seeder
         */
        if (!is_file($file)) {
            return $file;
        }
        /**
         * بشوف هل دي صورة ولا ملف ولو صورة اقدر اعملها resize واشتغل عليها
         */
        if ($this->isAvailableImage($file)) {
            return $this->uploadImage($file, $domain, $aspect , $width , $height );
        }

        return $this->uploadFile($file, $domain);
    }

    /**
     * لو عندي request عبارة عن array of images or files برفعهم مرة واحدة
     */
    public function uploadMulti($request, $object)
    {
        foreach ($request->files as $file) {
            if ($this->isAvailableImage($file)) {
                $type = 'image';
                $path = $this->uploadImage($file, $domain = 'documents', $aspect = false, $width = null, $height = null);
            } else {
                $path = $this->uploadFile($file, $domain = 'documents');
            }

            $object->documents()->create([
                'type' => ($type) ? $type : $this->getExtention($file),
                'path' => $path
            ]);
        }
    }

    public function uploadBase64($image, $domain): string
    {
        return $this->uploadImage($image, $domain, $aspect = false, $width = null, $height = null);
    }

    private function uploadImage($file, $domain, $aspect = false, $width = null, $height = null)
    {
        $directory = public_path('assets/uploads/' . $domain);
        $this->createDirectoryIfNotExists($directory);

        $image = Image::make($file);

        if ($aspect && $width != null && $height != null) {
            $image->resize($width, $height);
            // resize only the width of the image with no aspect
        } elseif ($aspect && $width != null) {
            $image->resize($width, null);
            // resize only the height of the image with no aspect
        } elseif (!$aspect && $width != null) {
            $image->resize(null, $height);

            // resize the image to a *fixed width* && constrain aspect ratio (auto height)
        } elseif ($aspect && $width != null) {
            $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // resize the image to a *fixed height* && constrain aspect ratio (auto height)
        } elseif ($aspect && $height != null) {
            $image->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $path = Uuid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();
        $image->save($directory . '/' . $path, 80);

        return $path;
    }

    public function uploadFile($file, $domain)
    {
        $directory = public_path('assets/uploads/' . $domain);
        $this->createDirectoryIfNotExists($directory);
        $path = Uuid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();

        $file->move($directory, $path);

        return $path;
    }

    private function isAvailableImage($file)
    {
        /**
         * دول ال supported images formates من ال documentation بتاع intervention
         * http://image.intervention.io/getting_started/formats
         */
        $image_Formats = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

        return in_array(strtolower($file->getClientOriginalExtension()), $image_Formats);
    }

    private function getExtention($file)
    {
        return strtolower($file->getClientOriginalExtension());
    }

    private function createDirectoryIfNotExists($directory)
    {
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0777, true, true);
        }
    }

}
