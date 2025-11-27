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
            ['id' => 1, 'label' => 'Intranet', 'color' => TagColor::Fuchsia],
            ['id' => 2, 'label' => 'E-commerce', 'color' => TagColor::Purple],
            ['id' => 3, 'label' => 'API', 'color' => TagColor::Orange],
            ['id' => 4, 'label' => 'Contenu', 'color' => TagColor::Green],
            ['id' => 5, 'label' => 'Multilinguisme', 'color' => TagColor::Blue],
            ['id' => 6, 'label' => 'SSO', 'color' => TagColor::Blue], // TODO color
        ];
    }
}
