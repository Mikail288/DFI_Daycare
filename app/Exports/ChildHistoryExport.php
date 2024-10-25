<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ChildHistoryExport implements FromView
{
    protected $child;
    protected $histories;

    public function __construct($child, $histories)
    {
        $this->child = $child;
        $this->histories = $histories;
    }

    public function view(): View
    {
        return view('excel.excel_child_history', [
            'child' => $this->child,
            'histories' => $this->histories
        ]);
    }
}
