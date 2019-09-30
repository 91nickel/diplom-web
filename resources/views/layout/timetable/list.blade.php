@extends('main')
@section('content')
    <section class="container content">
        <div class="row">
            <div class="col">
                <h2>
                    @if(count($timetables) < 1)
                        Сеансов нет
                    @else
                        Список сеансов
                    @endif
                </h2>
            </div>
        </div>

        @if(count($timetables) > 0)
            <div class="row">
                <div class="col">Начало</div>
                <div class="col">Окончание</div>
                <div class="col">Фильм</div>
                <div class="col">Зал</div>
                <div class="col"></div>
            </div>
        @endif


        @foreach($timetables as $timetable)
            <div class="row">
                <div class="col">{{$timetable->start}}</div>
                <div class="col">{{$timetable->stop}}</div>
                <div class="col"><a href="/films/{{$timetable->film->code}}">{{$timetable->film->name}}</a></div>
                <div class="col">{{$timetable->hall->name}}</div>
                <div class="col">
                    <a href="/timetables/order/{{$timetable->id}}">
                        <button>Купить билет</button>
                    </a>
                </div>
            </div>
        @endforeach
    </section>
@endsection
