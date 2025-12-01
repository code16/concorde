<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        return view('pages.home', [
            'projects' => Project::orderBy('order')->take(4)->get(),
            'testimonials' => Testimonial::orderBy('order')->get(),
            'teamMembers' => TeamMember::where('active', true)->orderBy('order')->get(),
            'articles' => Article::orderBy('publication_date', 'desc')->take(2)->get(),
        ]);
    }
}
