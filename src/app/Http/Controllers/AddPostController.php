<?php

namespace App\Http\Controllers;

use App\Model\UserRegistrationModel;
use App\Services\AddPostService;
use Illuminate\Http\Request;

class AddPostController extends Controller
{
    public function index()
    {
        $users = UserRegistrationModel::all();

        return view('addPost', compact('users'));
    }

    public function store(Request $request, AddPostService $service)
    {
        $service->saveAction($request);

        $users = UserRegistrationModel::all();

        return view('addPost', compact('users'));
    }
}
