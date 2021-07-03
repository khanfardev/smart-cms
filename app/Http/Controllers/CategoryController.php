<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function index()
    {
        $categories = $this->categoryRepository->get("paginate");
        return Inertia::render('Categories/Index', compact('categories'));

    }

    public function create()
    {
        return Inertia::render('Categories/Create');

    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $this->categoryRepository->store($data);
        session()->flash('flash.banner', 'new category created');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('categories.index');

    }

    public function show(Category $category)
    {
        //
    }
    public function edit(Category $category)
    {
        $data['category'] = $this->categoryRepository->show($category);
        return Inertia::render('Categories/Create', $data);

    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $this->categoryRepository->update($category, $validated);
        session()->flash('flash.banner', "Name $category->name updated successfully");
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('categories.index');
    }


    public function destroy(Category $category)
    {
        $this->categoryRepository->delete($category);
        session()->flash('flash.banner', "Category $category->name deleted successfully");
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('categories.index');

    }
}
