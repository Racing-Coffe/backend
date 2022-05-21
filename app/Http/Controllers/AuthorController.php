<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $Request)
    {
        return "index";
    }

    public function show(Request $Request)
    {
        return "show";
    }
}
