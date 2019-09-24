@extends('main')
@section('content')
<section class="container content">
    <div class="row">
        <h3>Редактировать зал</h3>
    </div>
    <div class="row">
        <div class="col">
{{--            @dd($hall)--}}
            <form
                action="{{ route('halls.update', $hall->id) }}"
                method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="row">
                    <label> Название
                        <input type="text" name="name" value="{{$hall->name}}" class="form-control">
                    </label>
                    <label> Рядов
                        <input type="text" name="rows" value="{{$hall->rows}}" class="form-control">
                    </label>
                    <label> Мест в ряду
                        <input type="text" name="seats" value="{{$hall->seats}}" class="form-control">
                    </label>
                    <label> VIP ряды
                        <input type="text" name="vip_rows" value="{{$hall->vip_rows}}" class="form-control">
                    </label>
                    <label> VIP места
                        <input type="text" name="vip_seats" value="{{$hall->vip_seats}}" class="form-control">
                    </label>
                    <input type="submit" value="save">
                </div>
            </form>

        </div>
    </div>
</section>
@endsection
