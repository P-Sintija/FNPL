<?php

namespace App\Http\Controllers;

use App\Services\WebOutputService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private WebOutputService $webOutputService;

    public function __construct(WebOutputService $webOutputService)
    {
        $this->webOutputService = $webOutputService;
    }

    public function show(Request $request): View
    {
        $result = $this->webOutputService->getOutput($request['result']);
        return view('home', ['result' => $result]);
    }
}