@extends('layouts.app')

@section('content')
    @if(count($errors->all()))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    @endif

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.create') }}" method="post" enctype="multipart/form-data"> {{--enctype dient om files in de form te kunnen meegeven--}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" class="form-control" id="content" name="content">
                </div>

                <div class="form-group">
                    <label for="gigdate">Date of gig</label>
                    <input type="text" class="form-control" id="gigdate" name="gigdate">
                </div>

                <div class="form-group">
                    <label for="image">Upload image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                {{ csrf_field() }}

                @foreach($tags as $tag)
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}<br>
                @endforeach

                <div class="form-group">
                    <label for="map">Map</label>
                    <input type="text" id="searchmap">
                    <div class="container-fluid" id="mapdiv-create"></div>
                </div>

                {{--<div class="form-group">
                    <label for="lat">Lat</label>
                    <input type="hidden" class="form-control input-sm" id="lat" name="lat">
                </div>--}}

                    <input type="hidden" class="form-control input-sm" id="lat" name="lat">
                    <input type="hidden" class="form-control input-sm" id="lng" name="lng">

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    {{--Google API Library Places is hierbij enabled voor autocomplete -> op deze manier blijven coördinaten in dezelfde stad ook gelijk in de database--}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjWdWxCmfiy3musyhYvQ76e0wOYSHWHkM&callback=initMap&libraries=places"
            type="text/javascript" async defer></script>

    <script>


        function initMap() {} // now it IS a function and it is in global


        initMap = function() {


            var map = new google.maps.Map(document.getElementById('mapdiv-create'), {
                center: {
                    //centeren op Gent
                    lat: 51.0543,
                    lng: 3.7174
                },
                zoom: 6,
                disableDefaultUI: true,
                scrollwheel: false

            });

            var marker = new google.maps.Marker({
                position: {
                    lat: 51.0543,
                    lng: 3.7174
                },
                map: map,
                draggable: false
            });

            var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

            //inspiratie uit: https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete
            google.maps.event.addListener(searchBox,'places_changed',function(){
                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i, place;

                for(i=0; place=places[i]; i++){
                    bounds.extend(place.geometry.location); //zet bounds op juiste plaats zodat marker zichtbaar is
                    marker.setPosition(place.geometry.location); //verplaatst marker
                }
                map.fitBounds(bounds);
                map.setZoom(6);
            });

            google.maps.event.addListener(marker,'position_changed',function(){
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();

                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
            });
        }
    </script>
@endsection