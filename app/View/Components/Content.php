<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;

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

    public function render()
    {
        return view('components.content', [
            'self' => $this,
        ]);
    }
}
