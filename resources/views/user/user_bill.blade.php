<div class="col-md-12">
    <div class=" row">
        <div class="col-md-6 mb-4">
            <div class="card" style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px; text-align: center; ">
                    Thu nhập
                </div>
                <div class="card-body card-body text-center fs-1" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                    {{$user->iCoint_receive}} <i class="fa-solid fa-sack-dollar" style="color: #d35400;"></i>
                </div>
            </div>

        </div>
        <div class="col-md-6 mb-4">
            <div class="card" style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px; text-align: center; font-weight: bold; ">
                    Số xu hiện có
                </div>
                <div class="card-body card-body text-center fs-1" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                    {{$user->iCoint}} <i class="fa-solid fa-sack-dollar" style="color: #d35400;"></i>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card" style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Nạp Tiền</div>
                <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                    <form method="POST" action="{{ route('Bill.Naptien') }}"
                        class="d-flex flex-wrap gap-3" target="_blank" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <input class="btn-check" type="radio" name="menh_gia" id="menh_gia1" value="1" required>
                        <label class="btn btn-outline-primary" for="menh_gia1">20.000 VNĐ</label>

                        <input class="btn-check" type="radio" name="menh_gia" id="menh_gia2" value="2">
                        <label class="btn btn-outline-primary" for="menh_gia2">50.000 VNĐ</label>

                        <input class="btn-check" type="radio" name="menh_gia" id="menh_gia3" value="3">
                        <label class="btn btn-outline-primary" for="menh_gia3">100.000 VNĐ</label>

                        <input class="btn-check" type="radio" name="menh_gia" id="menh_gia4" value="4">
                        <label class="btn btn-outline-primary" for="menh_gia4">200.000 VNĐ</label>

                        <input class="btn-check" type="radio" name="menh_gia" id="menh_gia5" value="5">
                        <label class="btn btn-outline-primary" for="menh_gia5">300.000 VNĐ</label>

                        <input class="btn-check" type="radio" name="menh_gia" id="menh_gia6" value="6">
                        <label class="btn btn-outline-primary" for="menh_gia6">400.000 VNĐ</label>

                        <input class="btn-check" type="radio" name="menh_gia" id="menh_gia7" value="7">
                        <label class="btn btn-outline-primary" for="menh_gia7">500.000 VNĐ</label>

                        <div class="w-100">
                            <label class="" for="bankcode">Phương thức giao dịch</label>
                            <select name="bankcode" id="bankcode" class="form-control" required>
                                <option value="JCB">JCB</option>
                                <option value="UPI">UPI</option>
                                <option value="VIB">VIB</option>
                                <option value="VIETCAPITALBANK">VIETCAPITALBANK</option>
                                <option value="SCB">Ngan hang SCB</option>
                                <option value="NCB">Ngan hang NCB</option>
                                <option value="SACOMBANK">Ngan hang SacomBank  </option>
                                <option value="EXIMBANK">Ngan hang EximBank </option>
                                <option value="MSBANK">Ngan hang MSBANK </option>
                                <option value="NAMABANK">Ngan hang NamABank </option>
                                <option value="VNMART"> Vi dien tu VnMart</option>
                                <option value="VIETINBANK">Ngan hang Vietinbank  </option>
                                <option value="VIETCOMBANK">Ngan hang VCB </option>
                                <option value="HDBANK">Ngan hang HDBank</option>
                                <option value="DONGABANK">Ngan hang Dong A</option>
                                <option value="TPBANK">Ngân hàng TPBank </option>
                                <option value="OJB">Ngân hàng OceanBank</option>
                                <option value="BIDV">Ngân hàng BIDV </option>
                                <option value="TECHCOMBANK">Ngân hàng Techcombank </option>
                                <option value="VPBANK">Ngan hang VPBank </option>
                                <option value="AGRIBANK">Ngan hang Agribank </option>
                                <option value="MBBANK">Ngan hang MBBank </option>
                                <option value="ACB">Ngan hang ACB </option>
                                <option value="OCB">Ngan hang OCB </option>
                                <option value="IVB">Ngan hang IVB </option>
                                <option value="SHB">Ngan hang SHB </option>
                            </select>
                        </div>


                        <button type="submit" name="redirect" class="btn btn-primary">Thanh Toán</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Hóa đơn của bạn</div>
                <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                    <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Số tiền giao dịch</th>
                                    <th scope="col">Số xu nhận được</th>
                                    <th scope="col">Thời gian giao dịch</th>
                                    <th scope="col">Tình trạng hóa đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $key => $bill)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td class="{{$bill->iStatus == 1 ? '' : 'text text-danger'}}">{{ $bill->iMoney }}</td>
                                        <td class="{{$bill->iStatus == 1 ? '' : 'text text-danger'}}">{{ $bill->iCoint }}</td>
                                        <td class="{{$bill->iStatus == 1 ? '' : 'text text-danger'}}">{{ $bill->dCreateDay }}</td>
                                        <td>

                                            @if($bill->iStatus == 1)
                                            <span class="text text-success">Đã thanh toán</span>
                                            @else
                                                @if(Auth::user())
                                                    @php
                                                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                                                    $vnp_Returnurl = "http://192.168.2.39:8000/Nap-tien-thanh-cong/".Auth::user()->id;
                                                    $vnp_TmnCode = "KEZ10GK3"; //Mã website tại VNPAY 
                                                    $vnp_HashSecret = "JA4HEI3W8AF7QIAYX18W1DKAQ7W1WIMH"; //Chuỗi bí mật
                                                    $vnp_BankCode = "NCB";

                                                    $inputData = array(
                                                        "vnp_Version" => "2.1.0",
                                                        "vnp_TmnCode" => $vnp_TmnCode,
                                                        "vnp_Amount" => $bill->iMoney*100,
                                                        "vnp_Command" => "pay",
                                                        "vnp_CreateDate" => date('YmdHis'),
                                                        "vnp_CurrCode" => "VND",
                                                        "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
                                                        "vnp_Locale" => "vn",
                                                        "vnp_OrderInfo" => "Thanh toán hóa đơn",
                                                        "vnp_OrderType" => "NTP_Novel",
                                                        "vnp_ReturnUrl" => $vnp_Returnurl,
                                                        "vnp_TxnRef" => $bill->vnp_TxnRef
                                                    );
                                            
                                                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                                                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                                                    }

                                                    ksort($inputData);
                                                    $query = "";
                                                    $i = 0;
                                                    $hashdata = "";
                                                    foreach ($inputData as $key => $value) {
                                                        if ($i == 1) {
                                                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                                                        } else {
                                                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                                                            $i = 1;
                                                        }
                                                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                                                    }
                                            
                                                    $vnp_Url = $vnp_Url . "?" . $query;
                                                    if (isset($vnp_HashSecret)) {
                                                        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                                                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                                                    }

                                                    @endphp
                                                    <span class="text text-danger"><a href="{{$vnp_Url}}">Chưa thanh toán</a></span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
