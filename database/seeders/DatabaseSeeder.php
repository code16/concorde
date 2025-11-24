<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Project::factory(4)->sequence(
            [
                'title' => 'Ambiance & Styles',
                'item_text' => 'Plateforme e-commerce et intranet intégrant paiement, Click & Collect, gestion des stocks et fidélité.',
                'tags' => ProjectTag::whereIn('label', ['Intranet', 'E-commerce'])->pluck('id'),
            ],
            [
                'title' => 'Sycomore',
                'item_text' => 'Site multilingue riche en contenus et données, alimenté par API et administré avec Sharp pour la gestion éditoriale.',
                'tags' => ProjectTag::whereIn('label', ['Site vitrine', 'API'])->pluck('id'),
            ],
            [
                'title' => 'Meisenthal France',
                'item_text' => 'Boutique événementielle à fort trafic administrée avec Sharp pour les produits, les stocks, la livraison et le Click & Collect.',
                'tags' => ProjectTag::whereIn('label', ['E-commerce'])->pluck('id'),
            ],
            [
                'title' => 'Agence Culturelle Grand Est',
                'item_text' => 'Plateforme e-commerce et intranet intégrant paiement, Click & Collect, gestion des stocks et fidélité.',
                'tags' => ProjectTag::whereIn('label', ['Site vitrine'])->pluck('id'),
            ],
        )->create();
    }
}
