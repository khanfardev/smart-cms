<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private PageRepositoryInterface $pageRepository;
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }
    public function index():JsonResponse{
return response()->json($this->pageRepository->get());
    }
    public function show($page) :JsonResponse{
        return response()->json($this->pageRepository->show($page));

    }
}
