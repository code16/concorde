<?php

namespace Database\Seeders\concerns;

use App\Models\Article;
use Code16\OzuClient\Eloquent\Media;
use Database\Factories\ArticleFactory;
use Illuminate\Support\Carbon;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

trait SeedsArticles
{
    protected function articleFactoryFromLegacy(RenderedContentWithFrontMatter $parsed, bool $production = false): ArticleFactory
    {
        $frontMatter = $parsed->getFrontMatter();

        return Article::factory([
            'title' => str($frontMatter['title'])->rtrim('.'),
            'slug' => str($frontMatter['title'])->slug(),
            'category_label' => '',
            'publication_date' => Carbon::parse($frontMatter['date'])->format('Y-m-d'),
            'author_id' => match($frontMatter['author']) {
                'philippe' => 1,
                'arnaud' => 4,
            },
            'content' => transform($parsed->getContent(), function ($content) use ($production) {
                $content = preg_replace_callback('/<p>(<img src="([^"]+)" alt="([^"]*)" \/>)<\/p>/', function ($matches) use ($production) {
                    return $production
                        ? sprintf('<p>%s</p>', e($matches[1]))
                        : $this->makeImageEmbed(
                            Media::factory()->image()->withFile($this->legacyPostThumbnailPath($matches[2]))->make(),
                        );
                }, $content);

                $content = preg_replace_callback('/<video [^>]+>([\s\S]+?)<\/video>/', function ($matches) use ($production) {
                    if (preg_match('/src="([^"]+)"/', $matches[1], $srcMatches)
                        && file_exists($this->legacyPostThumbnailPath($srcMatches[1]))
                        && !$production
                    ) {
                        return $this->makeFileEmbed(
                            Media::factory()->file()->withFile($this->legacyPostThumbnailPath($srcMatches[1]))->make()
                        );
                    }
                    return sprintf('<p>%s</p>', e($matches[0]));
                }, $content);

                $content = str_replace(['<h2>', '</h2>', '<h3>', '</h3>'], ['<h1>', '</h1>', '<h2>', '</h2>'], $content);
                $content = preg_replace('/https:\/\/code16.fr\/posts\/([a-z0-9-]+)\//', '/blog/$1', $content);

                return $content;
            }),
        ]);
    }

    protected function legacyPostThumbnailPath(string $path): string
    {
        return str($path)
            ->replace('/assets/img/posts', storage_path('legacy/posts/img'))
            ->value();
    }

    protected function parseMarkdown(string $markdown): RenderedContentWithFrontMatter
    {
        $environment = new Environment([]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());

        return new MarkdownConverter($environment)->convert($markdown);
    }
}
