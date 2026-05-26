<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')
            ->where(fn (Builder $query) => $query->where('is_ozu', false)->orWhereNull('is_ozu'))
            ->get();

        return view('pages.project-list', [
            'projects' => $projects,
            'tags' => $projects->flatMap(fn (Project $project) => $project->tags)->unique('id')->sortBy('order'),
        ]);
    }

    public function show(Project $project)
    {
        return view('pages.project', [
            'project' => $project,
            'relatedProjects' => Project::query()->where('id', '!=', $project->id)->get()
                ->sortByDesc(fn (Project $p) => $p->tags->pluck('id')->intersect($project->tags->pluck('id'))->count())
                ->take(2),
        ]);
    }
}
