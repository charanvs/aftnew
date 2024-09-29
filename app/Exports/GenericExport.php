<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class GenericExport implements FromCollection, WithHeadings
{
    protected $table;

    // Constructor to receive the table name
    public function __construct($table)
    {
        $this->table = $table;
    }

    // Fetch the data from the specified table
    public function collection()
    {
        return DB::table($this->table)->get();
    }

    // Define the headings (columns) to be exported
    public function headings(): array
    {
        // Fetch column names dynamically from the database schema
        $columns = DB::getSchemaBuilder()->getColumnListing($this->table);

        return $columns;
    }
}

