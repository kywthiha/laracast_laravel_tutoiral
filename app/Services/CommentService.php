<?php


namespace App\Services;


use App\Article;
use App\Comment;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function create(CommentRequest $request):Comment
    {
        /** @var Comment $comment */
        $comment = Comment::create([
            'user_id'=>Auth::id(),
            'text'=>$request->text,
            'article_id'=>$request->article_id,
            'comment_id'=>$request->comment_id
        ]);

        return $comment;
    }

    public function update(ArticleRequest $request,Article $article):Article
    {
        $article->update([
            'user_Id'=>Auth::id(),
            'title'=>$request->title,
            'body'=>$request->body,
            'except'=>$request->except
        ]);
        $article->tags()->sync($request->tags);
        return $article;
    }

    public function delete(Article $article):Article
    {
        $article->delete();
        return $article;
    }
}
