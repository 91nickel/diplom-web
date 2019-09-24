@extends('main')
@section('content')
    <section class="container content">
        <div class="row">
            <h2>Редактирование сеанса</h2>
        </div>
        <div class="row">
            <div class="col">Начало сеанса</div>
            <div class="col">Окончание сеанса</div>
            <div class="col">Фильм</div>
            <div class="col">Зал</div>
            <div class="col">Удалить</div>
            <div class="col">Редактировать</div>
        </div>

        <div class="row">
            <div class="col">
                <form
                    action="{{ route('timetables.update', $timetable->id) }}"
                    method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="row">
                        <label> Начало
                            <input type="text" name="start" value="{{$timetable->start}}" class="form-control">
                        </label>
                        <label> Конец
                            <input type="text" name="stop" value="{{$timetable->stop}}"
                                   class="form-control">
                        </label>
                        <label> Фильм
                            <select name="film_id" class="form-control">
                                @foreach($films as $film)
                                    @if($film->id == $timetable->film_id)
                                        <option selected value="{{$film->id}}">{{$film->name}}</option>
                                    @else
                                        <option value="{{$film->id}}">{{$film->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                        <label> Зал
                            <select name="hall_id" class="form-control">
                                @foreach($halls as $hall)
                                    @if($hall->id == $timetable->hall_id)
                                        <option selected value="{{$hall->id}}">{{$hall->name}}</option>
                                    @else
                                        <option value="{{$hall->id}}">{{$hall->name}}</option>
                                    @endif
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
