<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function index() {
    	$category = Category::all();
    	return view('resource', ['categories' => $category]);
    }

    public function store(Request $request) {
    	$resource = new Resource;
        $resource->html = $request->html;
        $resource->sass = $request->sass;
        $resource->task = $request->task;
        $resource->category_id = $request->category;
        $resource->save();
        return $resource;
    }
}
