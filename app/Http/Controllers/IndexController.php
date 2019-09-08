<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    /**
     * Show the application main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $postsItems = collect($posts->items());

        $postsItems->each(function ($item, $key) {
            $item->content = Str::limit($item->content, 1200);
        });
        $posts->setCollection($postsItems); // TODO find better solution

        return view('index', [
            'posts' => $posts,
        ]);
    }
}
