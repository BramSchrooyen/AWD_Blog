<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class BlogController extends Controller
{

    public function getBlogIndex(Store $session)
    {

        /*$item = new Item();
        $items = $item->getItems($session);*/

        $blogs = Blog::all();

        return view('content.blogindex', ['blogs' => $blogs]);
    }



    public function getBlog($id)
    {

        $blog = Blog::where("id", "=", $id)->first();
        return view('content.blog', ['blog' => $blog]);
    }



}
