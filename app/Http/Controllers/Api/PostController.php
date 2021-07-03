<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;
    private CategoryRepositoryInterface $categoryRepository;


    public function __construct(PostRepositoryInterface $postRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index() : JsonResponse{
        return response()->json($this->postRepository->listPosts());
    }
    public function showPosts() : JsonResponse{
        return response()->json($this->postRepository->myPosts());
    }
    public function show($post) : JsonResponse{
        return response()->json($this->postRepository->showPost($post));
    }
    public function createPost(StorePostRequest $request){
        return $this->postRepository->store($request->validated());
    }
}
