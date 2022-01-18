<?php

namespace App\Http\Controllers\Post;

use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reply\CreateReplyRequest;
use App\Http\Requests\Reply\UpdateReplyRequest;

class CommentReplyController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReplyRequest $request, $comment_id)
    {
        $reply = auth('api')->user()->replies()->create([
            'content' => $request->content,
            'comment_id' => $comment_id
        ]);

        return response()->json([
            'data' => $reply,
            'message' => 'پاسخ به کامنت با موفقیت ایجاد شد'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyRequest $request, Comment $comment, Reply $reply)
    {
        $reply->update([
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'پاسخ به کامنت با موفقیت ویرایش شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, Reply $reply)
    {
        $reply->delete();

        return response()->json([
            'message' => 'پاسخ به کامنت با موفقیت حذف شد'
        ]);
    }
}
