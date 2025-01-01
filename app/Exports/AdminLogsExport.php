<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminLogsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        return $this->logs;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Admin',
            'Action',
            'Description',
            'Date'
        ];
    }

    public function map($log): array
    {
        return [
            $log->id,
            $log->admin->name ?? 'N/A',
            $log->action,
            $log->description,
            $log->formatted_date
        ];
    }
}
