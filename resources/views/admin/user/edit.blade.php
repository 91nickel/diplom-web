@extends('main')

@section('content')
    <section class="container">
        <div class="row">
            <h2>Редактирование пользователя {{$user->name}}</h2>
        </div>
        <form
            action="{{ route('users.update', $user->id) }}"
            method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <label> Имя пользователя
                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                </label>
                <label> Электронная почта
                    <input type="text" name="email" value="{{$user->email}}" class="form-control">
                </label>
                <label> Роль
                    <select type="text" name="role_id" class="form-control">
                        @if($user->roles->count() > 0)
                            <option selected value="{{$user->roles[0]->id}}">{{$user->roles[0]->name}}</option>
                        @else
                            <option selected value="2">user</option>
                        @endif
                        @foreach($roles as $role)
                            @if($user->roles->count() > 0 && $role->id == $user->roles[0]->id
                            || $user->roles->count() == 0 && $role->id == 2)
                                @continue
                            @endif
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </label>
                <input type="submit" value="Сохранить">
            </div>
        </form>


@endsection
