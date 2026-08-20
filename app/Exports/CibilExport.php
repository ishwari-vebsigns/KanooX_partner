<?php

namespace App\Exports;

use App\Models\CreditReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CibilExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $search;
    protected $fromDate;
    protected $toDate;

    public function __construct($search = null, $fromDate = null, $toDate = null)
    {
        $this->search = $search;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Mobile',
            'PAN',
            'Credit Score',
            'Created At',
        ];
    }

    public function collection()
    {
        $query = CreditReport::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('mobile', 'like', "%{$this->search}%")
                  ->orWhere('pan', 'like', "%{$this->search}%")
                  ->orWhere('credit_score', 'like', "%{$this->search}%");
            });
        }

        if ($this->fromDate) {
            $query->whereDate('created_at', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('created_at', '<=', $this->toDate);
        }

        return $query->select(
            'id',
            'name',
            'mobile',
            'pan',
            'credit_score',
            'created_at'
        )->latest()->get();
    }
}