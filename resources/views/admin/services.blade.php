@extends('layouts.service-layout')
@section('content')
<style>
    /* =========================
   SERVICE REGISTRATION CARDS
   ========================= */

.reg-card {
    border-radius: 16px;
    background: #ffffff;
    border: 1px solid #eef1f6;
    height: 100%;
    transition: all .25s ease;
}

.reg-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(15, 50, 100, 0.12);
}

/* ICON WRAPPER (FIXES BREAKING) */
.reg-icon {
    width: 72px;
    height: 72px;
    border-radius: 16px;
    background: linear-gradient(135deg, #eaf3ff, #ffffff);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
}

/* ICON IMAGE SIZE LOCK */
.reg-icon img {
    max-width: 42px;
    max-height: 42px;
    width: auto;
    height: auto;
    object-fit: contain;
}

/* TEXT */
.reg-title {
    font-size: 18px;
    font-weight: 700;
    color: #0F3264;
}

.reg-desc {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
    margin: 10px 0 22px;
}

/* BUTTON */
.reg-btn {
    padding: 10px 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
}

.reg-btn.disabled {
    background: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

/* MOBILE OPTIMIZATION */
@media (max-width: 576px) {
    .reg-card {
        text-align: center;
    }

    .reg-icon {
        margin-left: auto;
        margin-right: auto;
    }
}

</style>
<div class="service-container">

    {{-- HEADER --}}
    <div class="page-head">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <h4>Customer Registration</h4>
                <p>Select a service to start registering a customer</p>

                @if(Auth::user() && Auth::user()->role_id == 2)
                    <small class="text-muted">Agent ID: {{ Auth::user()->new_id }}</small>
                @endif
            </div>

            <div class="col-md-6 d-flex justify-content-md-end">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">Register</li>
                    <li class="breadcrumb-item">Bank</li>
                    <li class="breadcrumb-item active">Customer Registration</li>
                </ol>
            </div>
        </div>
    </div>

    {{-- CARDS --}}
<div class="row g-4">

    {{-- LOANS --}}
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card reg-card">
            <div class="card-body d-flex flex-column">

                <div class="reg-icon">
                    <img src="{{ $base_url }}/web-assets/images/resources/loan.png" alt="Loans">
                </div>

                <div class="reg-title">Loans</div>

                <div class="reg-desc">
                    Personal, business, home and other loan product registrations.
                </div>

                <div class="mt-auto">
                    <a href="{{ $base_url }}/admin/direct-services/1?access_code={{ $code }}"
                       class="btn btn-primary reg-btn">
                        Proceed →
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- INSURANCE --}}
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card reg-card">
            <div class="card-body d-flex flex-column">

                <div class="reg-icon">
                    <img src="{{ $base_url }}/web-assets/images/resources/insurance1.png" alt="Insurance">
                </div>

                <div class="reg-title">Insurance</div>

                <div class="reg-desc">
                    Life, health and general insurance registrations.
                </div>

                <div class="mt-auto">
                    <span class="btn reg-btn disabled">Coming Soon</span>
                </div>

            </div>
        </div>
    </div>

    {{-- CREDIT CARDS --}}
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card reg-card">
            <div class="card-body d-flex flex-column">

                <div class="reg-icon">
                    <img src="{{ $base_url }}/web-assets/images/resources/cards1.png" alt="Credit Cards">
                </div>

                <div class="reg-title">Credit Cards</div>

                <div class="reg-desc">
                    Eligible credit card applications for customers.
                </div>

                <!--<div class="mt-auto">-->
                <!--    <span class="btn reg-btn disabled">Coming Soon</span>-->
                <!--</div>-->
                
                <div class="mt-auto">
                    <a href="{{ $base_url }}/admin/direct-services/3?access_code={{ $code }}"
                       class="btn btn-primary reg-btn">
                        Proceed →
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>

</div>

@endsection
