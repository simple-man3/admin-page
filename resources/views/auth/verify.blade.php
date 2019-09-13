@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтвердите свой Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Новое письмо для подтверждения отправлено на ваш e-mail адрес.') }}
                        </div>
                    @endif

                    {{ __('Проверьте свой email перед повторной отправкой письма') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
		                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Отправить письмо снова') }}</button>.
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
