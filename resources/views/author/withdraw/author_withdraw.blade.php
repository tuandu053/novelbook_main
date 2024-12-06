

@php
use Carbon\Carbon;
use App\Models\Withdraw;
    $withdraws = withdraw::where('idUser',Auth::user()->id)->get();
@endphp
@if (Auth::check())
<div class="col-md-12">
    <div class=" row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Thu nhập</div>
                <div class="card-body card-body text-center fs-1" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                    {{Auth::user()->iCoint_receive}} <i class="fa-solid fa-sack-dollar"></i>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Lịch sử rút tiền</div>
                <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                    <div class="alert ntp_default ntp_alert_static alert-success" role="alert">
                        <h4 class="alert-heading">NovelBook Xin chào {{Auth::user()->name}}!</h4>
                        <p>Yêu cầu rút tiền của bạn sẽ được xử lý trong vòng từ 3-5 ngày </p>
                        <hr>
                        <p class="mb-0">Nếu có vấn đề trong chuyển khoản hay rút tiền bạn vui lòng báo cáo với đội quản trị để được giải quyết</p>
                    </div>
                    <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Số xu rút</th>
                                    <th scope="col">Số tiền quy đổi</th>
                                    <th scope="col">Thời gian <br> khởi tạo yêu cầu</th>
                                    <th scope="col">Ngân hàng</th>
                                    <th scope="col">Số tài khoản</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraws as $key => $withdraw)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $withdraw->iCoint }}</td>
                                        <td>{{ number_format($withdraw->iCoint * 1000, 0, ',', '.'); }} VNĐ</td>
                                        <td>{{ $withdraw->dCreateDay }}
                                            @php
                                            $startOfMonth = Carbon::now()->startOfMonth();
                                            $endOfMonth = Carbon::now()->endOfMonth();
                                            $date = Carbon::parse($withdraw->dCreateDay);
                                            if ($date->between($startOfMonth, $endOfMonth)) {
                                                echo '<button data-link="' . route('Author.author_withdraw_cancel',[$withdraw->id]) . '" class="btn btn-outline-success w-75 mt-2 btn_cancel_withdraw" >Hủy yêu cầu</button>';
                                            }

                                        @endphp
                                        </td>
                                        <td>{{ $withdraw->sBank }} </td>
                                        <td>{{ $withdraw->sBankAccountNumber }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Số xu bạn muốn rút là (1 xu = 1.000 VNĐ)</div>
                <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                    <div class="alert ntp_default ntp_alert_static alert-danger" role="alert">
                        <p>Vì để tránh nhầm lẫn trong chuyển khoản bạn cần kiểm tra chính xác các thông tin chuyển khoản mà bạn cung cấp cho chúng tôi (các thông này này bạn đã cung cấp khi đăng ký tác giả)</p>
                    </div>
                    <form method="POST" id="author_withdraw_form" action="{{ route('Author.Author_withdraw') }}">
                        <div class="alert alert-success ntp_hidden" role="alert"></div>
                        <div class="alert alert-danger ntp_hidden" role="alert"></div>
                        <div class="mb-3">
                            <label class="small mb-1">Thông tin chuyển khoản</label>
                            <p><strong>Ngân hàng: </strong>{{$author->sBank}}</p>
                            <p><strong>Số tài khoản: </strong>{{$author->sBankAccountNumber}}</p>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputcoint">Số xu muốn rút</label>
                            <input class="form-control" id="inputcoint" maxlength="255" name="coint" type="number" placeholder="Số xu phải lớn hơn hoặc băng 100" min="100" required>
                        </div>
                    </form>
                    <button class="btn btn-primary ntp_btn_author_withdraw" type="button"><i class="fa-solid fa-paper-plane ms-2"></i> Gửi yêu cầu</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endif