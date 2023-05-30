<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function articles() :jsonresponse
    {
         $articles = Article::all();

        if(!empty($articles)){
            return \Response::json([
                'message' => 'Articles listed successfully',
                'data' => $articles,
                'status' => 200
            ]);

        } else {
            return \Response::json([
                'message' => 'No articles found',
                'status' => 404
            ]);
     }

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function createArticle(ArticleRequest $request) :jsonresponse
    {
        $article = Article::create($request->validated());

        return \Response::json([
            'message' => 'Article published successfully',
            'data' => $article,
            'status' => 201
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function showArticle(int $article) :jsonresponse
    {
        $article = Article::find($article);
        var_dump($article);
        if ($article === null) {
            
            return \Response::json([
                'message' => 'Article was not found',
                'status' => 404
            ]);
            } else {
                        return response()->json([
                            'message' => 'Article displayed successfully',
                            'data' => new ArticleResource($article),
                            'status' => 200
                        ]);
            }
        // try {
            
        //     if ($article === null) {
        //     return response()->json([
        //         'message' => 'Article displayed successfully',
        //         'data' => new ArticleResource($article),
        //         'status' => 200
        //     ]);
        //     }
        // } catch (\Throwable $th) {

        //     return \Response::json([
        //         'message' => 'Article was not found',
        //         'status' => 404
        //     ]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Article $article)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function updateArticle(Request $request, Article $article)
    {
        try {
            $article = Article::findOrFail($article);

            $article->update([
                'title' => $request->title,
                'body' => $request->body
            ]);

            return \Response::json([
                'message' => 'Article Updated succesfully',
                'data' => new ArticleResource($article),
                'status' => 200
            ]);
        } catch (\Throwable $th) {

            return \Response::json([
                'message' => 'Article was not found',
                'status' => 404
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteArticle(int $article) :jsonResponse
    {
        try {
            $article = Article::findOrFail($article);
            $article->delete();

            return \Response::json([
                'message' => 'Article deleted successfully',
                'data' => new ArticleResource($article),
                'status' => 200
            ]);
        } catch (\Throwable $th) {

            return \Response::json([
                'message' => 'Article was not found',
                'status' => 404
            ]);
        }
    }
}
