<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;
    private CategoryRepositoryInterface $categoryRepository;


    public function __construct(PostRepositoryInterface $postRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->get();
        return Inertia::render('Posts/Index', compact('posts'));
    }


    public function create()
    {
        $data['categories'] = $this->categoryRepository->get("all");
        $tags = Tag::all();
        return Inertia::render('Posts/Create', compact('data','tags'));


    }


    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $this->postRepository->store($data);
        session()->flash('flash.banner', 'new post created');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('posts.index');


    }



    public function show(Post $post)
    {

    }


    public function edit(Post $post)
    {
        $data['post'] = $this->postRepository->show($post);
        $data['categories']  = $this->categoryRepository->get('all');
        return Inertia::render('Posts/Create', $data);


    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $this->postRepository->update($post, $validated);
        session()->flash('flash.banner', "Post $post->title updated successfully");
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('posts.index');

    }


    public function destroy(Post $post)
    {
        $this->postRepository->delete($post);
        session()->flash('flash.banner', "Post $post->title deleted successfully");
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('posts.index');

    }
}
