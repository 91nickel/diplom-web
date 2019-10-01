@extends('main')
@section('content')
    <section class="container">
        <div class="row">
            <div class="col">Номер заказа</div>
            <div class="col">Начало</div>
            <div class="col">Фильм</div>
            <div class="col">Зал</div>
            <div class="col">Ряд</div>
            <div class="col">Место</div>
        </div>

        <div class="row">
            <div class="col">Заказ номер {{$order->id}}</div>
            <div class="col">{{$order->timetable->start}}</div>
            <div class="col">{{$order->timetable->film->name}}</div>
            <div class="col">{{$order->timetable->hall->name}}</div>
            <div class="col">{{$order->row}}</div>
            <div class="col">{{$order->seat}}</div>
        </div>
        <div class="row">
            <img alt="qr-code" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->size(250)->errorCorrection('H')
                        ->generate(route('orders.show', $order->id))) !!} ">
        </div>
    </section>
@endsection
