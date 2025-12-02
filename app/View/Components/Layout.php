<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public function __construct(
        public bool $home = false,
        public ?string $themePrimary = null,
        public ?string $themeAccent = null,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('layouts.app');
    }
}
