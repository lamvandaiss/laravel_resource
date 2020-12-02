<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Upload;

class FileController extends Controller
{
    public function singleUpload(Request $request) {
        $file = $request->file;
        $upload = new Upload;
        return $upload->singleUpload($file);
    }
}
