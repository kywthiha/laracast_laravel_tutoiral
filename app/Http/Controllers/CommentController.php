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

    public function store(CommentRequest $request){
        $comment = $this->commentService->create($request);
        return $comment;
    }

    public function update(CommentUpdateRequest $request,Comment $comment){
        $comment = $this->commentService->update($request,$comment);
        return $comment;
    }
    public function destroy(Comment $comment){
        $this->commentService->delete($comment);
        return true;
    }

}
