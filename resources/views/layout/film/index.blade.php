@extends('main')
@section('content')
    <section class="container">
        <div class="row my-4">
            <h2>{{$film->name}}</h2>
        </div>
        <div class="row">
            <div class="col mr-2">
                <img class="img-fluid" src="/images/test-photo-announce.jpg" alt="">
            </div>
            <div class="col ml-2">
                <div class="row mb-3 mx-0">
                    <h3>{{$film->name}}</h3>
                </div>
                <div class="row my-3 mx-0">
                    <p>{{$film->announce}}</p>
                </div>
                <div class="row my-3 mx-0">
                    @foreach($times as $time)
                        <a class="col-2 btn btn-warning p-2" href="/timetables/order/{{$time['id']}}">
                            {{$time['value']}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
