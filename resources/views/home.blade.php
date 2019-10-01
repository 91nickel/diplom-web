@extends('main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Личный кабинет</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Вы авторизованы как {{Auth::user()->name}}
                    </div>
                    <div class="card-body">
                        <h5>Ваши заказы</h5>
                        <div class="row">
                            <div class="col">Номер заказа</div>
                            <div class="col">Начало</div>
                            <div class="col">Фильм</div>
                            <div class="col">Зал</div>
                        </div>
                    @foreach($orders as $order)
                            <div class="row">
                                <div class="col"><a href="/home/orders/{{$order->id}}">Заказ номер {{$order->id}}</a></div>
                                <div class="col">{{$order->timetable->start}}</div>
                                <div class="col">{{$order->timetable->film->name}}</div>
                                <div class="col">{{$order->timetable->hall->name}}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
