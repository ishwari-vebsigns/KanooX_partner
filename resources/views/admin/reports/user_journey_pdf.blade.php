<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 9px; color: #333; margin: 0; padding: 12px; }
    h2   { font-size: 14px; color: #344767; margin: 0 0 2px; }
    p.sub { font-size: 9px; color: #888; margin: 0 0 10px; }
    table { width: 100%; border-collapse: collapse; }
    thead th {
        background: #344767; color: #fff;
        padding: 6px 8px; font-size: 8px;
        text-transform: uppercase; letter-spacing: .4px;
        border: 1px solid #2a3a56; text-align: left;
    }
    tbody td {
        padding: 5px 8px; border: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    tbody tr:nth-child(even) td { background: #f8fafc; }
    .badge {
        display: inline-block; padding: 2px 8px;
        border-radius: 10px; font-weight: 700; font-size: 8px;
    }
    .b-yes    { background: #28a745; color: #fff; }
    .b-no     { background: #dc3545; color: #fff; }
    .b-good   { background: #d4edda; color: #155724; }
    .b-medium { background: #fff3cd; color: #856404; }
    .b-low    { background: #f8d7da; color: #721c24; }
    .b-high   { background: #28a745; color: #fff; }
    .b-jmed   { background: #ffc107; color: #333; }
    .b-jlow   { background: #dc3545; color: #fff; }
    .meta { font-size: 9px; color: #888; margin-bottom: 10px; }
</style>
</head>
<body>

<h2>User Journey Report</h2>
<p class="sub">Complete user funnel tracking and engagement analytics</p>

<p class="meta">
    Generated: {{ now()->format('d M Y, h:i A') }}
    @if($from_date || $to_date)
        &nbsp;·&nbsp; Period: {{ $from_date ? \Carbon\Carbon::parse($from_date)->format('d M Y') : 'Start' }}
        → {{ $to_date ? \Carbon\Carbon::parse($to_date)->format('d M Y') : 'Today' }}
    @endif
    &nbsp;·&nbsp; Total: {{ $reports->count() }} records
</p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Registered</th>
            <th>Pincode</th>
            <th>Menus Browsed</th>
            <th>Clicks</th>
            <th>Basic Info</th>
            <th>Profession</th>
            <th>Loan Amt</th>
            <th>Banks</th>
            <th>Credit Score</th>
            <th>PAN</th>
            <th>Journey %</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reports as $r)
        <tr>
            <td>#{{ $r->user_id }}</td>
            <td>{{ $r->name ?: '-' }}</td>
            <td>{{ $r->phone ?: '-' }}</td>
            <td>{{ $r->email ?: '-' }}</td>
            <td>{{ $r->registered }}</td>
            <td>{{ $r->pincode ?: '-' }}</td>
            <td>{{ $r->menus_browsed ?: '-' }}</td>
            <td>{{ $r->menu_clicks }}</td>
            <td>
                <span class="badge {{ $r->basic_info == 'Yes' ? 'b-yes' : 'b-no' }}">
                    {{ $r->basic_info }}
                </span>
            </td>
            <td>{{ $r->profession ?: '-' }}</td>
            <td>{{ $r->loan_amount ? '₹'.number_format($r->loan_amount) : '-' }}</td>
            <td>{{ $r->banks_clicked ?: '-' }}</td>
            <td>
                @if($r->credit_score)
                    <span class="badge {{ $r->credit_score >= 750 ? 'b-good' : ($r->credit_score >= 650 ? 'b-medium' : 'b-low') }}">
                        {{ $r->credit_score }}
                    </span>
                @else -
                @endif
            </td>
            <td>{{ $r->pan ?: '-' }}</td>
            <td>
                <span class="badge {{ $r->journey_percentage >= 80 ? 'b-high' : ($r->journey_percentage >= 60 ? 'b-jmed' : 'b-jlow') }}">
                    {{ $r->journey_percentage }}%
                </span>
            </td>
        </tr>
        @empty
        <tr><td colspan="15" style="text-align:center; padding:20px; color:#aaa;">No Records Found</td></tr>
        @endforelse
    </tbody>
</table>

</body>
</html>