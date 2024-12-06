<form method="POST" id="ntp_form_create_author" action="<?php echo $author_found == 0 ? route('Author.store') : route('Author.update', [$author->id]); ?>">
    @csrf
    <div class="alert alert-success ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_hidden" role="alert"></div>
    <div class="mb-3">
        <label class="small mb-1" for="inputNickname">Nick name (bút danh tác giả)</label>
        <input class="form-control" id="inputNickname" maxlength="100" name="butdanh" type="text"
            placeholder="bút danh bạn định sử dụng là"
            value="{{ old('butdanh') ? old('butdanh') : ($author ? $author->sNickName : '') }}">

        <input class="form-control d-none" name="id_user" type="text" value="{{ $user->id }}">
    </div>
    <div class="mb-3">
        <label class="small mb-1" for="mota_tacgia">Mô tả về bạn</label>
        <textarea class="form-control" id="mota_tacgia" name="mota" rows="10"
            placeholder="Mô tả sơ lược về bạn ở đây ( không quá 3000 từ )..." maxlength="3000">{{ old('mota') ? old('mota') : ($author ? $author->sDes : '') }}</textarea>
    </div>
    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="bankcode">Ngân hàng bạn sử dụng</label>
            <select name="nganhang" id="bankcode" class="form-control" required>
                <option <?php echo $author ? ($author->sBank == 'JCB' ? 'selected' : '') : ''; ?> value="JCB">JCB</option>
                <option <?php echo $author ? ($author->sBank == 'VIB' ? 'selected' : '') : ''; ?> value="VIB">VIB</option>
                <option <?php echo $author ? ($author->sBank == 'VIETCAPITALBANK' ? 'selected' : '') : ''; ?> value="VIETCAPITALBANK">VIETCAPITALBANK</option>
                <option <?php echo $author ? ($author->sBank == 'SCB' ? 'selected' : '') : ''; ?> value="SCB">Ngan hang SCB</option>
                <option <?php echo $author ? ($author->sBank == 'NCB' ? 'selected' : '') : ''; ?> value="NCB">Ngan hang NCB</option>
                <option <?php echo $author ? ($author->sBank == 'SACOMBANK' ? 'selected' : '') : ''; ?> value="SACOMBANK">Ngan hang SacomBank </option>
                <option <?php echo $author ? ($author->sBank == 'EXIMBANK' ? 'selected' : '') : ''; ?> value="EXIMBANK">Ngan hang EximBank </option>
                <option <?php echo $author ? ($author->sBank == 'MSBANK' ? 'selected' : '') : ''; ?> value="MSBANK">Ngan hang MSBANK </option>
                <option <?php echo $author ? ($author->sBank == 'NAMABANK' ? 'selected' : '') : ''; ?> value="NAMABANK">Ngan hang NamABank </option>
                <option <?php echo $author ? ($author->sBank == 'VIETINBANK' ? 'selected' : '') : ''; ?> value="VIETINBANK">Ngan hang Vietinbank </option>
                <option <?php echo $author ? ($author->sBank == 'VIETCOMBANK' ? 'selected' : '') : ''; ?> value="VIETCOMBANK">Ngan hang VCB </option>
                <option <?php echo $author ? ($author->sBank == 'HDBANK' ? 'selected' : '') : ''; ?> value="HDBANK">Ngan hang HDBank</option>
                <option <?php echo $author ? ($author->sBank == 'DONGABANK' ? 'selected' : '') : ''; ?> value="DONGABANK">Ngan hang Dong A</option>
                <option <?php echo $author ? ($author->sBank == 'TPBANK' ? 'selected' : '') : ''; ?> value="TPBANK">Ngân hàng TPBank </option>
                <option <?php echo $author ? ($author->sBank == 'OJB' ? 'selected' : '') : ''; ?> value="OJB">Ngân hàng OceanBank</option>
                <option <?php echo $author ? ($author->sBank == 'BIDV' ? 'selected' : '') : ''; ?> value="BIDV">Ngân hàng BIDV </option>
                <option <?php echo $author ? ($author->sBank == 'TECHCOMBANK' ? 'selected' : '') : ''; ?> value="TECHCOMBANK">Ngân hàng Techcombank </option>
                <option <?php echo $author ? ($author->sBank == 'VPBANK' ? 'selected' : '') : ''; ?> value="VPBANK">Ngan hang VPBank </option>
                <option <?php echo $author ? ($author->sBank == 'AGRIBANK' ? 'selected' : '') : ''; ?> value="AGRIBANK">Ngan hang Agribank </option>
                <option <?php echo $author ? ($author->sBank == 'MBBANK' ? 'selected' : '') : ''; ?> value="MBBANK">Ngan hang MBBank </option>
                <option <?php echo $author ? ($author->sBank == 'ACB' ? 'selected' : '') : ''; ?> value="ACB">Ngan hang ACB </option>
                <option <?php echo $author ? ($author->sBank == 'OCB' ? 'selected' : '') : ''; ?> value="OCB">Ngan hang OCB </option>
                <option <?php echo $author ? ($author->sBank == 'IVB' ? 'selected' : '') : ''; ?> value="IVB">Ngan hang IVB </option>
                <option <?php echo $author ? ($author->sBank == 'SHB' ? 'selected' : '') : ''; ?> value="SHB">Ngan hang SHB </option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="maso_nganhhang">Số tài khoản ( viết sai dáng chịu)</label>
            <input class="form-control" id="maso_nganhhang" maxlength="20" name="maso_nganhhang" type="text"
                placeholder="Số tài khoản ( viết sai dáng chịu)"
                value="{{ old('maso_nganhhang') ? old('maso_nganhhang') : ($author ? $author->sBankAccountNumber : '') }}">
        </div>

    </div>

    <div class="row gx-3 mb-3 <?php echo $author_found == 0 ? 'd-none' : ''; ?>">
        <label for="ntp_camket_da_upload" class="form-label">Cam kết đã up load</label>
        <iframe id="ntp_camket_da_upload" src="<?php echo $author_found == 0 ? '' : asset('uploads/camket/' . $author->sCommit); ?>" class="w-100 vh-100"></iframe>
    </div>

    <div class="row gx-3 mb-3">
        <label for="upload_camket" class="form-label">Up load cam kết</label>
        <input class="form-control mb-3" type="file" name="camket" id="upload_camket">
        <a class="text-decoration-underline" href="{{ asset('uploads/camket/mau/ban-cam-ket-chiu-trach-nhiem.pdf') }}" download><i class="fa-solid fa-download"></i>Tải bản cam kết mẫu</a>
    </div>

    <!-- Save changes button-->
    <button class="btn btn-primary ntp_btn_create_author" type="button"><?php echo $author_found == 0 ? 'Xin cấp quyền tác giả' : 'Cập nhật thông tin cấp quyền tác giả'; ?></button>
</form>
