@extends('main')

@section('content')

    <section class="container">
        Редактирование заказа №{{$order->id}}
        <div class="row m-0">
            <div class="col-4">Сеанс</div>
            <div class="col">Пользователь</div>
            <div class="col">Ряд</div>
            <div class="col">Место</div>
            <div class="col"></div>
        </div>

        <div class="row m-0">
            <form class="row"
                  action="{{route('orders.update', $order->id)}}"
                  method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <label>
                    <select class="col" name="timetable_id">
                        <option
                            value="{{$order->timetable->id}}">
                            {{$order->timetable->start}} {{$order->timetable->film->name}} {{$order->timetable->hall->name}}
                        </option>
                        @foreach($timetables as $timetable)
                            @if($timetable->id == $order->timetable_id)
                                @continue
                            @endif
                            <option
                                value="{{$timetable->id}}">
                                {{$timetable->start}} {{$timetable->film->name}} {{$timetable->hall->name}}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <select class="col" name="user_id">
                        <option value="{{$order->user->id}}">{{$order->user->name}}</option>
                        @foreach($users as $user)
                            @if($user->id == $order->user_id)
                                @continue
                            @endif
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <input class="col" type="text" name="row" value="{{$order->row}}">
                </label>
                <label>
                    <input class="col" type="text" name="seat" value="{{$order->seat}}">
                </label>
                <input class="col" type="submit" value="Сохранить">
            </form>
        </div>

    </section>

@endsection
