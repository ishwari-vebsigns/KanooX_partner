@extends('layouts.admin-app')

@section('content')
    <style>
        .cc-leads-page {
            --kx-primary: #9D3895;
            --kx-primary-dark: #392367;
            --kx-soft: #F3D9F0;
            --kx-page-bg: #F8EAF7;
            --kx-text: #25213A;
            --kx-muted: #747080;
            --kx-border: #E9E3EA;
        }

        /* ── Page header ── */
        .cc-leads-page .kx-page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 22px;
        }

        .cc-leads-page .kx-title-wrap {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .cc-leads-page .kx-title-icon {
            flex: 0 0 auto;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--kx-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--kx-primary-dark);
            font-size: 20px;
        }

        .cc-leads-page .kx-page-title {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: var(--kx-text);
            letter-spacing: -0.2px;
        }

        .cc-leads-page .kx-page-subtitle {
            margin: 3px 0 0;
            font-size: 13.5px;
            color: var(--kx-muted);
        }

        .cc-leads-page .kx-breadcrumb {
            margin: 0;
            padding: 8px 14px;
            background: #fff;
            border: 1px solid var(--kx-border);
            border-radius: 8px;
            font-size: 13px;
            color: var(--kx-muted);
            align-self: center;
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }

        .cc-leads-page .kx-breadcrumb a {
            color: var(--kx-muted);
            text-decoration: none;
        }

        .cc-leads-page .kx-breadcrumb a:hover {
            color: var(--kx-primary);
        }

        .cc-leads-page .kx-breadcrumb .kx-crumb-current {
            color: var(--kx-primary-dark);
            font-weight: 600;
        }

        /* ── Card ── */
        .cc-leads-page .kx-card {
            background: #fff;
            border: 1px solid var(--kx-border);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
            overflow: hidden;
        }

        .cc-leads-page .kx-card-body {
            padding: 24px;
        }

        .cc-leads-page .kx-title-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--kx-border);
        }

        .cc-leads-page .kx-title-row h4 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: var(--kx-text);
        }

        @media (max-width: 575px) {
            .cc-leads-page .kx-title-row {
                flex-direction: column;
                align-items: stretch;
            }

            .cc-leads-page .kx-title-row .kx-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* ── Buttons ── */
        .cc-leads-page .kx-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0 18px;
            height: 40px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 9px;
            border: 1px solid transparent;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
            line-height: 1.2;
            white-space: nowrap;
        }

        .cc-leads-page .kx-btn:hover {
            transform: translateY(-1px);
        }

        .cc-leads-page .kx-btn-export {
            background: #EAF8EF;
            color: #238B45;
            border-color: #CDEFDA;
        }

        .cc-leads-page .kx-btn-export:hover {
            background: #238B45;
            color: #fff;
        }

        /* ── Table ── */
        .cc-leads-page .kx-table-wrap {
            max-height: 460px;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            border: 1px solid var(--kx-border);
        }

        .cc-leads-page .kx-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cc-leads-page .kx-table th,
        .cc-leads-page .kx-table td {
            white-space: nowrap;
        }

        .cc-leads-page .kx-table thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: var(--kx-page-bg);
            color: var(--kx-primary-dark);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 13px 16px;
            border-bottom: 1px solid var(--kx-border);
        }

        .cc-leads-page .kx-table tbody td {
            padding: 14px 16px;
            font-size: 13.5px;
            color: var(--kx-text);
            background: #fff;
            border-bottom: 1px solid var(--kx-border);
            vertical-align: middle;
        }

        .cc-leads-page .kx-table tbody tr:last-child td {
            border-bottom: none;
        }

        .cc-leads-page .kx-table tbody tr:hover td {
            background: #FCF6FC;
            transition: background .15s;
        }

        .cc-leads-page .kx-cust-name {
            font-weight: 700;
            color: var(--kx-text);
        }

        .cc-leads-page .kx-empty td {
            padding: 60px 0 !important;
            text-align: center;
            color: var(--kx-muted);
            font-size: 15px;
            background: #fff !important;
        }

        /* ── Pagination ── */
        .cc-leads-page .kx-pagination {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
        }

        /* ── Scrollbar ── */
        .cc-leads-page .kx-table-wrap::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .cc-leads-page .kx-table-wrap::-webkit-scrollbar-track {
            background: var(--kx-page-bg);
            border-radius: 10px;
        }

        .cc-leads-page .kx-table-wrap::-webkit-scrollbar-thumb {
            background: var(--kx-soft);
            border-radius: 10px;
        }

        .cc-leads-page .kx-table-wrap::-webkit-scrollbar-thumb:hover {
            background: var(--kx-primary);
        }

        @media (max-width: 767px) {
            .cc-leads-page .kx-page-head {
                flex-direction: column;
            }

            .cc-leads-page .kx-card-body {
                padding: 18px;
            }
        }

        .cc-leads-page .kx-status-select {
            border: 1px solid var(--kx-border);
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            outline: none;
            background: #fff;
            color: var(--kx-text);
        }

        .cc-leads-page .kx-status-pending {
            background: #FFF6E5;
            color: #B7791F;
            border-color: #FBE7BF;
        }

        .cc-leads-page .kx-status-under_review {
            background: #E9F1FF;
            color: #2B6CB0;
            border-color: #CBE0FF;
        }

        .cc-leads-page .kx-status-completed {
            background: #EAF8EF;
            color: #238B45;
            border-color: #CDEFDA;
        }
    </style>

    <div class="content-body cc-leads-page">
        <div class="container-fluid">

            <div class="kx-page-head">
                <div class="kx-title-wrap">
                    <div class="kx-title-icon"><i class="fa fa-credit-card"></i></div>
                    <div>
                        <h4 class="kx-page-title">Hi, welcome {{ Auth::user()->name }}!</h4>
                        @if(Auth::user()->role_id == 2)
                            <p class="kx-page-subtitle">Agent ID: {{ Auth::user()->new_id }}</p>
                        @else
                            <p class="kx-page-subtitle">Track and manage incoming credit card lead submissions</p>
                        @endif
                    </div>
                </div>
                <ol class="kx-breadcrumb">
                    <li><a href="javascript:void(0)">Reports</a></li>
                    <li>/</li>
                    <li class="kx-crumb-current"><a href="javascript:void(0)">Credit Card Leads</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="kx-card">
                        <div class="kx-card-body">

                            <div class="kx-title-row">
                                <h4>Credit Card Leads</h4>

                                <a href="{{ route('credit.card.leads.export') }}" class="kx-btn kx-btn-export">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                    Download Excel
                                </a>
                            </div>

                            <div class="kx-table-wrap table-responsive">
                                <table class="kx-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>National ID</th>
                                            <th>DOB</th>
                                            <th>Profession Type</th>
                                            <th>Annual income</th>
                                            <!-- <th>Status</th> -->
                                            <th>Applied On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($leads as $lead)
                                            <tr>
                                                <td>{{ $loop->iteration + ($leads->currentPage() - 1) * $leads->perPage() }}
                                                </td>
                                                <td><span class="kx-cust-name">{{ $lead->name }}</span></td>
                                                <td>{{ $lead->mobile }}</td>
                                                <td>{{ $lead->pan }}</td>
                                                <td>{{ $lead->dob }}</td>
                                                <td>{{ $lead->profession_type }}</td>
                                                <td>{{ $lead->annual_income }}</td>
                                                <!-- <td>
                                                    <form action="{{ route('credit-card-leads.status.update', $lead->id) }}"
                                                        method="POST" class="kx-status-form">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="status" onchange="this.form.submit()"
                                                            class="kx-status-select kx-status-{{ $lead->status }}">
                                                            <option value="pending" {{ $lead->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="under_review" {{ $lead->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                                            <option value="completed" {{ $lead->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                        </select>
                                                    </form>
                                                </td> -->
                                                <td>{{ $lead->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr class="kx-empty">
                                                <td colspan="9">No Credit Card Leads Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="kx-pagination">
                                {{ $leads->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection