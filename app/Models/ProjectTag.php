<?php

namespace App\Models;

use App\Enums\TagColor;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @property int $id
 * @property string $label
 * @property TagColor $color
 * @property int $order
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
            ['id' => 1, 'label' => 'Contenu', 'color' => TagColor::Green, 'order' => 1],
            ['id' => 2, 'label' => 'E-commerce', 'color' => TagColor::Purple, 'order' => 2],
            ['id' => 3, 'label' => 'Intranet', 'color' => TagColor::Fuchsia, 'order' => 3],
            ['id' => 4, 'label' => 'Multilinguisme', 'color' => TagColor::Blue, 'order' => 4],
            ['id' => 5, 'label' => 'SSO', 'color' => TagColor::Yellow, 'order' => 5],
            ['id' => 6, 'label' => 'API', 'color' => TagColor::Cyan, 'order' => 6],
            ['id' => 7, 'label' => 'Performance', 'color' => TagColor::Gray, 'order' => 8],
            ['id' => 8, 'label' => 'Sécurité', 'color' => TagColor::Orange, 'order' => 7],
        ];
    }
}
