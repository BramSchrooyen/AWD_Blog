<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class MapController extends Controller
{

    public function getBlogMap(){

        $markers = Blog::all();


        return view('content.blogmap', ['markers' => $markers]);
    }

}
