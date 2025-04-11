<?php

namespace App\View\Components;

use App\Models\Member;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class table extends Component
{
    public array $columns;
    public LengthAwarePaginator $datas;
    public array $tableColumns;
    public function __construct(array $columns = [], LengthAwarePaginator $datas, array $tableColumns = [])
    {
        $this->datas = $datas;
        $this->columns = $columns;
        $this->tableColumns = $tableColumns;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
