@extends('layouts.app')

@section('title', __('Главная'))

@section('content')
    <div class="container">
        @auth
            <div class="row">
                <div class="col-8">
                    <div class="mb-3 d-flex justify-content-center">
                        <a href="{{ route('post.create') }}" class="btn btn-primary">{{ __('Добавить новую запись') }}</a>
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
                        <post-component
                                     content="{{ $post->content }}"
                                     title="{{ $post->title }}"
                        >
                            <template v-slot:before-editor>
                                <h6 class="card-subtitle mb-2 text-secondary">{{ $post->author->name }} {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d.m.Y H:i:s') }}</h6>
                            </template>

                            <template v-slot:after-editor>
                                <a href="{{ route('post.show', ['post' => $post]) }}" class="card-link">Читать статью</a>
                                @auth
                                <a href="{{ route('post.edit', ['post' => $post]) }}" class="card-link">Редактировать</a>
                                <form class="d-inline-block" action="{{ route('post.destroy', ['post' => $post]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-link card-link">Удалить</button>
                                </form>
                                @endauth
                            </template>
                        </post-component>
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
                @include('widget.widget')
            </div>
        </div>
    </div>
@endsection
