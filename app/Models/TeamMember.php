<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @property int $id
 * @property string $name
 * @property string $role
 * @property string $picture
 * @property string $squarePicture
 * @property bool $active
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
                'picture' => asset('/img/team-members/philippe.jpg'),
                'squarePicture' => asset('/img/team-members/philippe-square.jpg'),
                'active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Antoine Guingand',
                'role' => 'Développeur',
                'picture' => asset('/img/team-members/antoine.jpg'),
                'squarePicture' => null,
                'active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Lucien Puget',
                'role' => 'Développeur • DevOps',
                'picture' => asset('/img/team-members/lucien.jpg'),
                'squarePicture' => null,
                'active' => true,
            ],
            [
                // Keep Arnaud because he has blog posts
                'id' => 4,
                'name' => 'Arnaud Becher',
                'role' => 'Développeur',
                'picture' => null,
                'squarePicture' => asset('/img/team-members/arnaud-square.png'),
                'active' => false,
            ],
        ];
    }
}
