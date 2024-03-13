<?php

namespace App\Http\Controllers\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $page = $data["page"] ?? 1;
        $per_page = $data["per_page"] ?? 10;

        $filter = app()->make(PostFilter::class, ["queryParams" => array_filter($data)]);

        $posts = Post::filter($filter)->paginate($per_page, ["*"], "page", $page);
        //$post = Post::where("is_published", 1)->get();
       //$posts = Post::paginate(10);

        //что бы отправить JSON ответ
        return PostResource::collection($posts);

        //return view("post.index", compact("posts"));
    }
}
