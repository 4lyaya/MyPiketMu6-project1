<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TableExport implements FromView
{
    protected $data;
    protected $title;

    public function __construct($data, $title)
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function view(): View
    {
        return view('exports.excel_table', [
            'data' => $this->data,
            'title' => $this->title,
        ]);
    }
}