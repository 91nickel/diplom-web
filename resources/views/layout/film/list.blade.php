@extends('main')
@section('content')
    <section class="container content">
        <div class="row">
            <div class="col">
                <h2>
                    @if(count($films) < 1)
                        Фильмов нет
                    @else
                        Список фильмов
                    @endif
                </h2>
            </div>
        </div>

        @if(count($films) > 0)
            <div class="row">
                <div class="col">Название фильма</div>
                <div class="col">Описание</div>
                <div class="col">Продолжительность</div>
                <div class="col"></div>
            </div>
        @endif


        @foreach($films as $film)
            <div class="row">
                <div class="col"><a href="/films/{{$film->code}}">{{$film->name}}</a></div>
                <div class="col">{{$film->announce}}</div>
                <div class="col">{{$film->length}}</div>
                <div class="col">
                    @if($film->timetables->count() > 0)
                        <a href="/timetables/{{$film->code}}">
                            <button>Сеансы</button>
                        </a>
                    @else
                        <p>Сеансов нет</p>
                    @endif
                </div>
            </div>
        @endforeach
    </section>
@endsection
