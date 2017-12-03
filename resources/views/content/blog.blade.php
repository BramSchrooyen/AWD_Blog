@extends('layouts.master')

@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="row">
        <div class="col-md-12">
            <p class="quote">{{ $blog->title }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>{{  $blog->content }}</p>
        </div>
    </div>

    {{--<div class="row">
        <div class="col-md-12">
            <p>Likes: </p>
            <p>{{  count($blog->likes) }}</p>
        </div>
    </div>--}}
    {{--<div class="row">
        <div class="col-md-12">
            <p>Tags: </p>

            @foreach($blog->tags as $tag)

                <p>{{  $tag->name }}</p>

            @endforeach

        </div>
    </div>--}}
@endsection