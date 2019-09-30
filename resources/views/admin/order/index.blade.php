@extends('main')

@section('content')
    <section class="container">
        Заказы пользователей
        <div class="row">
            <div class="col">Фильм</div>
            <div class="col">Зал</div>
            <div class="col">Пользователь</div>
            <div class="col">Ряд</div>
            <div class="col">Место</div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
        @foreach($orders as $order)
            <div class="row">
                <div class="col">{{$order->timetable->film->name}}</div>
                <div class="col">{{$order->timetable->hall->name}}</div>
                <div class="col">{{$order->user->name}}</div>
                <div class="col">{{$order->row}}</div>
                <div class="col">{{$order->seat}}</div>
                <div class="col">
                    <a href="{{route('orders.edit', $order->id)}}">
                        <button>
                            Редактировать
                        </button>
                    </a>
                </div>
                <div class="col">
                    <form
                        action="{{route('orders.destroy', $order->id)}}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Удалить">
                    </form>
                </div>
            </div>
        @endforeach
        <div class="row">
            <h3>Добавить заказ</h3>
        </div>
        <div class="row">
            <div class="col">
                <form
                    action="{{ route('orders.store') }}"
                    method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="handle" value="true">
                    <div class="row">
                        <label> Сеанс
                            <select name="timetable_id" class="form-control">
                                @foreach($timetables as $timetable)
                                        <option value="{{$timetable->id}}">{{$timetable->start}} {{$timetable->film->name}} {{$timetable->hall->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label> Пользователь
                            <select name="user_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label> Ряд
                            <input type="text" name="row" class="form-control">
                        </label>
                        <label> Место
                            <input type="text" name="seat" value="" class="form-control">
                        </label>
                        <input type="submit" value="Добавить">
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
