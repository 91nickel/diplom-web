@extends('main')
@section('content')
    <section class="container">
        <div class="row my-4">
            <h2>Сегодня в кино</h2>
        </div>
        <div class="row">
            <div class="col mr-2">
                <img class="img-fluid" src="{{asset('/storage/' . $headFilm->images[0]->link)}}" alt="">
            </div>
            <div class="col ml-2">
                <div class="row mb-3 mx-0">
                    <h3>{{$headFilm->name}}</h3>
                </div>
                <div class="row my-3 mx-0">
                    <p>{{$headFilm->announce}}</p>
                </div>
                <div class="row my-3 mx-0">
                    <button class="col-2 btn btn-warning p-2">11:00</button>
                    <button class="col-2 btn btn-warning p-2">13:00</button>
                    <button class="col-2 btn btn-warning p-2">15:00</button>
                </div>
                <div class="row my-3 mx-0">
                    <a href="/films/{{$headFilm->code}}"><button type="button" class="btn btn-primary">Выбрать сеанс</button></a>
                </div>
            </div>
        </div>
    </section>
    <section class="container p-0">
        <div class="row my-4">
            <h2>Афиша</h2>
        </div>
        <div class="row">
            @foreach($films as $film)
                <div class="col-3">
                    <div class="row text-center justify-content-start">
                        <img class="col-12 img-fluid" src="/images/test-catalog-1.jpg">
                    </div>
                    <div class="row">
                        <div class="col-12 text-center"><h5 class="m-3">{{$film['film']->name}}</h5></div>
                    </div>
                    <div class="row text-center px-3">
                        @foreach($film['times'] as $time)
                            <div class="col-3 p-0">
                                <button class="btn btn-warning p-2">{{$time}}</button>
                            </div>
                        @endforeach
                    </div>
                    <div class="row text-center my-4">
                        <div class="col-12">
                            <a href="/timetables/{{$film['film']->code}}">
                                <button type="button" class="btn btn-primary m-0">Выбрать сеанс</button>
                            </a>
                        </div>
                    </div>
                </div>
        @endforeach
    </section>
@endsection
