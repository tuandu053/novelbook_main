@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                @guest
                    <div class="card-body">
                        @include('layouts.404_traiphep')
                    </div>
                @else
                    @auth
                        @if (Auth::user()->id == $user->id)
                            <div class="card">
                                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">
                                    <div class="d-flex flex-wrap" id="pills-tab" role="tablist">
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa-solid fa-address-card"></i> Quản lý thông tin đọc
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item" id="user_purchase_history-tab"
                                                        data-bs-toggle="pill" data-bs-target="#user_purchase_history" type="button"
                                                        role="tab" aria-controls="user_purchase_history"
                                                        aria-selected="false"><i class="fa-solid fa-rectangle-list"></i> Lịch sử mua
                                                        chương</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" id="user_read_history-tab" data-bs-toggle="pill"
                                                        data-bs-target="#user_read_history" type="button" role="tab"
                                                        aria-controls="user_read_history" aria-selected="false"><i
                                                            class="fa-solid fa-glasses"></i> Lịch sử đọc</button>
                                                </li>
                                                <li>

                                                </li>
                                                <li>
                                                    <button class="dropdown-item" id="user_bookmark-tab" data-bs-toggle="pill"
                                                        data-bs-target="#user_bookmark" type="button" role="tab"
                                                        aria-controls="user_bookmark" aria-selected="false"><i
                                                            class="fa-solid fa-bookmark"></i> Dấu trang</button>
                                                </li>
                                            </ul>
                                        </div>
                                       
                                        @if (Auth::user()->email_verified_at !== null)
                                            <button class="dropdown-item px-3 py-2 w-auto text-black" id="user_report-tab" data-bs-toggle="pill"
                                        data-bs-target="#user_report" type="button" role="tab" aria-controls="user_report"
                                        aria-selected="false"><i class="fa-solid fa-flag text-black"></i> Tố cáo</button>
                                        @endif
                                        <button class="dropdown-item px-3 py-2 w-auto text-black" id="user_bill-tab" data-bs-toggle="pill"
                                            data-bs-target="#user_bill" type="button" role="tab" aria-controls="user_bill"
                                            aria-selected="false"><i class="fa-solid fa-coins text-black"></i> Ví tiền và hóa đơn</button>
                                    </div>
                                </div>

                                <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                    @include('user.user_infor')
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade" id="user_purchase_history" role="tabpanel" aria-labelledby="user_purchase_history-tab">
                                            @include('user.user_purchase_history')
                                        </div>
                                        <div class="tab-pane fade" id="user_read_history" role="tabpanel" aria-labelledby="user_read_history-tab">
                                            @include('user.user_read_history')
                                        </div>
                                        <div class="tab-pane fade" id="user_bill" role="tabpanel" aria-labelledby="user_bill-tab">
                                            @include('user.user_bill')
                                        </div>
                                        <div class="tab-pane fade" id="user_bookmark" role="tabpanel" aria-labelledby="user_bookmark-tab">
                                            @include('user.user_bookmark')
                                        </div>
                                        @if (Auth::user()->email_verified_at !== null)
                                            <div class="tab-pane fade" id="user_report" role="tabpanel" aria-labelledby="user_report-tab">
                                                @include('user.report.user_report')
                                            </div>
                                        @endif

                                    </div>

                                </div>

                            </div>
                        @else
                            <div class="card-body">
                                @include('layouts.404_traiphep')
                            </div>
                        @endif


                    @endauth
                @endguest
            </div>
        </div>
    </div>
@endsection
