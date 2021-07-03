<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    private PageRepositoryInterface $pageRepository;


    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }


    public function index()
    {
    $pages = $this->pageRepository->get();
        return Inertia::render('Pages/Index', compact('pages'));

    }


    public function create()
    {
        return Inertia::render('Pages/Create');

    }


    public function store(StorePageRequest $request)
    {
        $data = $request->validated();
        $this->pageRepository->store($data);
        session()->flash('flash.banner', 'new page created');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('pages.index');

    }


    public function show(Page $page)
    {
        //
    }


    public function edit(Page $page)
    {
        $data['page'] = $this->pageRepository->show($page);
        return Inertia::render('Pages/Create',$data);


    }


    public function update(UpdatePageRequest $request, Page $page)
    {
        $validated = $request->validated();
        $this->pageRepository->update($page, $validated);
        session()->flash('flash.banner', "Page $page->title updated successfully");
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('pages.index');

    }


    public function destroy(Page $page)
    {
        $this->pageRepository->delete($page);
        session()->flash('flash.banner', "Page $page->title deleted successfully");
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('pages.index');

    }
}
