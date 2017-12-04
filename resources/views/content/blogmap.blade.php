@extends('layouts.master')

@section('content')

    <div class="container-fluid" id="mapdiv">

    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjWdWxCmfiy3musyhYvQ76e0wOYSHWHkM&callback=initMap"
            type="text/javascript" async defer></script>

    <script>


                function initMap() {}; // now it IS a function and it is in global


                initMap = function() {


                    var map = new google.maps.Map(document.getElementById('mapdiv'),{
                        center:{
                            //centeren op Gent
                            lat: 51.0543,
                            lng: 3.7174
                        },
                        zoom: 4,
                        disableDefaultUI: true,
                        scrollwheel: false

                    });

                var infos = [];
                var mkList = [];

                        @foreach($markers as $marker)

                            var lat = {{$marker->lat}};
                            var lng = {{$marker->long}};
                            var search = [{{$marker->lat}},{{$marker->long}}, {{$marker->id}}];
                            var contentMarker = '<div id="contentMarker">'+
                                '<div id="siteNotice">'+
                                '</div>'+
                                '<h1 id="firstHeading" class="firstHeading">{{$marker->title}}</h1>'+
                                '<h2 id="secondHeading" class="secondHeading">{{$marker->gigdate}}</h2>'+
                                '<div id="bodyContent">'+
                                '<p>{{$marker->content}}</p>'+
                                '<a href="{{ route('content.blog', ['id' => $marker->id]) }}">Lees meer</a>'+
                                '</div>'+
                                '</div>';

                            locationChecker(search);

                            mkList.push([lat,lng,contentMarker]);

                             var bloginfo = new google.maps.InfoWindow({
                                content: contentMarker
                            });

                            var marker = new google.maps.Marker({
                                position:{
                                    lat: lat,
                                    lng: lng
                                },
                                map:map,
                                title: "{{$marker->title}}"
                            });



                            //infowindows voor meerdere markers
                            //https://stackoverflow.com/questions/11106671/google-maps-api-multiple-markers-with-infowindows
                            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                                return function() {
                                    closeInfos();
                                    infowindow.setContent(content);
                                    infowindow.open(map,marker);

                                    infos[0]=infowindow;
                                };
                            })(marker,contentMarker,bloginfo));

                        @endforeach

                    function closeInfos(){

                        if(infos.length > 0){

                            /* detach the info-window from the marker ... undocumented in the API docs */
                            infos[0].set("marker", null);

                            /* and close it */
                            infos[0].close();

                            /* blank the array */
                            infos.length = 0;
                        }
                    }

                    function locationChecker(search){
                        for (var i = 0; i < mkList.length; i++){
                            if ( mkList[i][0] === search[0] && mkList[i][1] === search[1]){
                                contentMarker += mkList[i][2]; //nieuwe blog toevoegen aan marker description
                                mkList.pop(); //blog uit checklist verwijderen zodat deze niet steeds opnieuw wordt toegevoegd.
                            }
                        }
                    }

                        google.maps.event.trigger(map, 'resize');
            };

    </script>

@endsection

@section('blogs')
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
    @foreach($markers as $marker)
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="post-title">{{ $marker->title }}</h1>
                <p>{{ $marker->content }}</p>
                <p><a href="{{ route('content.blog', ['id' => $marker->id]) }}">Meer details...</a></p>

                {{--<form action="" method="post">

                     <input type="hidden" class="form-control" id="id" name="id" \
                            value="{{ $blog->id }}">
                     {{ csrf_field() }}

                     <button type="submit" class="btn btn-primary">Like</button>

                 </form>--}}
            </div>
        </div>
        <hr>
    @endforeach
@endsection