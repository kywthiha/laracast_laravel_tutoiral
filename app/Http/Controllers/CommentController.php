<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\CommentRequest;
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

    public function store(CommentRequest $request,Article $article){
        return "HELLO";
    }
}
