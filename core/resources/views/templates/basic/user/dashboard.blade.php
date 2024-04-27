@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="row p-4">
    <div class="col-lg-3">
        <div class="collapable-sidebar">
            <div class="collapable-sidebar__inner">
                <button type="button" class="collapable-sidebar__close d-lg-none d-block"><i class="las la-times"></i>
                </button>
                <div class="card mb-4">
                    <div class="card-header border-bottom p-2 bg--base text--white text-center fw-bold">@lang('My
                        Information')
                    </div>
                    <div class="card-body">
                        <strong>{{ __($user->fullname) }}</strong>
                        <span class="d-block mt-1">
                            {{ __(@$user->address->address) }}
                        </span>
                        <span class="d-block mt-1">
                            {{ @$user->address->city ? __(@$user->address->city) . ',' : null }}
                            {{ @$user->address->state ? __(@$user->address->state) . ',' : null }}
                            {{ @$user->address->zip ? __(@$user->address->zip) . ',' : null }}
                        </span>
                        <span class="mt-1">{{ __(@$user->address->country) }}</span>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user.profile.setting') }}" class="btn-link w-100"><i
                                class="las la-pencil-alt"></i> @lang('Update')</a>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header border-bottom p-2 bg--base text-white text-center fw-bold">@lang('Support')
                    </div>
                    <div class="card-body">
                        <a href="{{ route('ticket.open') }}" class="btn-link w-100"><i class="las la-plus"></i>
                            @lang('New Ticket')</a>
                    </div>
                </div>
                <nav id="actionMenu" class="collapse d-block sidebar collapse bg-white border">
                    <div class="position-sticky">
                        <div class="list-group list-group-flush">
                            <span class="border-bottom p-2 bg--base text-white text-center fw-bold">
                                <span>@lang('Shortcuts')</span>
                            </span>
                            <a href="{{ route('products') }}" class="list-group-item">
                                @lang('Products')
                            </a>
                            <a href="{{ route('user.logout') }}" class="list-group-item">
                                @lang('Logout')
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="row d-lg-none d-block">
        <div class="col-12 ">
            <div class="show-sidebar-bar">
                <i class="pas pa-bars"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row user-dashboard">
            <div class="col-xl-4 col-md-6 col-sm-6">
                <div class="custom--card-two">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">@lang('My Wallet')</p>
                                <h4 class="my-1">{{ $general->cur_sym }}{{ number_format(Auth::user()->balance, 2) }}
                                </h4>
                            </div>

                            <span class="widgets-icons-2 ms-auto">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <a href="{{ route('user.deposit.new') }}" class="has-anchor"></a>

                        </div>

                    </div>
                    <a href="{{ route('user.deposit.new') }}" class="btn btn--primary w-100 mt-1"
                        id="btn-confirm">@lang('Fund Wallet')</a>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6">
                <div class="custom--card-two">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">@lang('Deposits')</p>
                                <h4 class="my-1">{{ $general->cur_sym }}{{ showAmount(@$widget['total_payments']) }}
                                </h4>
                            </div>
                            <span class="widgets-icons-2 ms-auto">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <a href="{{ route('user.deposit.history') }}" class="has-anchor"></a>
                        </div>
                    </div>
                    <a href="/" class="btn btn--warning w-100 mt-1"
                        id="btn-confirm">@lang('Buy Log')</a>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6">
                <div class="custom--card-two">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">@lang('Orders')</p>
                                <h4 class="my-1">{{ getAmount(@$widget['total_orders']) }}</h4>
                            </div>
                            <span class="widgets-icons-2 ms-auto">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <a href="{{ route('user.orders') }}" class="has-anchor"></a>
                        </div>
                    </div>
                </div>
            </div>

         
        </div>
        <div class="row g-4">
            <div class="col-lg-12">
                <h5 class="mt-4 mb-4">@lang('Latest Payments History')</h5>
                  <div class="table-responsive">
            <table class="table">

                <thead>
                    <tr>
                        <th>@lang('Trx')</th>
                        <th>@lang('Time')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestDeposits as $deposit)
                    <tr>
                        <td>
                            <span class="info"> {{ $deposit->trx }} </span>
                        </td>

                        <td>
                            <span class="">{{ diffForHumans($deposit->created_at) }}</span>
                        </td>
                        <td>

                            {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }}
                        </td>

                        <td>
                            @php echo $deposit->statusBadge @endphp
                        </td>
                        @php
                        $details = $deposit->detail != null ? json_encode($deposit->detail) : null;
                        @endphp
                        <td>
                            <div class="action-buttons">
                                @if ($deposit->status == 0)
                                <a href="/user/resolve-deposit?trx={{ $deposit->trx }}" class="btn btn-sm btn-danger" type="button">Resolve</button>
                                 @endif

                        </td>
                       


                    </tr>
                    @empty
                    <tr>
                        <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
            </div>
        </div>
    </div>


      <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #dc3545;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://t.me/acelogs_01" class="float" target="_blank">
        <i class="fa fa-comment my-float"></i>
    </a>


   

