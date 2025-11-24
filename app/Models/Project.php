<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    /** @var ProjectTag[] */
    public Collection $tags {
        get {
            return ProjectTag::query()
                ->whereIn('id', json_decode($this->getAttribute('tags') ?: '[]'))
                ->get();
        }
    }

    public function url(): string
    {
        return route('projects.show', $this);
    }
}
