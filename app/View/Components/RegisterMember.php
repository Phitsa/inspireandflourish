<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegisterMember extends Component
{
    public string $dialogName;

    public function __construct(string $dialogName)
    {
        $this->dialogName = $dialogName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.register-member');
    }
}
