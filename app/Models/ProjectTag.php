<?php

namespace App\Models;

use App\Enums\TagColor;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @property int $id
 * @property string $label
 * @property TagColor $color
 */
class ProjectTag extends Model
{
    use Sushi;

    protected function casts(): array
    {
        return [
            'color' => TagColor::class,
        ];
    }

    public function getRows(): array
    {
        return [
            ['id' => 1, 'label' => 'Contenu', 'color' => TagColor::Green],
            ['id' => 2, 'label' => 'E-commerce', 'color' => TagColor::Purple],
            ['id' => 3, 'label' => 'Intranet', 'color' => TagColor::Fuchsia],
            ['id' => 4, 'label' => 'Multilinguisme', 'color' => TagColor::Blue],
            ['id' => 5, 'label' => 'SSO', 'color' => TagColor::Blue], // TODO color
            ['id' => 6, 'label' => 'API', 'color' => TagColor::Orange],
            ['id' => 7, 'label' => 'Performance', 'color' => TagColor::Orange], // TODO color
            ['id' => 8, 'label' => 'Sécurité', 'color' => TagColor::Orange], // TODO color
        ];
    }
}
