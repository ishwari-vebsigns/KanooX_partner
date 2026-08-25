@extends('layouts.admin-app')

@section('content')
<style>
.contact-submissions-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.contact-submissions-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.contact-submissions-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.contact-submissions-page .kx-title-icon {
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

.contact-submissions-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.contact-submissions-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.contact-submissions-page .kx-breadcrumb {
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

.contact-submissions-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.contact-submissions-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.contact-submissions-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ---------- Card ---------- */
.contact-submissions-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.contact-submissions-page .kx-card-body {
    padding: 26px;
}

.contact-submissions-page .kx-title-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 22px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--kx-border);
}

.contact-submissions-page .kx-title-row-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.contact-submissions-page .kx-title-row-icon {
    flex: 0 0 auto;
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: var(--kx-page-bg);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.contact-submissions-page .kx-title-row h4 {
    margin: 0;
    font-size: 17px;
    font-weight: 700;
    color: var(--kx-text);
}

.contact-submissions-page .kx-title-row p {
    margin: 2px 0 0;
    font-size: 12.5px;
    color: var(--kx-muted);
}

@media (max-width: 575px) {
    .contact-submissions-page .kx-title-row {
        flex-direction: column;
        align-items: stretch;
    }
    .contact-submissions-page .kx-title-row .kx-btn {
        width: 100%;
        justify-content: center;
    }
}

/* ---------- Buttons ---------- */
.contact-submissions-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
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

.contact-submissions-page .kx-btn:hover {
    transform: translateY(-1px);
}

.contact-submissions-page .kx-btn-export {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
}

.contact-submissions-page .kx-btn-export:hover {
    background: #238B45;
    color: #fff;
    box-shadow: 0 8px 18px rgba(35, 139, 69, 0.22);
}

/* ---------- Table ---------- */
.contact-submissions-page .table-responsive {
    border: 1px solid var(--kx-border);
    border-radius: 12px;
    overflow: hidden;
}

.contact-submissions-page .kx-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.contact-submissions-page .kx-table thead th {
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 14px 16px;
    border-bottom: 1px solid var(--kx-border);
    white-space: nowrap;
}

.contact-submissions-page .kx-table tbody td {
    padding: 16px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    border-bottom: 1px solid var(--kx-border);
    vertical-align: middle;
    white-space: nowrap;
}

.contact-submissions-page .kx-table tbody td.kx-message-col {
    white-space: normal;
    max-width: 380px;
    color: var(--kx-muted);
}

.contact-submissions-page .kx-table tbody tr:last-child td {
    border-bottom: none;
}

.contact-submissions-page .kx-table tbody tr:hover td {
    background: #FCF6FC;
}

.contact-submissions-page .kx-table tbody td.kx-empty {
    text-align: center;
    color: var(--kx-muted);
    white-space: normal;
    padding: 40px 16px;
}

.contact-submissions-page .kx-id-pill {
    display: inline-block;
    padding: 4px 12px;
    background: var(--kx-soft);
    color: var(--kx-primary-dark);
    border-radius: 999px;
    font-weight: 700;
    font-size: 12px;
}

.contact-submissions-page .kx-email {
    color: var(--kx-muted);
}

/* ---------- Pagination ---------- */
.contact-submissions-page .kx-pagination-wrap {
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
}

.contact-submissions-page .pagination {
    margin: 0;
}

.contact-submissions-page .page-link {
    color: var(--kx-primary-dark);
    border: 1px solid var(--kx-border);
    border-radius: 8px !important;
    margin: 0 3px;
    font-size: 13px;
}

.contact-submissions-page .page-item.active .page-link {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    border-color: var(--kx-primary-dark);
    color: #fff;
}

.contact-submissions-page .page-link:hover {
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
}

@media (max-width: 767px) {
    .contact-submissions-page .kx-page-head {
        flex-direction: column;
    }
    .contact-submissions-page .kx-card-body {
        padding: 18px;
    }
}
</style>

<div class="content-body contact-submissions-page">
    <div class="container-fluid">

        <div class="kx-page-head">
            <div class="kx-title-wrap">
                <div class="kx-title-icon"><i class="fa fa-envelope"></i></div>
                <div>
                    <h4 class="kx-page-title">Hi, welcome {{Auth::user()->name}}!</h4>
                    <p class="kx-page-subtitle">
                        View and manage contact form submissions
                        @if(Auth::user()->role_id==2)
                            &nbsp;&middot;&nbsp;Agent ID: {{Auth::user()->new_id}}
                        @endif
                    </p>
                </div>
            </div>
            <ol class="kx-breadcrumb">
                <li><a href="javascript:void(0)">Reports</a></li>
                <li>/</li>
                <li class="kx-crumb-current"><a href="javascript:void(0)">Contact Us Submissions</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="kx-card">
                    <div class="kx-card-body">

                        <div class="kx-title-row">
                            <div class="kx-title-row-left">
                                <div class="kx-title-row-icon"><i class="fa fa-inbox"></i></div>
                                <div>
                                    <h4>Contact Us Submissions</h4>
                                    <p>All messages received via the contact form</p>
                                </div>
                            </div>

                            <a href="{{ route('user.contacts.export') }}" class="kx-btn kx-btn-export">
                                <i class="fa fa-download"></i> Download Excel
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="kx-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contacts as $contact)
                                    <tr>
                                        <td><span class="kx-id-pill">{{ $loop->iteration + ($contacts->currentPage()-1)*$contacts->perPage() }}</span></td>
                                        <td>{{ $contact->name }}</td>
                                        <td class="kx-email">{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td class="kx-message-col">
                                            {{ $contact->message }}
                                        </td>
                                        <td>{{ $contact->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="kx-empty">
                                            No Contact Submissions Found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="kx-pagination-wrap">
                            {{ $contacts->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection