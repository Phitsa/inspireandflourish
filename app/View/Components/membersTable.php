<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class membersTable extends Component
{
    public int $totalMembers;
    public int $visitorsQuantity;
    public LengthAwarePaginator $members;
    public function __construct(int $totalMembers, int $visitorsQuantity, LengthAwarePaginator $members)
    {
        $this->totalMembers = $totalMembers;
        $this->visitorsQuantity = $visitorsQuantity;
        $this->members = $members;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.members-table');
    }
}
