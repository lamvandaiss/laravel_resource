<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Resource;
use App\Services\Upload;

class ResourceController extends Controller
{
    public function index() {
        $resource = Resource::latest()->first();
        return view('home', ['resource' => $resource]);
    }

    public function formResource() {
        $categories = Category::all();
    	return view('resource', ['categories' => $categories]);
    }

    public function store(Request $request) {
        $images = array();
        $files = $request->file('images');
        if(isset($files)) {
            $upload = new Upload;
            foreach($files as $file) {
                $fileUploaded = $upload->singleUpload($file);
                $images[] = $fileUploaded['url'];
            }
        }
        if(trim($request->image_clipboard) != '') {
            $images[] = $request->image_clipboard;
        }
    	$resource = new Resource;
        $resource->html = $request->html;
        $resource->sass = $request->sass;        
        $resource->images = implode("|",$images);
        $resource->task = $request->task;
        $resource->category_id = $request->category;
        $resource->save();
        return redirect()->action([ResourceController::class, 'index']);
    }

    public function detailCategory($id) {
        $category_id = $id;
        $resources = Resource::where('category_id', $category_id)->get();
        return view('category', ['resources' => $resources]);
    }

    // Search resources by task
    public function searchByTask(Request $request) {
        $searchTxt = $request->searchTxt;
        $resources = Resource::where('task', 'like', "%$searchTxt%")->get();
        return $resources;
    }
}
