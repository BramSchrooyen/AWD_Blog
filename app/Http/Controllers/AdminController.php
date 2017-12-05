<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function getAdminIndex(Store $session)
    {
        $blogs = Blog::all();

        return view('admin.home', ['blogs' => $blogs]);
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

        $blog = new Blog();
        $blog->title = $request->input("title");
        $blog->content = $request->input("content");
        $blog->gigdate = $request->input("gigdate");

        //image in public/images storen. Database zoekt naar url in deze folder.

        if($request->hasFile('image')){
            $image = $request->file('image');
            //unieke filename want anders kunnen er problemen opduiken met identieke file names.
            $filename = $blog->id . time() . '.' . $image->getClientOriginalExtension(); //getClientOriginalExtension is deel van Intervention extensie
            $location = public_path('images/' . $filename);

            Image::make($image)->save($location); //opslaan in public/images laravel-side ---- resize(_,_) voor te grote images?
            $blog->imageurl = $filename; //filename opslaan in database om later te kunnen ophalen
        }

        $blog->lat = $request->input("lat");
        $blog->long = $request->input("lng");

        if (Auth::check()){
            $blog->user_id = Auth::id();
        }

        $blog->save();

        $blog->tags()->attach($request->input('tags') === null ? [] : $request ->input('tags'));


        return redirect()->route('content.blogmap')->with('info', 'item created, title is' .$request->input('title') .$request->input('content'));
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
