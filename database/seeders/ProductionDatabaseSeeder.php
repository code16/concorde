<?php

namespace Database\Seeders;


use Code16\OzuClient\Support\Database\OzuProductionSeeder;
use Database\Seeders\concerns\SeedsArticles;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class ProductionDatabaseSeeder extends OzuProductionSeeder
{
    use SeedsArticles;

    public function run(): void
    {
        collect(File::files(storage_path('legacy/posts')))
            ->each(function (SplFileInfo $file) {
                $parsed = $this->parseMarkdown($file->getContents());

                $this->createInOzu($this->articleFactoryFromLegacy($parsed, production: true)->make())
                    ->withFile('cover', $this->legacyPostThumbnailPath($parsed->getFrontMatter()['thumbnail']));
            });
    }
}
