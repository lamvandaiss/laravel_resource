<?php

namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Upload
{
    public $path = '';
    public $storage_path = 'images';
    public $disk = 'public';

    public function __construct()
    {
        $this->path = url('/');
    }

    public function setDisk($disk) {
        $this->disk = $disk;
        return $this;
    }

    public function getDisk() {
        return $this->disk;
    }

    public function setPath($path) {
        $this->path = $path;
        return $this;
    }

    public function getPath() {
        return $this->path;
    }

    public function setStoragePath($path) {
        $this->storage_path = $path;
        return $this;
    }

    public function getStoragePath() {
        return $this->storage_path;
    }


    /**
     * Get new name of file
     *
     * @param $file
     * @return string
     */
    private function getNewName($file) {
        $name = $file->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $time = Carbon::now()->timestamp;
        return Str::slug($filename) . "-" . $time . "." .$extension;
    }

    public function singleUpload($file) {
        $name = $this->getNewName($file);
        $path = $file->storeAs($this->getStoragePath(), $name, ['disk' => $this->getDisk()]);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk($this->getDisk());
        $width = Image::make($file)->width();
        if ($width > 1600) {
            Image::make($disk->path($path))->resize(1600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        $url = '/storage/'. $path;
        $full_url = $disk->url($path);
        return compact('url','full_url');
    }

}
