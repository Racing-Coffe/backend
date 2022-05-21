<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends MainController
{
    public function index(Request $Request)
    {
        return "index";
    }

    public function show(Request $Request)
    {
        return "show";
    }

    public function showPosts(Request $Request)
    {
        return "show Posts";
    }

    protected function NotFound()
    {
        return response(['Error' => 'Tag not found'], 404);
    }
}
