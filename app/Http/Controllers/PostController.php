<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view("post.index", compact("posts"));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("post.create", compact("categories", "tags"));
    }

    public function store()
    {
        $data = request()->validate([
            "title" => "required|string",
            "content" => "string",
            "image" => "string",
            "category_id"=>"",
            "tags"=>"",
        ]);
        $tags = $data["tags"];
        unset($data["tags"]);
        $post = Post::create($data);
        $post->tags()->attach($tags);
//        foreach ($tags as $tag) {
//            PostTag::firstOrCreate([
//                "tag_id"=>$tag,
//                "post_id"=>$post->id,
//            ]);
//        }
        return redirect()->route("post.index");
    }

    public function show(Post $post)
    {
        //$post = Post::findOrFail($id); //id в параметрах функции
        return view("post.show", compact("post"));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("post.edit", compact("post", "categories", "tags"));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            "title" => "string",
            "content" => "string",
            "image" => "string",
            "category_id"=>"",
            "tags"=>"",
        ]);
        $tags = $data["tags"];
        unset($data["tags"]);

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route("post.show", $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("post.index");
    }

    public function delete()
    {
        $post = Post::find(2);
        $post->delete();
        dd("deleted");
    }

    public function firstOrCreate()
    {

        $anotherPost = [
            "title" => "some post",
            "content" => "some content",
            "image" => "some image",
            "is_published" => 1
        ];

        $post = Post::firstOrCreate([
            "title" => "some title of hyety"
        ], [
            "title" => "some title of hyety",
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
            "title" => "updateOrCreate some post",
            "content" => "updateOrCreate some content",
            "image" => "updateOrCreate some image",
            "is_published" => 0
        ];

        $post = Post::updateOrCreate([
            "title" => "some title of not hyety",
        ], [
            "title" => "some title of not hyety",
            "content" => "bleat updateOrCreate some content",
            "image" => "bleat updateOrCreate some image",
            "is_published" => 0
        ]);

        dump($post->content);

    }
}
