<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectKpi;
use App\Models\ProjectTag;
use App\Models\Testimonial;
use Code16\OzuClient\Eloquent\Media;
use Code16\OzuClient\Support\Database\OzuSeeder;
use Database\Seeders\concerns\SeedsArticles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class DatabaseSeeder extends OzuSeeder
{
    use WithoutModelEvents;
    use SeedsArticles;

    public function run(): void
    {
        $this->clearMediaDirectory();

        $this->seedProjects();

        Testimonial::factory([
            'title' => 'Ecofi',
            'content' => '“Une petite équipe qui a finalement tout d’une grande. On avance en toute confiance et le résultat final est toujours à la hauteur.”',
            'author_name' => 'Alain Canderlé',
            'author_role' => 'Directeur Général',
        ])
            ->has(Media::factory()->image()->withFile(__DIR__.'/../fixtures/testimonials/ecofi.svg'), 'logo')
            ->has(Media::factory()->image()->withFile(__DIR__.'/../fixtures/testimonials/ecofi-ceo.png'), 'authorPicture')
            ->create();

        Testimonial::factory([
            'title' => 'Sycomore AM',
            'content' => '“Leur expertise technique et leur rigueur ont fait la différence. Les échanges sont clairs, les délais tenus, et le suivi après mise en production est irréprochable. Nous avons été serein pendant tout le déroulé du projet.”',
            'author_name' => 'François Bonel',
            'author_role' => 'Chef de projet marketing',
        ])
            ->has(Media::factory()->image()->withFile(__DIR__.'/../fixtures/testimonials/sycomore.svg'), 'logo')
            ->has(Media::factory()->image()->withFile(__DIR__.'/../fixtures/testimonials/sycomore-po.png'), 'authorPicture')
            ->create();

        Testimonial::factory([
            'title' => 'Ek',
            'content' => '“Ce que j’apprécie le plus, c’est leur transparence et leur sens du détail. Ils expliquent tout clairement, cherchent toujours la meilleure solution, et on sait qu’on peut compter sur eux.”',
            'author_name' => 'Eric Holzinger',
            'author_role' => 'Directeur Général',
        ])
            ->has(Media::factory()->image()->withFile(__DIR__.'/../fixtures/testimonials/ek.svg'), 'logo')
            ->has(Media::factory()->image()->withFile(__DIR__.'/../fixtures/testimonials/ek-ceo.png'), 'authorPicture')
            ->create();

        collect(File::files(storage_path('legacy/posts')))
            ->each(function (SplFileInfo $file) {
                $parsed = $this->parseMarkdown($file->getContents());

                $this->articleFactoryFromLegacy($parsed)
                    ->has(
                        Media::factory()
                            ->image()
                            ->withFile($this->legacyPostThumbnailPath($parsed->getFrontMatter()['thumbnail'])),
                        'cover',
                    )
                    ->create();
            });
    }

    protected function seedProjects(): void
    {
        Project::factory([
            'title' => 'Ambiance & Styles <br> Culinarion',
            'item_text' => 'Plateforme e-commerce intégrant paiement, Click & Collect, Ship from Store, gestion des stocks et fidélité.',
            'heading_text' => 'Plateforme e-commerce intégrant paiement, Click & Collect, Ship from Store, gestion des stocks et fidélité.',
            'content' => '<p>conception, développement back et front, hébergement et suivi<br>
                    design graphique : <a href="https://fr.haigo.io">Haigo</a> (refonte 2024)</p>
                    <h1>Une centaine de magasins indépendants sous deux enseignes</h1>
                    <p>Le projet englobe deux sites internet, <a href="https://ambianceetstyles.com">ambianceetstyles.com</a> (environ 90 magasins) et <a href="https://www.culinarion.com">culinarion.com</a> (environ 50 magasins), permettant de les faire bénéficier des très nombreuses fonctionnalités communes en respectant les spécificités de chaque groupement.</p>
                    '.$this->makeImageEmbed(Media::factory()->image()->withFile(__DIR__.'/../fixtures/project/as.png')->make()).'
                    <h1>Click and Collect ou Ship from Store</h1>
                    <p>Le projet a été développé en tenant compte des caractéristiques spécifiques liées du commerce associé : chaque point de vente est indépendant, et fixe ses prix et son assortiment.</p>
                    <p>Le système permet aux nombreux clients des magasins des deux enseignes de passer commande dans l’assortiment commun aussi bien que parmi les articles locaux, soit en Click and Collect soit en livraison (Ship from Store, et dans ce cas un algorithme de sélection utilisant des critères de disponibilité de stock, proximité géographique, performances passées de traitement de commande, etc. permet de proposer la commande au bon magasin).</p>
                    '.$this->makeImageEmbed(Media::factory()->image()->withFile(__DIR__.'/../fixtures/project/as-mobile.png')->make()).'
                    <h1>Mise en œuvre d’une gestion multi-tenant</h1>
                    <p>Le système de gestion, développé avec Sharp pour Laravel, permet à la fois aux administrateurs d’EK France (la structure qui regroupe les deux enseignes) de gérer tout le contenu marketing, de suivre le traitement des commandes, d’administrer les accès et les magasins, d’organiser les paiements (et bien d’autres choses), et au personnel des magasins de traiter leurs commandes et leurs clients.</p>
                    '.$this->makeImageEmbed(Media::factory()->image()->withFile(__DIR__.'/../fixtures/project/as-sharp.png')->make()).'
                    <h1>Et bien d’autres fonctionnalités sur mesure</h1>
                    <p>L’application propose bien d’autres fonctionnalités, parmi lesquels : les listes de cadeau, store locator / store chooser, recherche à facettes, e-cartes cadeau, liste de favoris, coupons, promotions, offres commerciales, base de visuels / vidéos, intégration Google Shopping…</p>
                    <p>Le système est en outre relié à tout l’environnement technique d’EK France via des API : SSO (voir le projet Platina), CRM, fidélité, stock, clients, système de commandes, affranchissement / relais / enlèvement, plateformes de paiement (Payplug et Alma)…</p>',
            'tags' => ProjectTag::whereIn('label', ['E-commerce', 'Contenu', 'Performance'])->pluck('id'),
            'color' => '#862633',
            'website_url' => 'https://ambianceetstyles.com',
            'has_show_page' => true,
            'is_featured' => true,
        ])
            ->has(ProjectKpi::factory()->sequence(
                ['title' => '110', 'suffix' => 'k+', 'content' => 'comptes clients'],
                ['title' => '20', 'suffix' => 'k+', 'content' => 'articles en ligne à tout instant'],
                ['title' => '2015', 'suffix' => '', 'content' => 'mise en ligne'],
            )->count(3), 'kpis')
            ->has(Media::factory()->image()->withFile(__DIR__.'/../fixtures/project/as-cover.png'), 'cover')
            ->create();

        Project::factory([
            'title' => 'Sycomore AM',
            'item_text' => 'Site multilingue riche en contenus et données, alimenté par API et administré avec Sharp pour la gestion éditoriale.',
            'heading_text' => 'Site multilingue riche en contenus et données, alimenté par API et administré avec Sharp pour la gestion éditoriale.',
            'content' => '<p>développement back et front, hébergement et suivi</p>
                <p>conception et design graphique : <a href="https://structure.paris">Structure</a></p>
                <p>Sycomore AM est un investisseur se voulant responsable et engagé sur les questions sociales et environnementales, proposant des actifs financiers performants à ses clients particuliers et institutionnels dans douze pays.</p>
                <p>[video case]</p>
                <h1>Des contenus adaptés au visiteur</h1>
                <p>Pour se conformer à la législation et pour proposer la meilleure expérience possible de consultation, le site est décliné en cinq langues et propose un contenu différent en fonction du profil et du pays d’origine du visiteur. L’utilisation avancée de Sharp a permis de concevoir une interface de gestion des données adaptée à ce cas extrême.</p>
                <p>[screen sharp]</p>
                <h1>Mise en œuvre d’une API REST pour les mises à jour quotidiennes</h1>
                <p>Les nombreuses données des fonds, et en particulier leurs valeurs locatives, sont mises à jour très souvent. L’application propose aux administrateurs de Sycomore AM une API dédiée permettant l’automatisation et le suivi de ce processus de mise à jour.</p>
                <p>[screen page fonds]</p>
                <h1>La sécurité n’est pas une option</h1>
                <p>Sycomore AM, qui est associé au groupe Generali, a des attentes aussi fortes que légitimes sur le plan de la sécurité. Nous avons mis en place une infrastructure dédiée, respecté les meilleurs normes de développement et instauré des procédures de suivi et de mise à jour précises pour assurer cette mission au mieux.</p>',
            'tags' => ProjectTag::whereIn('label', ['Contenu', 'API', 'Multilinguisme'])->pluck('id'),
            'color' => '#0b0a0a',
            'accent_color' => '#fd612099',
            'has_show_page' => true,
            'is_featured' => true,
        ])
            ->has(ProjectKpi::factory()->sequence(
                ['title' => '120', 'suffix' => '', 'content' => 'variantes de contenu (5 langues, 12 pays, 2 profils)'],
                ['title' => '190', 'suffix' => '+', 'content' => 'parts gérées, dans 58 fonds'],
                ['title' => '30', 'suffix' => 'k+', 'content' => 'mises à jour par mois via l’API'],
            )->count(3), 'kpis')
            ->create();

        Project::factory([
            'title' => 'Meisenthal France',
            'item_text' => 'Boutique événementielle à fort trafic administrée avec Sharp pour les produits, les stocks, la livraison et le Click & Collect.',
            'heading_text' => 'Boutique événementielle à fort trafic administrée avec Sharp pour les produits, les stocks, la livraison et le Click & Collect.',
            'content' => '<p>développement back et front, hébergement et suivi, design</p>
                <h1>Une boutique événementielle…</h1>
                <p>La boutique en ligne du Centre International d’Art Verrier (CIAV) de Meisenthal est généralement ouverte 2 jours dans l’année. La session de Noël, courant novembre, propose uniquement le retrait sur place (Click and Collect), et celle du printemps (généralement en mars) la livraison. Le système permet de fonctionner dans les deux modes, avec une configuration précise des modalités (créneaux, points de retrait, frais de livraison, livreur, etc.).</p>
                <p>[screen rayon ou product]</p>
                <h1>… à très grand succès</h1>
                <p>Le produit phare est la boule de Noël, signée d’un designer différent chaque année. Une session de vente ne dure que quelques heures, puisque la totalité des 7000 et quelque boules, fabriquées artisanalement, est très rapidement achetée par un public de connaisseurs… La complexité est donc de mettre en œuvre une infrastructure résiliente, permettant de supporter de très importants pics de charge, et de ne perdre aucun paiement dans la bataille !</p>
                <p>[screen graph ventes, charge (sans échelle) ?]</p>
                <h1>Un <em>order management system</em> (OMS) sur mesure</h1>
                <p>La gestion des nombreuses commandes (tout comme toute l’administration du site) se fait via une instance de Sharp for Laravel, où il est possible de générer des bons de préparation et de modifier le statut de la commande, ce qui notifie le client.</p>
                <p>[screen sharp]</p>',
            'tags' => ProjectTag::whereIn('label', ['E-commerce', 'Performance'])->pluck('id'),
            'has_show_page' => true,
            'is_featured' => true,
        ])
            ->has(ProjectKpi::factory()->count(3), 'kpis')
            ->create();

        Project::factory([
            'title' => 'Agence culturelle Grand Est',
            'item_text' => 'Portail orienté contenu, plateforme de gestion de formations, SSO dédié.',
            'heading_text' => 'Portail orienté contenu, plateforme de gestion de formations, SSO dédié.',
            'content' => '<p>conception, développement back et front, hébergement et suivi</p>
                <p>design graphique : <a href="https://www.atelierposte4.com">Atelier Poste 4</a></p>
                <h1>Un portail au contenu très riche et mouvant</h1>
                <p>L’Agence culturelle Grand Est nous fait confiance pour plusieurs de ses projets web, dont le plus visible : son portail principal, reflet de ses activités diverses et changeantes dans le temps.</p>
                <p>[screen homepage]</p>
                <h1>Cursus, la plateforme dédiée de gestion de formations</h1>
                <p>L’Agence propose de nombreuses formations à ses publics tout au long de l’année : certaines sont payantes et concernent des petites jauges, d’autres sont des conférences pour lesquelles il faut un système de contrôle de billets. Le système permet l’inscription simple, multiple, les candidatures avec dossier, divers choix d’options, et différents types de paiement.</p>
                <p>[screen / video register]</p>
                <h1>Sola, le SSO dédié de l’Agence</h1>
                <p>Tous les usagers de l’Agence, ainsi que tout son personnel, passent par Sola, un Single Sign On développé spécialement pour se connecter aux nombreuses applications internes et publiques.</p>
                <p>[screen sola]</p>
                <h1>Une console d’administration complète et sur mesure</h1>
                <p>La console d’administration, développée avec Sharp, permet de saisir tout le contenu du site, mais aussi de gérer entièrement les formations Cursus, de la page d’inscription à la facturation.</p>
                <p>[video Sharp Cursus ?]</p>',
            'tags' => ProjectTag::whereIn('label', ['Contenu', 'E-commerce', 'SSO'])->pluck('id'),
            'color' => '#3800ff',
            'has_show_page' => true,
            'is_featured' => true,
        ])
            ->has(ProjectKpi::factory()->sequence(
                ['title' => '10', 'suffix' => 'k+', 'content' => 'comptes usagers Sola'],
                ['title' => '7200', 'suffix' => '+', 'content' => 'inscriptions à des formations Cursus'],
                ['title' => '2017', 'suffix' => '', 'content' => 'mise en ligne'],
            )->count(3), 'kpis')
            ->create();

        Project::factory([
            'title' => 'EK France',
            'item_text' => null,
            'heading_text' => null,
            'content' => '<h1>Une boite à outils pour les responsables de magasins EK France</h1>
                <p>Platina est une application qui offre aux membres des réseaux de magasins gérés par EK France (dont Ambiance & Styles et Culinarion) divers outils centraux pour leur gestion commerciale et marketing, ainsi qu’une plateforme d’échange avec les autres magasins et les gérants de la centrale.</p>
                <p>[screen home]</p>
                <h1>Gestion des commandes de produits et de matériel, outil de PLV</h1>
                <p>Les gestionnaires de magasins doivent régulièrement passer commande auprès de leurs fournisseurs via la centrale, par exemple pour acheter les produits d’un catalogue national ; cette tâche était auparavant manuelle et fastidieuse. Platina permet de réaliser cette opération en ligne, via un formulaire simple agrégeant automatiquement les données centralisées (produits, tarifs, conditions de vente…) et celles du magasin (stocks, conditions particulières).</p>
                <p>[screen gestion frs]</p>
                <p>Un autre outil permet de créer graphiquement, à partir de données graphiques proposées par la centrale, des étiquettes et pannonceaux à afficher dans le magasin.</p>
                <p>[screen étiquettes]</p>
                <h1>Outils de communication / réseau social</h1>
                <p>Platina propose de nombreux outils lui permettant de mériter son titre de réseau social des magasins du groupement : une messagerie / chat privée, une plateforme de dépannage pour s’échanger des produits en cas de rupture, un forum de discussion avec un système de réaction et de commentaires, des notifications, une modération, etc.</p>
                <p>[screen dépannage]</p>
                <h1>Publication de messages, vidéos, documents</h1>
                <p>Les administrateurs EK France gèrent tout ce contenu via une instance de Sharp for Laravel, dans laquelle ils peuvent également déposer des messages généraux, des vidéos (de démonstration de produit par exemple), et les nombreux documents de la base de ressources du groupement.</p>
                <p>[screen documents]</p>
                <p>Le système est accessible à tous les utilisateurs via un SSO dédié, appelé Solek, qui sert aussi de plateforme de connexion à l’administration <em>multi-tenant</em> des sites Ambiance & Styles et Culinarion.</p>',
            'tags' => ProjectTag::whereIn('label', ['API', 'Intranet', 'SSO'])->pluck('id'),
            'color' => '#354B54',
            'has_show_page' => true,
        ])
            ->has(ProjectKpi::factory()->sequence(
                ['title' => '200', 'suffix' => '+', 'content' => 'utilisateurs'],
                ['title' => '7200', 'suffix' => '+', 'content' => 'commandes fournisseurs traités'],
                ['title' => '15k', 'suffix' => '+', 'content' => 'étiquettes de PLV'],
            )->count(3), 'kpis')
            ->create();

        Project::factory([
            'title' => 'Comédie de Colmar',
            'tags' => ProjectTag::whereIn('label', ['Contenu'])->pluck('id'),
            'has_show_page' => false,
            'website_url' => 'https://comedie-colmar.com',
            'cta_label' => 'Voir le site Comédie de Colmar'
        ])
            ->create();
    }
}
