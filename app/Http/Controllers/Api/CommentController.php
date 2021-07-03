<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CommentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentRepositoryInterface $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function store(StoreCommentRequest $request,$post) :JsonResponse{
        $data = $request->validated();
        $this->commentRepository->store($data,$post);
        return response()->json(['message' => '“Comment Create successfully']);
    }
    public function update(UpdateCommentRequest $request, $comment) :JsonResponse{
        $data = $request->validated();
        $this->commentRepository->update($data,$comment);
        return response()->json(['message' => '“Comment Update successfully']);

    }
}
