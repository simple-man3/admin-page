@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <div class="container">
        @auth
            <div class="row">
                <div class="col-8">
                    <div class="mb-3 d-flex justify-content-center">
                        <a href="#" class="btn btn-primary">{{ __('Добавить новую запись') }}</a>
                    </div>
                </div>
                <div class="col-4">

                </div>
            </div>
        @endauth
        <div class="row">
            <div class="col-8">
                @if(count($posts))
                    @foreach($posts as $post)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-secondary">{{ $post->Author->name }} {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d.m.Y H:i:s') }}</h6>
                                <div class="card-text">
                                    {{ $post->content }}
                                </div>
                                <a href="#" class="card-link">{{ __('Читать статью') }}</a>
                            </div>
                        </div>
                    @endforeach

                    {{ $posts->links() }}
                @else
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Записей пока нет') }}</h5>
                            <div class="card-text">
                                Кнопка добавления новой записиы
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-4">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Виджетов пока нет') }}</h5>
                        @auth
                            <div class="card-text">
                                <a href="#" class="btn btn-primary">Кнопка добавления нового виджета</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
