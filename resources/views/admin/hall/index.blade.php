@extends('main')
@section('content')
<section class="container content">
    <div class="row">
        <div class="col">
            @if(count($halls) < 1)
                Данных по залам не обнаружено
            @else
                Управление залами
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">Название зала</div>
        <div class="col">Рядов</div>
        <div class="col">Мест в ряду</div>
        <div class="col">VIP ряды</div>
        <div class="col">VIP места</div>
        <div class="col">Удалить</div>
        <div class="col">Редактировать</div>
    </div>

    @foreach($halls as $hall)
        <div class="row">
            <div class="col">{{$hall->name}}</div>
            <div class="col">{{$hall->rows}}</div>
            <div class="col">{{$hall->seats}}</div>
            <div class="col">{{$hall->vip_rows}}</div>
            <div class="col">{{$hall->vip_seats}}</div>
            <div class="col">
                <form
                    action="{{ route('halls.destroy',$hall->id) }}"
                    method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="Delete">
                </form>
            </div>
            <div class="col">
                <form
                    action="{{ route('halls.edit',$hall->id) }}"
                    method="GET">
                    {{ csrf_field() }}
                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>
    @endforeach

    <div class="row">
        <h3>Добавить зал</h3>
    </div>
    <div class="row">
        <div class="col">
            <form
                action="{{ route('halls.store') }}"
                method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <label> Название
                        <input type="text" name="name" value="" class="form-control">
                    </label>
                    <label> Рядов
                        <input type="text" name="rows" value="" class="form-control">
                    </label>
                    <label> Мест в ряду
                        <input type="text" name="seats" value="" class="form-control">
                    </label>
                    <label> VIP ряды
                        <input type="text" name="vip_rows" value="" class="form-control">
                    </label>
                    <label> VIP места
                        <input type="text" name="vip_seats" value="" class="form-control">
                    </label>
                    <input type="submit" value="save">
                </div>
            </form>

        </div>
    </div>
</section>
@endsection
