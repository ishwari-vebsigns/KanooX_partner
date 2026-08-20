<?php

namespace App\Exports;

ini_set('memory_limit', '512M');
set_time_limit(300);

use App\Models\Loansignin;
use App\Models\MenuClick;
use App\Models\BasicInfo;
use App\Models\BankClick;
use App\Models\CreditReport;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserJourneyExport implements FromQuery, WithHeadings, WithMapping
{
   protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Loansignin::query()->selectRaw("
            loansignins.*,
            GREATEST(
                COALESCE(loansignins.updated_at, '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM basic_infos WHERE basic_infos.user_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM credit_reports WHERE credit_reports.user_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(created_at) FROM bank_clicks WHERE bank_clicks.loan_signin_id = loansignins.loan_signin_id), '1970-01-01'),
                COALESCE((SELECT MAX(updated_at) FROM menu_clicks WHERE menu_clicks.user_id = loansignins.loan_signin_id), '1970-01-01')
            ) as last_activity_at
        ");

        if (!empty($this->filters['from_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['from_date']);
        }

        if (!empty($this->filters['to_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['to_date']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('contact_no', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (!empty($this->filters['active_from'])) {
            $query->whereRaw("
                GREATEST(
                    COALESCE(loansignins.updated_at, '1970-01-01'),
                    COALESCE((SELECT MAX(updated_at) FROM basic_infos WHERE basic_infos.user_id = loansignins.loan_signin_id), '1970-01-01'),
                    COALESCE((SELECT MAX(updated_at) FROM credit_reports WHERE credit_reports.user_id = loansignins.loan_signin_id), '1970-01-01'),
                    COALESCE((SELECT MAX(created_at) FROM bank_clicks WHERE bank_clicks.loan_signin_id = loansignins.loan_signin_id), '1970-01-01'),
                    COALESCE((SELECT MAX(updated_at) FROM menu_clicks WHERE menu_clicks.user_id = loansignins.loan_signin_id), '1970-01-01')
                ) >= ?
            ", [$this->filters['active_from']]);
        }

        if (!empty($this->filters['active_to'])) {
            $query->whereRaw("
                GREATEST(
                    COALESCE(loansignins.updated_at, '1970-01-01'),
                    COALESCE((SELECT MAX(updated_at) FROM basic_infos WHERE basic_infos.user_id = loansignins.loan_signin_id), '1970-01-01'),
                    COALESCE((SELECT MAX(updated_at) FROM credit_reports WHERE credit_reports.user_id = loansignins.loan_signin_id), '1970-01-01'),
                    COALESCE((SELECT MAX(created_at) FROM bank_clicks WHERE bank_clicks.loan_signin_id = loansignins.loan_signin_id), '1970-01-01'),
                    COALESCE((SELECT MAX(updated_at) FROM menu_clicks WHERE menu_clicks.user_id = loansignins.loan_signin_id), '1970-01-01')
                ) <= ?
            ", [$this->filters['active_to'] . ' 23:59:59']);
        }

        return $query->orderByDesc('last_activity_at');
    }

    public function map($user): array
    {
        /*
        |--------------------------------------------------------------------------
        | Menu Data
        |--------------------------------------------------------------------------
        */

        $menuData = MenuClick::where(
                'user_id',
                $user->loan_signin_id
            )
            ->whereNotNull('item')
            ->get();

        $menusBrowsed = $menuData
            ->pluck('item')
            ->unique()
            ->implode(', ');

        $menuClicks = $menuData->sum('click_count');

        /*
        |--------------------------------------------------------------------------
        | Basic Info
        |--------------------------------------------------------------------------
        */

        $basicInfo = BasicInfo::where(
            'user_id',
            $user->loan_signin_id
        )->first();

        $basicInfoStatus = $basicInfo ? 'Yes' : 'No';

        $profession = null;

        if ($basicInfo && isset($basicInfo->dynamic_fields['profession_type'])) {

            $profession = $basicInfo->dynamic_fields['profession_type'];
        }

        /*
        |--------------------------------------------------------------------------
        | Bank Clicks
        |--------------------------------------------------------------------------
        */

        $bankGrouped = BankClick::where(
                'loan_signin_id',
                $user->loan_signin_id
            )
            ->get()
            ->groupBy('bank_name');

        $banksClicked = [];

        foreach ($bankGrouped as $bankName => $clicks) {

            $banksClicked[] = $bankName . '-' . $clicks->count() . ' clicks';
        }

        $banksClicked = implode(', ', $banksClicked);

        /*
        |--------------------------------------------------------------------------
        | Credit Report
        |--------------------------------------------------------------------------
        */

             $creditReport = \App\Models\CreditReport::where(
                                'user_id',
                                $user->loan_signin_id
                            )
                            
                            ->orderByDesc('updated_at')
                            ->first();
        $creditScore = $creditReport->credit_score ?? '';

        $pan = $creditReport->pan ?? '';

        $loanAmount = $creditReport->loan_amount ?? '';

        $income = $creditReport->income ?? '';

        /*
        |--------------------------------------------------------------------------
        | Journey %
        |--------------------------------------------------------------------------
        */

        $journey = 20;

        if ($basicInfo) {
            $journey += 20;
        }

        if ($creditReport) {
            $journey += 20;
        }

        if ($bankGrouped->count() > 0) {
            $journey += 20;
        }

        return [

            $user->loan_signin_id,

            $user->customer_name,

            $user->contact_no,

            $user->email,

            optional($user->created_at)->format('Y-m-d'),

            $user->last_activity_at ? \Carbon\Carbon::parse($user->last_activity_at)->format('d M Y h:i A') : '',

            $user->pincode,

            $menusBrowsed,

            $menuClicks,

            $basicInfoStatus,

            $profession,

            $loanAmount,

            $income,

            $banksClicked,

            $creditScore,

            $pan,

            $journey . '%',
        ];
    }

    public function headings(): array
    {
        return [

            'User ID',
            'Name',
            'Phone',
            'Email',
            'Registered',
            'Last Activity',
            'Pincode',
            'Menus Browsed',
            'Menu Clicks',
            'Basic Info',
            'Profession',
            'Loan Amount',
            'Income',
            'Banks Clicked',
            'Credit Score',
            'PAN',
            'Journey Percentage',
        ];
    }
}