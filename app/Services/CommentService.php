<?php


namespace App\Services;


use App\Article;
use App\Comment;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
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

    public function update(CommentUpdateRequest $request,Comment $comment):Comment
    {
        $comment->update([
            'text'=>$request->text
        ]);
        return $comment;
    }

    public function delete(Comment $comment):bool
    {
        $comment->delete();
        return true;
    }
}
