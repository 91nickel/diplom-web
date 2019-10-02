@extends('main')

@section('content')
    <section class="container content">
        <div class="row">
            <div class="col">
                @if(count($images) < 1)
                    Изображений нет
                @else
                    Управление изображениями
                @endif
            </div>
        </div>

        @if(count($images) > 0)
            <div class="row">
                <div class="col">Изображение</div>
                <div class="col">Название</div>
                <div class="col">Фильм</div>
                <div class="col">Удалить</div>
            </div>
        @endif


        @foreach($images as $image)
            <div class="row mt-1">
                <div class="col"><a target="_blank" href="{{route('images.show', $image->id)}}"><img src="{{asset('/storage/'.$image->link)}}" alt="" width=100></a></div>
                <div class="col">
                    @if($image->name != '')
                        {{$image->name}}
                    @else
                        Без имени
                    @endif
                </div>
                <div class="col">{{$image->films[0]->name}}</div>
                <div class="col">
                    <form
                        action="{{ route('images.destroy',$image->id) }}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        @endforeach

        <div class="row">
            <h3>Добавить изображение</h3>
        </div>
        <div class="row">
            <div class="col">
                <form
                    action="{{ route('images.store') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <label> Название
                            <input type="text" name="name" class="form-control">
                        </label>
                        <label> Фильм
                            <select name="film_id" class="form-control">
                                @foreach($films as $key => $film)
                                    <option @if($key === 0)
                                            selected
                                            @endif value="{{$film->id}}">{{$film->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label> Файлы
                            <input type="file" name="images[]" multiple>
                        </label>
                        <input type="submit" value="save">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
