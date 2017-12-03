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

    public function getAdminIndex(Store $session)
    {
        $blogs = Blog::all();

        return view('admin.home', ['blogs' => $blogs]);
    }

    public function getBlog($id)
    {

        $blog = Blog::where("id", "=", $id)->first();
        return view('content.blog', ['blog' => $blog]);
    }

    public function getAdminCreate(){
        $tags = Tag::all();

        return view('admin.create', ['tags' => $tags]);
    }

    public function postAdminCreate(Request $request) {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        //$tags = Tag::all();

        $post = new Item();
        $post->title = $request->input("title");
        $post->content = $request->input("content");

        $post->save();

        $post->tags()->attach($request->input('tags') === null ? [] : $request ->input('tags'));


        return redirect()->route('admin.index')->with('info', 'item created, title is' .$request->input('title') .$request->input('content'));
    }


    public function postAdminEdit($id) {

        $item = Item::where("id", "=", $id)->first();
        $tags = Tag::all();

        return view('admin.edit',['editObject' => $item], ['tags' => $tags]);
    }

    public function postAdminUpdate(Request $request){

        $id = $request->input("id");

        $item = Item::where("id", "=", $id)->first();

        $item->title = $request->input("title");
        $item->content = $request->input("content");

        $item->save();

        //$item->tags()->detach();
        $item->tags()->sync($request->input('tags') === null ? [] : $request ->input('tags'));

        return redirect()->route('admin.index')->with('info', 'item updated, title is' .$request->input('title') .$request->input('content'));
    }

    public function postAdminDelete(Request $request){

        $id = $request->input("id");

        $item = Item::where("id", "=", $id)->first();

        $item->likes->detach();
        $item->tags()->detach();

        $item->delete();

        return redirect()->route('admin.index')->with('info', 'item deleted');

    }

}
