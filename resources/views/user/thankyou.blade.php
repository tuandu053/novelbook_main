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
                        <div class="card">
                            <div class="card-header fw-bold"> Thông báo giao dịch nạp tiền của người dùng {{Auth::user()->name}} </div>

                            <div class="card-body">

                                @if ($user && Auth::user()->id == $user->id && Auth::check())
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Số tiền giao dịch</th>
                                            <th scope="col">Số xu nhận được</th>
                                            <th scope="col">Thời gian </br>khởi tạo giao dịch</th>
                                            <th scope="col">Ngày thanh toán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="">{{$bill->iMoney}}</td>
                                            <td class="">{{$bill->iCoint}}</td>
                                            <td class="">{{$bill->dCreateDay}}</td>
                                            <td class="">{{$bill->dUpdateDay}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="alert alert-success" role="alert"><span class="ntp_alert_close bg-success"><button
                                    type="button" class="btn-close"></button></span>{{ $message }} <a class="link-success text-decoration-underline" href="{{ route('User.show', [Auth::user()->id,'view=user_bill-tab']) }}">Kiểm tra ví tiền nhanh</a></div>
                                @endif

                                @if (isset($erro) && $erro != '')
                                <div class="alert alert-danger" role="alert"><span class="ntp_alert_close bg-success"><button
                                    type="button" class="btn-close"></button></span>{{ $erro }}</div>
                                @endif
                                
                            </div>

                        </div>
                    @endauth
                @endguest
            </div>
        </div>
    </div>
@endsection
