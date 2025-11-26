<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @property int $id
 * @property string $name
 * @property string $role
 * @property string $photo
 */
class TeamMember extends Model
{
    use Sushi;

    public function getRows(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Philippe Lonchampt',
                'role' => 'Fondateur • Développeur',
                'photo' => asset('/img/team-members/philippe.jpg'),
            ],
            [
                'id' => 2,
                'name' => 'Antoine Guingand',
                'role' => 'Développeur',
                'photo' => asset('/img/team-members/antoine.jpg'),
            ],
            [
                'id' => 3,
                'name' => 'Lucien Puget',
                'role' => 'Développeur • DevOps',
                'photo' => asset('/img/team-members/lucien.jpg'),
            ],
        ];
    }
}
