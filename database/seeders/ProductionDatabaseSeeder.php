<?php

namespace Database\Seeders;


use Code16\OzuClient\Eloquent\Media;
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
            ->sortBy(fn (SplFileInfo $file) => $file->getFilename())
            ->values()
            ->each(function (SplFileInfo $file, int $index) {
                $parsed = $this->parseMarkdown($file->getContents());

                /** @noinspection LaravelFunctionsInspection */
                $id = env('BASE_ID') ? env('BASE_ID') + $index : null;
                $article = $this->articleFactoryFromLegacy(
                    $parsed,
                    handleImageEmbed: function ($legacyPath) use ($id) {
                        if($id) {
                            $media = Media::factory(['model_type' => 'Editor', 'model_id' => $id])->image()
                                ->withFile($this->legacyPostThumbnailPath($legacyPath))->make(['disk' => 'public']);

                            File::copyDirectory(dirname($this->legacyPostThumbnailPath($legacyPath)), storage_path("legacy/posts/img/$id"));
                            $media->file_name = str_replace('/medias/', '/concorde/', $media->file_name);
                            return $this->makeImageEmbed($media);
                        }

                        return sprintf('<p><strong><em>Image : %s</em></strong></p>', $legacyPath);
                    },
                    handleVideoEmbed: function ($legacyPath) use ($id) {
                        if($id) {
                            $media = Media::factory(['model_type' => 'Editor', 'model_id' => $id])->file()
                                ->withFile($this->legacyPostThumbnailPath($legacyPath))->make(['disk' => 'public']);

                            File::copyDirectory(dirname($this->legacyPostThumbnailPath($legacyPath)), storage_path("legacy/posts/img/$id"));
                            $media->file_name = str_replace('/medias/', '/concorde/', $media->file_name);
                            return $this->makeFileEmbed($media);
                        }

                        return sprintf('<p><strong><em>Video : %s</em></strong></p>', $legacyPath);
                    }
                )->make();

                $this->createInOzu($article)
                    ->withFile('cover', $this->legacyPostThumbnailPath($parsed->getFrontMatter()['thumbnail']));
            });
    }

    protected function makeImageEmbed(?Media $media = null, ?string $legend = null): string
    {
        $media ??= Media::factory()->image()->withFile()->make();

        return sprintf(
            '<x-ozu-content-image file="%s" legend="%s"></x-ozu-content-image>',
            e(json_encode([
                'file_name' => $media->file_name,
                'disk' => $media->disk,
                'mime_type' => $media->mime_type,
                'filters' => $media->filters,
            ])),
            $legend ?: ''
        );
    }

    protected function makeFileEmbed(?Media $media, ?string $legend = null): string
    {
        $media ??= Media::factory()->image()->withFile()->make();

        return sprintf(
            '<x-ozu-content-file file="%s" legend="%s"></x-ozu-content-file>',
            e(json_encode([
                'file_name' => $media->file_name,
                'disk' => $media->disk,
                'mime_type' => $media->mime_type,
            ])),
            $legend ?: ''
        );
    }
}
