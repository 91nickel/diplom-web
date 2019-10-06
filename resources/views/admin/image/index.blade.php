@extends('main')

@section('content')
    <section class="container content">
        <div class="row">
            <div class="col">
                @if(count($images) < 1)
                    Изображений нет
                @else
                    <h4>Управление изображениями</h4>
                @endif
            </div>
        </div>

        @if(count($images) > 0)
            <div class="row">
                <div class="col">Изображение</div>
                {{--
                                <div class="col">Название</div>
                --}}
                <div class="col">Фильм</div>
                <div class="col"></div>
            </div>
        @endif


        @foreach($images as $image)
            <div class="row mt-1">
                <div class="col"><a target="_blank" href="{{route('images.show', $image->id)}}"><img
                            src="{{asset('/storage/'.$image->link)}}" alt="" width=100></a></div>
                {{--
                                <div class="col">
                                    @if($image->name != '')
                                        {{$image->name}}
                                    @else
                                        Без имени
                                    @endif
                                </div>
                --}}
                <div class="col-6">
                    <form action="{{route('images.update', $image->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <label>
                            <select name="film_id" class="form-control"> Изменить фильм
                                @foreach($films as $film)
                                    <option
                                        @if($film->id == $image->films[0]->id)
                                        selected
                                        @endif
                                        value="{{$film->id}}">{{$film->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <input type="submit" value="Обновить" class="btn btn-warning waves-effect waves-light">
                    </form>
                </div>
                <div class="col">
                    <form
                        action="{{ route('images.destroy',$image->id) }}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Удалить" class="btn btn-danger waves-effect waves-light">
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
                        <label> Фильм
                            <select name="film_id" class="form-control">
                                @foreach($films as $key => $film)
                                    <option @if($key === 0)
                                            selected
                                            @endif value="{{$film->id}}">{{$film->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <button class="btn btn-primary waves-effect waves-light" onclick="
                            event.preventDefault();
                            $('#images-add').click();">Добавить изображение
                            </button>
                            <input type="file" name="images[]" class="btn btn-primary waves-effect waves-light"
                                   id="images-add" style="display:none" multiple>
                        </label>
                        <input type="submit" value="Сохранить" class="btn btn-primary waves-effect waves-light">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
