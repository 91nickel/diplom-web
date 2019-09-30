@extends('main')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col">Имя</div>
            <div class="col">E-Mail</div>
            <div class="col">Роль</div>
            <div class="col">Редактировать</div>
            <div class="col">Удалить</div>
        </div>

        @foreach ($users as $user)

            <div class="row">
                <div class="col">{{$user->name}}</div>
                <div class="col">{{$user->email}}</div>
                <div class="col">
                    @if($user->roles->count() > 0)
                        {{$user->roles[0]->name}}
                    @else
                        user
                    @endif
                </div>
                <div class="col">
                    <form
                        action="{{ route('users.edit',$user->id) }}"
                        method="GET">
                        {{ csrf_field() }}
                        <input type="submit" value="Редактировать">
                    </form>
                </div>
                <div class="col">
                    <form
                        action="{{ route('users.destroy',$user->id) }}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Удалить">
                    </form>

                </div>
            </div>

    @endforeach
@endsection
