@extends('layouts.app')

@section('blogmap')

    <div class="row">
        <div class="col-md-12">
            <p class="quote">Map</p>
        </div>

        </div>
    <div class="mapdiv" id="mapdiv">

    </div>

    @foreach($markers as $marker)

        <p> {{$marker->lat}} </p>

        <p> {{$marker->long}} </p>

    @endforeach
    {{--@foreach($blogs as $blog)
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="post-title">{{ $blog->title }}</h1>
                <p>{{ $blog->content }}</p>

                <form action="" method="post">

                     <input type="hidden" class="form-control" id="id" name="id" \
                            value="{{ $blog->id }}">
                     {{ csrf_field() }}

                     <button type="submit" class="btn btn-primary">Like</button>

                 </form>
            </div>
        </div>
        <hr>
    @endforeach--}}

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjWdWxCmfiy3musyhYvQ76e0wOYSHWHkM&callback=initMap"
            type="text/javascript" async defer></script>

    <script>

        function initMap() {}; // now it IS a function and it is in global


            initMap = function() {


                var map = new google.maps.Map(document.getElementById('mapdiv'),{
                    center:{
                        lat: 0,
                        lng: 0
                    },
                    zoom: 8

                });
                        @foreach($markers as $marker)

                            var lat = {{$marker->lat}};
                            var lng = {{$marker->long}};

                            var marker = new google.maps.Marker({
                                position:{
                                    lat: lat,
                                    lng: lng
                                },
                                map:map
                            });


                        @endforeach

                        google.maps.event.trigger(map, 'resize');
            };



    </script>



@endsection