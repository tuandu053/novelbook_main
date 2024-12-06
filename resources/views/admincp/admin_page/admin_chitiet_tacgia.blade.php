<form method="POST" data-link="{{ route('Author.xetduyet', [$author->id]) }}">
    @csrf
    <div class="alert alert-success ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_hidden" role="alert"></div>
    <div class="mb-3">
        <label class="small mb-1" for="inputNickname">Nick name (bút danh tác giả): </label>
        <span class="text-primary">{{ $author->sNickName }}</span>
    </div>
    <div class="mb-3">
        <label class="small mb-1" for="mota_tacgia">Mô tả về bạn</label>
        <div class="border-1 border mt-2 rounded-2 p-2">
            {{ $author->sDes }}
        </div>
    </div>
    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="inputBirthday">Ngân hàng sử dụng:</label>
            <span class="text-primary">{{ $author->sBank }}</span>
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="maso_nganhhang">Số tài khoản: </label>
            <span class="text-primary">{{ $author->sBankAccountNumber }}</span>
        </div>

    </div>

    <div class="row gx-3 mb-3">
        <label for="ntp_camket_da_upload" class="form-label">Cam kết đã up load</label>
        <iframe id="ntp_camket_da_upload" src="{{ asset('uploads/camket/' . $author->sCommit) }}"
            class="w-100 vh-100"></iframe>
    </div>

    <div class="row gx-3 mb-3">
        <label for="ntp_cccd_da_upload" class="form-label">CCCD đã up load</label>
        <iframe id="ntp_cccd_da_upload" src="{{ asset('uploads/cccd/' . $author->sImg_identity) }}"
            class="w-100 vh-100"></iframe>
    </div>

    <div class="gx-3 p-3 bg-body sticky-bottom">
        {{-- <input class="btn-check" type="radio" name="vuly" id="xuly1" value="1">
        <label class="btn btn-outline-primary" for="xuly1">Đồng ý cấp quyền</label>

        <input class="btn-check" type="radio" name="vuly" id="xuly2" value="3">
        <label class="btn btn-outline-primary" for="xuly2">Từ chối cấp quyền</label> --}}

        @if($author->iStatus != 1)
            <input class="btn-check" type="radio" name="xuly" id="xuly_author1" value="1">
            <label class="btn btn-outline-primary" for="xuly_author1">Đồng ý cấp quyền</label>

            @if($author->iStatus != 3)
                <input class="btn-check" type="radio" name="xuly" id="xuly_author3" value="3">
                <label class="btn btn-outline-primary" for="xuly_author3">Từ chối cấp quyền</label>
            @endif
        @else
            <input class="btn-check" type="radio" name="xuly" id="xuly_author2" value="0">
            <label class="btn btn-outline-primary" for="xuly_author2">Gỡ quyền</label>
        @endif
    </div>
</form>