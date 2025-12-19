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
            'projects' => Project::where('is_featured', true)->orderBy('order')->get(),
            'testimonials' => Testimonial::orderBy('order')->get(),
            'teamMembers' => TeamMember::where('active', true)->get(),
            'articles' => Article::orderBy('publication_date', 'desc')->take(2)->get(),
        ]);
    }
}
