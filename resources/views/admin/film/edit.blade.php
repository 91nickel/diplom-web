@extends('main')

@section('content')
    <section class="container content">
        <div class="row">
            <h3>Редактировать фильм</h3>
        </div>
        <div class="row">
            <div class="col">
                {{--            @dd($film)--}}
                <form
                    action="{{ route('films.update', $film->id) }}"
                    method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="row">
                        <label> Название
                            <input type="text" name="name" value="{{$film->name}}" class="form-control">
                        </label>
                        <label> Codename
                            <input type="text" name="code" value="{{$film->code}}" class="form-control">
                        </label>
                        <label> Анонс
                            <textarea type="text" name="announce" class="form-control">{{$film->announce}}</textarea>
                        </label>
                        <label> Продолжительность
                            <input type="text" name="length" value="{{$film->length}}" class="form-control">
                        </label>
                        <input type="submit" value="save">
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
