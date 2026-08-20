@if(Auth::user() != null)
    <style>
        .quixnav .metismenu>li {
            background: transparent !important;
            padding: 0;
            margin: 0 10px 2px;
        }

        .quixnav .metismenu>li>a {
            display: flex !important;
            align-items: center;
            gap: 10px;
            padding: 12px 16px !important;
            font-size: 14px;
            font-weight: 500;
            color: #9D3895 !important;
            background: transparent !important;
            border-radius: 8px;
            margin: 0;
            transition: background .15s ease, color .15s ease;
        }

        .quixnav .metismenu>li>a i {
            width: 18px;
            text-align: center;
            font-size: 15px;
            color: #9D3895 !important;
        }

        .quixnav .metismenu>li>a:hover {
            background: #f3d9f0 !important;
            color: #392367 !important;
        }

        .quixnav .metismenu>li>a:hover i {
            color: #392367 !important;
        }

        .quixnav .metismenu>li.page-active>a {
            background: #f3d9f0 !important;
            color: #392367 !important;
        }

        .quixnav .metismenu>li>ul>li.active>a {
            color: #392367 !important;
            background: transparent !important;
        }

        .quixnav .metismenu>li>ul>li.active>a i {
            color: #392367 !important;
        }

        .quixnav .metismenu>li.page-active>a i {
            color: #392367 !important;
        }

        .quixnav .metismenu>li>ul>li.active>a {
            color: #392367 !important;
            background: transparent !important;
            text-decoration: underline !important;
            text-underline-offset: 3px;
            text-decoration-thickness: 1.5px;
        }

        .quixnav .metismenu>li>ul>li.active>a i {
            color: #392367 !important;
        }

        .quixnav .metismenu>li.page-active>a:hover {
            background: #f3d9f0 !important;
            color: #392367 !important;
        }

        .quixnav .metismenu>li.page-active>a:hover i {
            color: #392367 !important;
        }

        /* Inline accordion submenu (full sidebar) — plain, no floating box */
        .quixnav .metismenu>li>ul {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            border-radius: 0;
            padding: 0;
        }

        .quixnav .metismenu>li>ul>li>a {
            display: flex !important;
            align-items: center;
            gap: 10px;
            padding: 9px 16px 9px 42px !important;
            font-size: 13px;
            font-weight: 500;
            color: #9D3895 !important;
            background: transparent !important;
        }

        .quixnav .metismenu>li>ul>li>a i {
            width: 16px;
            text-align: center;
            color: #9D3895 !important;
        }

        .quixnav .metismenu>li>ul>li>a:hover {
            background: #f3d9f0 !important;
            color: #392367 !important;
        }

        .quixnav .metismenu>li>ul>li>a:hover i {
            color: #392367 !important;
        }

        /* ============================================================
               MINI SIDEBAR: collapsed to icons-only by default via the
               .qx-collapsed class (added by JS below), independent of
               whatever attribute/class the underlying theme itself uses.
               Hovering the sidebar swaps in .qx-expanded, which widens it
               and floats it above page content. Mouse-leave reverts it.
               ============================================================ */
        .quixnav.qx-collapsed {
            width: 78px !important;
            overflow: hidden;
            transition: width .2s ease;
            z-index: 1030;
        }

        .quixnav.qx-collapsed.qx-expanded {
            width: 260px !important;
            position: fixed !important;
            top: 0;
            left: 0;
            height: 100vh;
            box-shadow: 4px 0 18px rgba(0, 0, 0, 0.12);
            overflow: visible;
        }

        /* Hide nav text by default in collapsed state... */
        .quixnav.qx-collapsed .nav-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
            white-space: nowrap;
            transition: opacity .15s ease;
            display: inline-block;
        }

        /* ...and reveal them once expanded */
        .quixnav.qx-collapsed.qx-expanded .nav-text {
            opacity: 1;
            width: auto;
        }

        /* Submenus sit inline underneath their parent once expanded,
               no separate floating flyout box needed */
        .quixnav.qx-collapsed .metismenu>li>ul {
            position: static;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            max-height: 0;
            overflow: hidden;

        }

        .quixnav.qx-collapsed.qx-expanded .metismenu>li>ul {
            max-height: 500px;
            overflow: visible;
        }

        /* Auto-open each submenu on hover of its parent item — no click needed.
           Only applies once the sidebar itself is expanded on hover. */
        .quixnav.qx-collapsed.qx-expanded .metismenu>li:hover>ul {
            max-height: 500px !important;
            overflow: visible !important;
        }

        .quixnav.qx-collapsed .metismenu>li>ul>li>a {
            padding: 9px 16px 9px 42px !important;
        }

        /* ============================================================
               SIDEBAR LOGO
               ============================================================ */
        .quixnav-logo {
            display: flex;
            align-items: center;
            padding: 16px;
            height: 64px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .quixnav-logo img {
            height: 32px;
            width: auto;
            flex-shrink: 0;
        }

        /* In collapsed state, center the mark and hide the wordmark text
               version if you're using separate collapsed/full logo images */
        /* Hidden by default (collapsed state) — only shows once the
               sidebar is expanded on hover */
        .quixnav.qx-collapsed .quixnav-logo {
            display: none;
        }

        .quixnav.qx-collapsed.qx-expanded .quixnav-logo {
            display: flex;
            justify-content: flex-start;
            padding: 16px;
        }
    </style>
    <div class="quixnav">
        <a href="{{$base_url}}/admin/dashboard" class="quixnav-logo">
            <img src="{{$base_url}}/login-images/logo.png" alt="KanooX">
        </a>
        <div class="quixnav-scroll">
            <ul class="metismenu" id="menu">

                @if($my_permissions->contains('DASHBOARD'))

                    <li class="{{ request()->is('admin/dashboard') ? 'page-active' : '' }}">
                        <a href="{{$base_url}}/admin/dashboard" aria-expanded="false">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                @endif
                <!-- @if($my_permissions->contains('ROLE_ALL'))
                    <li><a href="{{$base_url}}/admin/role/all" aria-expanded="false"><i
                                class="fa-solid fa-person-circle-question"></i><span class="nav-text">Roles</span></a></li>
                @endif -->
                @if($my_permissions->contains('SERVICE_ALL'))
                    <li
                        class="{{ request()->is('admin/service/*') || request()->is('admin/sub-services/*') ? 'page-active' : '' }}">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa-regular fa-boxes-stacked"></i><span class="nav-text">Services</span></a>
                        <ul aria-expanded="false">
                            <li class="{{ request()->is('admin/service/*') ? 'active' : '' }}"><a
                                    href="{{$base_url}}/admin/service/all">Services</a></li>
                            <li class="{{ request()->is('admin/sub-services/*') ? 'active' : '' }}"><a
                                    href="{{$base_url}}/admin/sub-services/all">Sub-Services</a></li>
                        </ul>
                    </li>
                @endif
                @if($my_permissions->contains('BANK_ALL'))
                    <li class="{{ request()->is('admin/bank/*') ? 'page-active' : '' }}">
                        <a href="{{$base_url}}/admin/bank/all" aria-expanded="false"><i
                                class="fa-solid fa-chart-simple"></i><span class="nav-text">Banks</span></a>
                    </li>
                @endif

                @if($my_permissions->contains('SETTING'))
                    <li
                        class="{{ request()->routeIs('admin.loan.services') || request()->routeIs('admin.blogs.*') ? 'page-active' : '' }}">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa-solid fa-gear"></i><span class="nav-text">Settings</span></a>
                        <ul aria-expanded="false">
                            @if($my_permissions->contains('LOAN_SERVICES'))
                                <li class="{{ request()->routeIs('admin.loan.services') ? 'active' : '' }}">
                                    <a href="{{ route('admin.loan.services') }}" aria-expanded="false">
                                        <span class="nav-text">Loan Services</span>
                                    </a>
                                </li>
                            @endif
                            @if($my_permissions->contains('BLOGS'))
                                <li class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.blogs.index') }}" aria-expanded="false">
                                        <span class="nav-text">Blogs</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if($my_permissions->contains('REPORT'))
                    <li
                        class="{{ request()->routeIs('admin.user.journey.report') || request()->routeIs('admin.cibil.reports') || request()->routeIs('admin.loan.leads') || request()->routeIs('admin.credit-cards.leads') || request()->is('admin/user-contacts') ? 'page-active' : '' }}">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa-solid fa-table"></i><span class="nav-text">Reports</span></a>
                        <ul aria-expanded="false">
                            @if($my_permissions->contains('BANK_CLICK'))
                                <li class="{{ request()->routeIs('admin.user.journey.report') ? 'active' : '' }}">
                                    <a href="{{ route('admin.user.journey.report') }}"><span class="nav-text">User Journey
                                            Report</span></a>
                                </li>
                            @endif
                            @if($my_permissions->contains('CIBIL_REPORT_VIEW'))
                                <li class="{{ request()->routeIs('admin.cibil.reports') ? 'active' : '' }}">
                                    <a href="{{ route('admin.cibil.reports') }}"><span class="nav-text">CIBIL Reports</span></a>
                                </li>
                            @endif
                            @if($my_permissions->contains('LOAN_REPORT'))
                                <li class="{{ request()->routeIs('admin.loan.leads') ? 'active' : '' }}">
                                    <a href="{{ route('admin.loan.leads') }}"><span class="nav-text">Loan Leads</span></a>
                                </li>
                            @endif
                            @if($my_permissions->contains('CREDIT_CARD_LEAD_VIEW'))
                                <li class="{{ request()->routeIs('admin.credit-cards.leads') ? 'active' : '' }}">
                                    <a href="{{ route('admin.credit-cards.leads') }}"><span class="nav-text">Credit Card
                                            Leads</span></a>
                                </li>
                            @endif
                            @if($my_permissions->contains('CONTACT_US_VIEW'))
                                <li class="{{ request()->is('admin/user-contacts') ? 'active' : '' }}">
                                    <a href="{{ $base_url }}/admin/user-contacts"><span class="nav-text">Contact Us</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>
        </div>


    </div>
@endif

<script>
    // Collapse the sidebar to icons-only by default, and expand it (with
    // text labels + inline submenus) whenever the mouse is over it. This
    // is fully self-contained — it doesn't depend on any attribute or
    // class the underlying theme itself may or may not set.

    document.addEventListener('DOMContentLoaded', function () {
        var sidebar = document.querySelector('.quixnav');
        if (!sidebar) return;

        sidebar.classList.add('qx-collapsed');

        sidebar.addEventListener('mouseenter', function () {
            sidebar.classList.add('qx-expanded');
        });

        sidebar.addEventListener('mouseleave', function () {
            sidebar.classList.remove('qx-expanded');
        });

        // Stop MetisMenu's own click-driven open/close animation on
        // parent items — hover already handles opening/closing the
        // submenu, so letting MetisMenu also animate it on click causes
        // the two animations to fight and produces the flicker/collapse
        // you see right after clicking.
        sidebar.querySelectorAll('.metismenu > li > a.has-arrow').forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
            });
        });
    });
</script>

<script src="{{$base_url}}/js/quixnav-init.js"></script>
<script src="{{$base_url}}/js/custom.min.js"></script>