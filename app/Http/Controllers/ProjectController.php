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
        $tags = $projects->flatMap(fn (Project $project) => $project->tags)->unique('id')->sortBy('order');

        return view('pages.project-list', [
            'projects' => $projects,
            'tags' => $tags,
        ]);
    }

    public function show(Project $project)
    {
        return view('pages.project', [
            'project' => $project,
            'relatedProjects' => Project::query()->where('id', '!=', $project->id)->get()
                ->sortByDesc(function (Project $p) use ($project) {
                    return $p->tags->pluck('id')->intersect($project->tags->pluck('id'))->count();
                })
                ->take(2),
        ]);
    }
}
