<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    public function __construct(CommentService $commentService, CommentRepository $commentRepository)
    {

        $this->commentService = $commentService;
        $this->commentRepository = $commentRepository;
    }

    public function index(Article $article){
        return $this->commentRepository->findByArticle($article);
    }

    public function store(CommentRequest $request,Article $article,Comment $comment){
        return $this->commentService->create($request,$article,$comment);
    }

    public function update(CommentRequest $request,Article $article,Comment $comment){
        $comment = $this->commentService->update($request,$comment);
        $comment->status = 1;
        return $comment;
    }
    public function destroy(Article $article,Comment $comment){
        $this->commentService->delete($comment);
        $comment->status = 1;
        return $comment;
    }

}
