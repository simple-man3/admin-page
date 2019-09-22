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
                        <post-editor :read-only="true"
                                     content="{{ $post->content }}"
                                     title="{{ $post->title }}"
                                     author="{{ $post->author->name }}"
                                     created-at="{{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d.m.Y H:i:s') }}"
                                     link="{{ route('post.show', ['post' => $post]) }}"
                                     link-name="Читать статью"
                                     link-edit="{{ route('post.edit', ['post' => $post]) }}"
                                     link-delete="{{ route('post.destroy', ['post' => $post]) }}"
                                     auth-user="{{ \Illuminate\Support\Facades\Auth::user() ? \Illuminate\Support\Facades\Auth::user()->name : '' }}"
                        ></post-editor>
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
                        {{--<h5 class="card-title">{{ __('Виджетов пока нет') }}</h5>--}}
                        {{--@auth--}}
                            {{--<div class="card-text">--}}
                                {{--<a href="#" class="btn btn-primary">Кнопка добавления нового виджета</a>--}}
                            {{--</div>--}}
                        {{--@endauth--}}
                        {!! (new \App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginManager())->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
