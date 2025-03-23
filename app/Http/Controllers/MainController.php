<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $content = News::all();
        return view('beranda', ['content' => $content]);
    }
}
