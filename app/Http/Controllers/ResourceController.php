<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Resource;
use App\Services\Upload;

class ResourceController extends Controller
{
    public function index() {
    }

    public function formResource() {
        $categories = Category::all();
    	return view('resource', ['categories' => $categories]);
    }

    // Create resource
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
        $resource->tag = $request->tag;
        $resource->category_id = $request->category;
        $resource->save();
        return redirect()->route('showResource', ['id' => $resource->id]);
    }

    //List resource by category
    public function detailCategory($id) {
        $categoryId = $id;
        $resources = Resource::where('category_id', $categoryId)->get();
        return view('category', ['resources' => $resources]);
    }

    //List all resource
    public function allResource(){
        $resources = Resource::orderBy('id', 'desc')->get();
        return view('category', ['resources' => $resources]);
    }

    // Search resources by tag
    public function searchByTag(Request $request) {
        $searchTxt = $request->searchTxt;
        $resources = Resource::with(['category'])->where('tag', 'like', "%$searchTxt%")->get();
        return $resources;
    }

    // Load view update resource
    public function showResource($id) {
        $resource = Resource::find($id);
        return view('update_resource', ['resource' => $resource]);
    }

    //Update resource
    public function update(Request $request) {
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
        $resourceId = $request->id;
        $resource = Resource::find($resourceId);
        if(isset($resource)) {
            $resource->html = $request->html;
            $resource->sass = $request->sass;        
            // $resource->images = implode("|",$images);
            $resource->tag = $request->tag;
            $resource->category_id = $request->category;
            $resource->save();
            return redirect()->route('showResource', ['id' => $resourceId]);
        }
    }
}
