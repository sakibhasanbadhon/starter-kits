<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

/**
 * Trait UploadAble
 * @package App\Traits
 */
trait UploadAble
{
    /**
     * Generate an SEO-friendly filename.
     *
     * @param $originalName
     * @param $fileName
     */
    private function generateSeoFilename($originalName, $fileName = null)
    {
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $originalExtension = pathinfo($originalName, PATHINFO_EXTENSION);
        $extension = in_array($originalExtension, ['jpg', 'jpeg', 'png', 'gif']) ? 'webp' : $originalExtension;

        return !is_null($fileName) ?
            Str::slug($fileName, '-') . '.' . $extension :
            Str::slug($name, '-') . '-' . time() . '.' . $extension;
    }

    /**
     * Upload a file return its path.
     *
     * @param $file
     * @param $folder
     * @param $fileName
     * @param $disk
     *
     * @return string
     */
    public function uploadFile(UploadedFile $file, $folder, $fileName = null, $quality = 70, $disk = 'public')
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $convertFileName = $this->generateSeoFilename($file->getClientOriginalName(), $fileName);

        try {
            $year = date('Y');
            $month = date('m');

            $path = "$folder/$year/$month";

            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                $webpPath = "$path/$convertFileName";
                $image = Image::make($file)->encode('webp', $quality);
                $uploaded = Storage::disk($disk)->put($webpPath, (string) $image);
                return $uploaded ? $webpPath : false;
            } else {
                $filePath = "$path/$convertFileName";
                $uploaded = Storage::disk($disk)->put($filePath, file_get_contents($file));
                return $uploaded ? $filePath : false;
            }
        } catch (\Exception $e) {
            Log::error("File upload failed: " . $e->getMessage());
            return false;
        }
    }


    /**
     * Delete a file from storage.
     */
    public function deleteFile($path, $disk = 'public')
    {
        if(!empty($path)){
            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }

    public function uploadImages($images, $folderPath, $foreingId = null, $columnName = null)
    {
        $uploadedPaths = [];
        if(!empty($foreingId) && !empty($columnName)){
            foreach ($images as $image) {
                $uploadedPaths[] = [
                    $columnName  => $foreingId,
                    'path'       => $this->uploadFile($image, $folderPath),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }else{
            foreach ($images as $image) {
                $uploadedPaths[] = $this->uploadFile($image, $folderPath);
            }
        }

        return $uploadedPaths;
    }

    /**
     * Multiple Delete a file from storage.
     */
    public function deleteFiles($paths, $disk = 'public')
    {
        foreach ($paths as $key => $path) {
            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }

}