</div>




<!-- Modal -->







{{-- APPROVE MODAL --}}
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">@lang('Details')</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush userData">
                </ul>
                <div class="feedback"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    (function($) {

            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    userData.forEach(element => {
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3 ms-2">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                if (!html && !adminFeedback) {
                    html = `<span class='d-block text-center mt-2 mb-2'>{{ __($emptyMessage) }}</span>`;
                }

                modal.find('.userData').html(html);
                modal.find('.feedback').html(adminFeedback);
                modal.modal('show');
            });

            $('.search-form').on('submit', function(e) {
                e.preventDefault();
                var keyword = $(this).find('input[name=search]').val();
                window.location.href = "{{ route('products') }}?search=" + keyword;
            })

            // Responsive Sidebar
            $(".show-sidebar-bar").on("click", function() {
                $(".collapable-sidebar").addClass('show');
                $(".sidebar-overlay").addClass('show');
            });
            $(".collapable-sidebar__close, .sidebar-overlay").on("click", function() {
                $(".collapable-sidebar").removeClass('show');
                $(".sidebar-overlay").removeClass('show');
            });

        })(jQuery);
</script>
@endpush

@push('style')
<style>
    .custom--card-two {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-clip: border-box;
        border: 0px solid rgba(0, 0, 0, 0);
        border-radius: .25rem;
        margin-bottom: 1.5rem;
    }

    .widgets-icons-2 {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        border-radius: 10px;
        background: hsl(var(--white));
        border-radius: 50%;
    }

    .has-anchor {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    .domain-search-icon {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        aspect-ratio: 1;
        padding: 5px;
        display: grid;
        place-items: center;
        color: #888;
    }

    .domain-search-icon~.form--control {
        padding-left: 45px;
    }

    .domain-search-icon-reset {
        position: absolute;
        right: 0px;
        transform: translateY(-50%);
        top: 50%;
        color: #888;
        visibility: visible;
        opacity: 1;
        cursor: pointer;
        margin-right: 4px;
        height: auto;
    }

    @media (max-width: 991px) {
        .collapable-sidebar {
            position: fixed;
            left: 0;
            min-width: 320px;
            top: 0;
            background-color: hsl(var(--white));
            z-index: 9999;
            transform: translateX(-120%);
            transition: .3s linear;
            margin-right: 40px;
        }

        .collapable-sidebar__inner {
            height: 100vh;
            overflow-y: auto;
        }

        .collapable-sidebar.show {
            transform: translateX(0);
        }

        .collapable-sidebar__close {
            background-color: hsl(var(--danger));
            border: 0;
            font-size: 20px;
            line-height: 1;
            color: #fff;
            position: absolute;
            right: -40px;
            top: 0;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .show-sidebar-bar {
            font-size: 30px;
            color: hsl(var(--base));
            line-height: 1;
            display: inline-block;
            transform: translateY(-15px);
        }
    }

    @media (max-width: 424px) {
        .collapable-sidebar {
            min-width: 280px;
        }
    }

    .collapable-sidebar .btn-link {
        font-size: 0.875rem;
        font-weight: 500;
        color: hsl(var(--heading-color));
        text-decoration: none;
        border: 1px solid hsl(var(--black)/0.2);
        text-align: center;
        padding: 8px 10px;
        border-radius: .25rem;
    }

    .collapable-sidebar .btn-link:hover {
        background: hsl(var(--base));
        border-color: hsl(var(--base));
        color: hsl(var(--white));
    }

    .collapable-sidebar .card-footer {
        background: transparent;
    }

    .collapable-sidebar .list-group-item:hover {
        color: hsl(var(--base));
    }

    .user-dashboard div[class*=col-xl-4]:nth-child(1) .custom--card-two {
        background-color: hsl(var(--info)/0.1) !important;
        border-left: 5px solid hsl(var(--info));
    }

    .user-dashboard div[class*=col-xl-4]:nth-child(1) .custom--card-two .widgets-icons-2 {
        color: hsl(var(--info));
    }

    .user-dashboard div[class*=col-xl-4]:nth-child(2) .custom--card-two {
        background-color: hsl(var(--base)/0.1) !important;
        border-left: 5px solid hsl(var(--base));
    }

    .user-dashboard div[class*=col-xl-4]:nth-child(2) .custom--card-two .widgets-icons-2 {
        color: hsl(var(--base));
    }

    .user-dashboard div[class*=col-xl-4]:nth-child(3) .custom--card-two {
        background-color: hsl(var(--purple)/0.1) !important;
        border-left: 5px solid hsl(var(--purple));
    }

    .user-dashboard div[class*=col-xl-4]:nth-child(3) .custom--card-two .widgets-icons-2 {
        color: hsl(var(--purple));
    }
</style>
@endpush
