<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @property string $title
 * @property string $item_text
 * @property bool $is_open_source
 * @property string $website_url
 * @property string $logo
 */
class Tool extends Model
{
    use Sushi;

    public function getRows(): array
    {
        return [
            [
                'title' => 'Sharp',
                'item_text' => 'Des back-offices sur-mesure, pour une gestion intuitive et simplifiée.',
                'is_open_source' => true,
                'website_url' => 'https://sharp.code16.fr/',
                'logo' => asset('/img/tools/sharp.svg'),
            ],
            [
                'title' => 'Ozu',
                'item_text' => 'Création et mise à jour simplifiée de sites statiques avec Laravel.',
                'is_open_source' => false,
                'website_url' => 'https://ozu.code16.fr/',
                'logo' => asset('/img/tools/ozu.svg'),
            ]
        ];
    }
}
