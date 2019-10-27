<div class="card mb-2">
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="text-center">User info</h4>
                @auth
                    <div><span class="text-primary">Имя пользователя:</span> {{ $user->name }}</div>
                    <div><span class="text-primary">e-mail:</span> {{ $user->email }}</div>
                @endauth
                @guest
                    <div>Вы неавторизованы</div>
                @endguest
                @if($isUserAdmin)
                    <div class="text-center"><b>Администратор</b></div>
                @endif
            </div>
        </div>
    </div>
</div>
