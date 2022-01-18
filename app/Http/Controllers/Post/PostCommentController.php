<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;

class PostCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request, $post_id)
    {
        $comment = auth('api')->user()->comments()->create([
            'content' => $request->content,
            'post_id' => $post_id
        ]);

        return response()->json([
            'data' => $comment,
            'message' => 'کامنت شما با موفقیت ایجاد شد'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Post $post, Comment $comment)
    {
        $comment->update([
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'کامنت شما با موفقیت ویرایش شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'کامنت با موفقیت حذف شد'
        ]);
    }
}
