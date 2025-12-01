<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Phiki\Adapters\Laravel\Facades\Phiki;
use Phiki\Grammar\Grammar;
use Phiki\Theme\Theme;

class Content extends Component
{
    public function __construct(
        public ?string $headingLevel = null,
    ) {
    }

    public function transform($slot): string
    {
        $content = trim($slot);

        $this->transformHeadings($content);
        $this->transformCodeBlocks($content);

        return $content;
    }

    public function getHeadingLevel(): ?int
    {
        return (int) str_replace('h', '', $this->headingLevel);
    }

    protected function transformHeadings(&$content): void
    {
        if ($this->headingLevel) {
            $level = $this->getHeadingLevel();
            $content = preg_replace_callback(
                "#(</?h)(\d)#",
                fn ($matches) => $matches[1].($level + $matches[2] - 1),
                $content
            );
        }
    }

    protected function transformCodeBlocks(&$content): void
    {
        $content = preg_replace_callback(
            '/<pre><code class="language-(\w+)">([\s\S]+?)<\/code><\/pre>/',
            fn ($matches) => Phiki::codeToHtml(
                html_entity_decode($matches[2]),
                Phiki::environment()->grammars->has($matches[1]) ? $matches[1] : Grammar::Txt,
                Theme::GithubLight
            ),
            $content
        );
    }

    public function render()
    {
        return view('components.content', [
            'self' => $this,
        ]);
    }
}
