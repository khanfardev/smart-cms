<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function get($filter = 'paginate')
    {

        return $filter == 'all' ? $this->category->all() : $this->category->paginate(10);
    }

    public function show($category)
    {
        return $category;
    }

    public function store($data)
    {
        return $this->category->create($data);
    }

    public function update($category, $data)
    {
        return $category->update($data);
    }

    public function delete($category)
    {
        return $category->delete();
    }
}
