<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class StoreController extends BaseController
{
   public function __invoke(StoreRequest $request)
   {

       $data = $request->validated();

       //находится в сервисе
//       $tags = $data["tags"];
//       unset($data["tags"]);
//       $post = Post::create($data);
//       $post->tags()->attach($tags);

       $post = $this->service->store($data);

       if ($post instanceof Post) {
           return new PostResource($post);
       } else {
           return $post;
       }

       //return redirect()->route("post.index");

//        foreach ($tags as $tag) {
//            PostTag::firstOrCreate([
//                "tag_id"=>$tag,
//                "post_id"=>$post->id,
//            ]);
//        }
   }
}
