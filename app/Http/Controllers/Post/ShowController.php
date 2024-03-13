<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


class ShowController extends BaseController
{
   public function __invoke(Post $post)
   {
       return new PostResource($post);
       //$post = Post::findOrFail($id); //id в параметрах функции
       //return view("post.show", compact("post"));
   }
}
