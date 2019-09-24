@extends('main')

@section('content')
    <section class="container content">
        <div class="row">
            <div class="col">
                @if(count($films) < 1)
                    Фильмов нет
                @else
                    Управление фильмами
                @endif
            </div>
        </div>

        @if(count($films) > 0)
            <div class="row">
                <div class="col">Название фильма</div>
                <div class="col">Codename</div>
                <div class="col">Текст анонса</div>
                <div class="col">Продолжительность</div>
                <div class="col">Удалить</div>
                <div class="col">Редактировать</div>
            </div>
        @endif


        @foreach($films as $film)
            <div class="row">
                <div class="col">{{$film->name}}</div>
                <div class="col">{{$film->code}}</div>
                <div class="col">{{$film->announce}}</div>
                <div class="col">{{$film->length}}</div>
                <div class="col">
                    <form
                        action="{{ route('films.destroy',$film->id) }}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Delete">
                    </form>
                </div>
                <div class="col">
                    <form
                        action="{{ route('films.edit',$film->id) }}"
                        method="GET">
                        {{ csrf_field() }}
                        <input type="submit" value="Edit">
                    </form>
                </div>
            </div>
        @endforeach

        <div class="row">
            <h3>Добавить фильм</h3>
        </div>
        <div class="row">
            <div class="col">
                <form
                    action="{{ route('films.store') }}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <label> Название
                            <input type="text" name="name" value="" class="form-control">
                        </label>
                        <label> Codename
                            <input type="text" name="code" value="" class="form-control">
                        </label>
                        <label> Анонс
                            <textarea type="text" name="announce" class="form-control"></textarea>
                        </label>
                        <label> Продолжительность
                            <input type="text" name="length" value="" class="form-control">
                        </label>
                        <input type="submit" value="save">
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
