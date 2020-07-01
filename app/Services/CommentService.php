<?php


namespace App\Services;


use App\Article;
use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function create(CommentRequest $request,Article $article,Comment $comment): Comment
    {
        $newComment = new Comment();
        if($comment->id){
            $newComment = $comment->comments()->create([
                'user_id'=>Auth::id(),
                'text'=>$request->text,
            ]);
        }
        else{
            $newComment = $article->comments()->create([
                'user_id'=>Auth::id(),
                'text'=>$request->text,
            ]);
        }

        return $newComment;
    }

    public function update(CommentRequest $request,Comment $comment):Comment
    {
        $comment->update([
            'text'=>$request->text
        ]);
        return $comment;
    }

    public function delete(Comment $comment):bool
    {
        try {
            $comment->delete();
        } catch (Exception $e) {
        } catch (Exception $e) {
        }
        return true;
    }
}
