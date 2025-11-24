<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        return view('home', [
            'projects' => Project::take(4)->get(),
        ]);
    }
}
