<?php


namespace App\Services;


use App\Model\PostModel;

class AddPostService
{
    public function saveAction($request)
    {
        $post = new PostModel();

        $post->title = $request->title;
        $post->text = $request->text;
        $post->user_id = $request->user_id;

        $post->save();

        return;
    }

}
