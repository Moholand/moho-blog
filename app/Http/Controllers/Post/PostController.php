<?php

namespace App\Http\Controllers\Post;

use Carbon\Carbon;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.check', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['category', 'likes'])->get();

        return response()->json(['data' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = auth('api')->user()->posts()->make(
            $request->only(['title', 'content', 'category_id'])
        );
        
        // Save post image in public image/posts folder
        if($request->image) {
            $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
            $request->file('image')->storeAs('posts', $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return response()->json([
            'data' => $post,
            'message' => 'پست با موفقیت ایجاد شد'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the post with category and all the related comments
        $post = Post::where('id', $id)->with(['category', 'comments', 'likes'])->get();

        return response()->json(['data' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $post_id)
    {
        $post = Post::findOrFail($post_id);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        if($request->image) {
            // First Delete previous image
            File::delete(public_path('image/posts') . '/' . $post->image);

            $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
            $request->file('image')->storeAs('posts', $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return response()->json([
            'data' => $post,
            'message' => 'پست با موفقیت ویرایش شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // First Delete post image
        File::delete(public_path('image/posts') . '/' . $post->image);

        $post->delete();

        return response()->json([
            'message' => 'پست با موفقیت حذف شد'
        ]);
    }
}
