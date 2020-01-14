<?php

namespace App\Http\Controllers;

use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration');
    }

    public function store(Request $request, RegistrationService $service)
    {
        $service->saveAction($request);

        return view('registration');
    }
}
