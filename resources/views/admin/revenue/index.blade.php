@extends('layouts.dashboard')

@section('page-title', 'Revenue Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <form method="GET" action="{{ route('admin.revenue.index') }}" class="d-flex align-items-center gap-2">
        <select name="month" class="form-select w-auto" style="border-radius:12px;font-size:13px">
            @for($i=1; $i<=12; $i++)
                @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                </option>
            @endfor
        </select>
        <input type="number" name="year" class="form-control w-auto" value="{{ $year }}" min="2020" max="{{ now()->year + 5 }}" style="border-radius:12px;font-size:13px;max-width:100px">
        <button type="submit" class="btn-navy" style="padding:6px 14px;font-size:13px">Filter</button>
    </form>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-cash-stack"></i></div>
            <div>
                <div class="stat-label">Total Revenue</div>
                <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <div class="stat-label" style="font-size:11px">{{ date('F', mktime(0, 0, 0, $month, 1)) }} {{ $year }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card-royal">
    <div class="card-header-royal"><h5>Payment Transactions</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-royal mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>User</th>
                        <th>Package</th>
                        <th>Method</th>
                        <th>Reference</th>
                        <th class="text-end pe-4">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td class="ps-4">{{ $payment->created_at->format('d M Y, H:i') }}</td>
                            <td class="fw-bold">{{ $payment->user->name ?? 'N/A' }}</td>
                            <td>
                                @if($payment->subscription && $payment->subscription->package)
                                    <span class="badge" style="background:var(--navy);border-radius:50px">{{ $payment->subscription->package->name }}</span>
                                @else
                                    <span class="text-muted">Unknown</span>
                                @endif
                            </td>
                            <td>{{ $payment->payment_method }}</td>
                            <td class="font-monospace small text-muted">{{ $payment->reference_duitku }}</td>
                            <td class="text-end pe-4 fw-bold" style="color:#28a745">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">No paid transactions found for this period.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body border-top pt-3 pb-2">{{ $payments->links() }}</div>
</div>
@endsection
