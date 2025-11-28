<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTag;
use Illuminate\Support\Collection;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        /** @var ProjectTag[]|Collection<int,ProjectTag> $tags */
        $tags = $projects->flatMap(fn (Project $project) => $project->tags)->unique('id');

        return view('pages.project-index', [
            'projects' => $projects,
            'tags' => $tags,
        ]);
    }

    public function show(Project $project)
    {
        return view('pages.project', [
            'project' => $project,
        ]);
    }
}
