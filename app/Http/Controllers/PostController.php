<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DOMDocument;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $super_user=0;
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $postsItems = collect($posts->items());

        $postsItems->each(function ($item, $key) {
            $item->content = Str::limit($item->content, 1200);
        });
        $posts->setCollection($postsItems); // TODO find better solution

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Валидация полученных данных
        $validated_data = \Validator::make($request->all(), [
            'slug' => ['required', 'min:2', 'max:256'],
            'content' => ['required', 'min:4']
        ], [
            'slug.required' => __('Поле slug должно быть заполнено'),
            'slug.min' => __('Длина поля slug слишком мала. Минимальная длина: :min символов'),
            'slug.max' => __('Длина поля slug слишком велика. Максимальная длина: :max символов'),
            'content.required' => __('Содержимое статьи не должно быть пустым'),
            'content.min' => __('Содержимое статьи не должно быть длиной не меньше :min символов'),
        ])->validate();

        $dom = new DOMDocument;
        $dom->loadHTML($validated_data['content']);
        $title = $dom->getElementsByTagName('h1')->item(0)->nodeValue;


        $post = new Post();
        $post->title = $title;
        $post->slug = $validated_data['slug'];
        $post->content = $validated_data['content'];
        $post->author_id = Auth::user()->id;
        $result = $post->save();

        return json_encode([
            'result' => $result,
            'redirectUrl' => route('post.index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Валидация полученных данных
        $validated_data = \Validator::make($request->all(), [
            'slug' => ['required', 'min:2', 'max:256'],
            'content' => ['required', 'min:4']
        ], [
            'slug.required' => __('Поле slug должно быть заполнено'),
            'slug.min' => __('Длина поля slug слишком мала. Минимальная длина: :min символов'),
            'slug.max' => __('Длина поля slug слишком велика. Максимальная длина: :max символов'),
            'content.required' => __('Содержимое статьи не должно быть пустым'),
            'content.min' => __('Содержимое статьи не должно быть длиной не меньше :min символов'),
        ])->validate();

        $dom = new DOMDocument;
        $dom->loadHTML($validated_data['content']);
        $title = $dom->getElementsByTagName('h1')->item(0)->nodeValue;


        $post->title = $title;
        $post->slug = $validated_data['slug'];
        $post->content = $validated_data['content'];
        $post->author_id = Auth::user()->id;
        $result = $post->save();

        return json_encode([
            'result' => $result,
            'redirectUrl' => route('post.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();

        return redirect()->route('post.index');
    }
}
