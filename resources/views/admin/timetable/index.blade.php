@extends('main')
@section('content')
    <section class="container content">
        <div class="row">
            <div class="col">
                @if(count($timetables) < 1)
                    Данных по расписанию не обнаружено
                @else
                    Управление расписанием
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">Начало сеанса</div>
            <div class="col">Окончание сеанса</div>
            <div class="col">Фильм</div>
            <div class="col">Зал</div>
            <div class="col">Удалить</div>
            <div class="col">Редактировать</div>
        </div>

        @foreach($timetables as $timetable)
            <div class="row">
                <div class="col">{{$timetable->start}}</div>
                <div class="col">{{$timetable->stop}}</div>
                <div class="col">{{$filmIdName[$timetable->film_id]}}</div>
                <div class="col">{{$hallIdName[$timetable->hall_id]}}</div>
                <div class="col">
                    <form
                        action="{{ route('timetables.destroy',$timetable->id) }}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Delete">
                    </form>
                </div>
                <div class="col">
                    <form
                        action="{{ route('timetables.edit',$timetable->id) }}"
                        method="GET">
                        {{ csrf_field() }}
                        <input type="submit" value="Edit">
                    </form>
                </div>
            </div>
        @endforeach

        <div class="row">
            <h3>Добавить сеанс</h3>
        </div>
        <div class="row">
            <div class="col">
                <form
                    action="{{ route('timetables.store') }}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <label> Начало
                            <input type="text" name="start" value="{{@date('Y-m-d H:m')}}" class="form-control">
                        </label>
                        <label> Конец
                            <input type="text" name="stop" value="{{@date('Y-m-d H:m',time()+7200)}}"
                                   class="form-control">
                        </label>
                        <label> Фильм
                            <select name="film_id" class="form-control">
                                @foreach($films as $film)
                                    <option value="{{$film->id}}">{{$film->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label> Зал
                            <select name="hall_id" class="form-control">
                                @foreach($halls as $hall)
                                    <option value="{{$hall->id}}">{{$hall->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <input type="submit" value="save">
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
