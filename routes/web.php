<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/anonymous-global-scope', function () {
    $posts = Post::get();
    // $posts = Post::withoutGlobalScope('year')->get(); removendo o escopo global anônimo

    return $posts;
});

Route::get('/local-scope', function () {
    // $posts = Post::lastWeek()->get();
    // $posts = Post::today()->get();
    $posts = Post::between('2023-01-01', '23-12-31')->get();

    return $posts;
});

Route::get('/mutators', function () {
    $user = User::first();

    $post = Post::create([
        'user_id' => $user->id,
        'title' => Str::random(5),
        'body' => 'conteúdo',
        'date' => now(),
    ]);

    return $post;
});

Route::get('/posts/delete/{postId}', function (int $postId) {
    $post = Post::find($postId);

    $post->delete();

    return 'Post deleted';
});

Route::get('/posts/update/{postId}', function (int $postId) {
    $post = Post::findOrFail($postId);

    $post->update([
        'title' => 'Primeiro Post - Atualizado',
    ]);

    return $post;
});

Route::get('/insert2', function (Request $request) {
    Post::create($request->all());

    $posts = Post::all();

    return $posts;
});

Route::get('/posts', function () {
    $post = Post::first();

    return $post;
});

Route::get('/insert', function (Post $post) {
    $post->user_id = 2;
    $post->title = Str::random();
    $post->body = 'Conteúdo do post';
    $post->date = now();
    $post->save();

    $posts = Post::get();

    return $posts;
});

Route::get('/orderby', function (User $user) {
    $asc = $user->orderBy('name')->get(); // Por default é asc
    $desc = $user->orderBy('name', 'desc')->get();

    return $desc;
});

Route::get('/pagination', function (User $user) {
    $filter = request('filter');
    $perPage = request('perPage', 10);

    $users = $user->where('name', 'LIKE', "%{$filter}%")->paginate($perPage); // o paginate, por default é 15

    return $users;
});

Route::get('/where', function (User $user) {
    $filter = 'ab';

    $users = $user->where('name', 'LIKE', "%{$filter}%")
        ->orWhere(function ($query) {
            $query->where('name', '!=', 'Carlos');
        })
        ->toSql();

    return $users;
});

Route::get('/', function () {
    return view('welcome');
});
