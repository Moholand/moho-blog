<?php

namespace App\Http\Controllers\Post;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostLikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        auth('api')->user()->likes()->create([
            'post_id' => $post_id
        ]);

        return response()->json(['message' => 'پست لایک شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Like $like)
    {
        $like->delete();

        return response()->json(['message' => 'لایک حذف شد']);
    }
}
