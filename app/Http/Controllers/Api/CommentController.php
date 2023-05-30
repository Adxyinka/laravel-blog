<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request; 
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function comments() : JsonResponse
    {

        $comments = Comment::all();
       // $categories = CategoryResource::collection($categories)->response()->getData(true);
       if(!empty($comments)){
        return response()->json([
            'message' => "Comments listed successfully",
              'data' => $comments,
             'status' => 200
        ]);
    } else {
        return \Response::json([
            'message' => 'No comments found',
            'status' => 404
        ]);
    }

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request) : JsonResponse
    {
        //
        $comment = Comment::create($request->validated());
         return response()->json([
            'message' => "Comment created successfully",
              'data' => $comment,
             'status' => 201
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $comment)
    {
        try {
            //code...
         $comment = Comment::findOrFail($comment);
         return response()->json([
            'message' => "comment showed successfully",
              'data' => $comment,
             'status' => 200
        ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
            'message' => "Comment was not found ",
             'status' => 404
        ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $comment) : JsonResponse
    {
        //
        $comment = Comment::find($comment);

        $comment->update([
            'comment' => $request->comment
        ]);

         return response()->json([
            'message' => "Comment Updated successfully",
              'data' => $comment,
             'status' => 200
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $comment)
    {
        //
         $comment = Comment::find($comment);
         $comment->delete();

          return response()->json([
            'message' => "comment delete successfully",
              'data' => $comment,
             'status' => 200
        ]);
    }
}
