<?php

namespace App\Http\Controllers;

use App\Models\Post;


class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        foreach ($posts as $post) {
            dump($post->title);
        }
        dd($posts);
    }

    public function create()
    {
        $postsArr = [
            [
                "title"=> "title of hyety",
                "content" => "content hyeti",
                "image" => "hyeta.jpeg",
                "is_published" => 1
            ],
            [
                "title"=> "another title of hyety",
                "content" => "another content hyeti",
                "image" => "another hyeta.jpeg",
                "is_published" => 1
            ]
        ];

        foreach ($postsArr as $item) {
            //dd($item);
            Post::create($item);
        }



        dd("created");
    }

    public function update()
    {
        $post= Post::find(6);

        $post->update([
            "title"=> "updat1212ed",
            "content" => "11 updated",
        ]);
        dd("updated");
    }

    public function delete()
    {
        $post= Post::find(2);
        $post->delete();
        dd("deleted");
    }

    public function firstOrCreate()
    {

        $anotherPost = [
            "title"=> "some post",
            "content" => "some content",
            "image" => "some image",
            "is_published" => 1
        ];

        $post = Post::firstOrCreate([
            "title"=>"some title of hyety"
        ],[
            "title"=> "some title of hyety",
            "content" => "some content",
            "image" => "some image",
            "is_published" => 1
        ]);
        dump($post->content);
        dd("finish");
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            "title"=> "updateOrCreate some post",
            "content" => "updateOrCreate some content",
            "image" => "updateOrCreate some image",
            "is_published" => 0
        ];

        $post = Post::updateOrCreate([
            "title"=> "some title of not hyety",
        ],[
            "title"=> "some title of not hyety",
            "content" => "bleat updateOrCreate some content",
            "image" => "bleat updateOrCreate some image",
            "is_published" => 0
        ]);

        dump($post->content);

    }
}
