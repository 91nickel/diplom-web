<header class="container text-center border">
    <ul class="row list-unstyled border p-3">
        <li class="col border"><a href="/">Главная</a></li>
        <li class="col border"><a href="/timetables/">Расписание</a></li>
        <li class="col border"><a href="/films/">Фильмы</a></li>
        @if(Auth::user() && Auth::user()->roles->count() && Auth::user()->roles[0]->id === 1)
            <li class="col border"><a href="/admin/users">Управление пользователями</a></li>
            <li class="col border"><a href="/admin/timetables">Управление расписанием</a></li>
            <li class="col border"><a href="/admin/films">Управление фильмами</a></li>
            <li class="col border"><a href="/admin/halls">Управление залами</a></li>
            <li class="col border"><a href="/admin/orders">Управление заказами</a></li>
            <li class="col border"><a href="/admin/images">Управление изображениями</a></li>
        @endif
        @if(Auth::user())
            <li class="col border"><a href="/home">Личный кабинет</a></li>
        @else
            <li class="col border"><a href="/home">Войти</a></li>
        @endif
    </ul>
</header>
