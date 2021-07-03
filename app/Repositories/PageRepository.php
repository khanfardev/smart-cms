<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageRepository implements PageRepositoryInterface
{
    private Page $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function get()
    {

        return  $this->page->paginate(10);
    }

    public function show($page)
    {
        return $this->page->find($page);
    }

    public function store($data)
    {
        $data['user_id'] = Auth::user()->id;
        return $this->page->create($data);
    }

    public function update($page, $data)
    {
        return $page->update($data);
    }

    public function delete($page)
    {
        return $page->delete();
    }
}
