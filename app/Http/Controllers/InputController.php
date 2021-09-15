<?php

namespace App\Http\Controllers;

use App\Services\WebOutputService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InputController extends Controller
{
    private WebOutputService $webOutputService;

    public function __construct(WebOutputService $webOutputService)
    {
        $this->webOutputService = $webOutputService;
    }

    public function execute(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'image' => 'mimes:txt'
        ]);
        $result = $this->webOutputService->execute($request, $_FILES['image']);
        $result = $this->webOutputService->getResult();
        return Redirect::route('home.show', ['result' => $result]);
    }
}
