@extends('layouts.app')

@section('content')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <p class="quote">Mijn Blogs</p>
        </div>
    </div>
    @foreach($blogs as $blog)
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="post-title">{{ $blog->title }}</h1>
                <p>{{ $blog->content }}!</p>
                <p><a href="{{ route('content.blog', ['id' => $blog->id]) }}">Meer details...</a></p>

                <form action="" method="post">

                    <input type="hidden" class="form-control" id="id" name="id" \
                           value="{{ $blog->id }}">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-primary">Like</button>

                </form>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
