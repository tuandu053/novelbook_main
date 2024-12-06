<form method="POST" action="{{ route('Categories.update', [$cat->id]) }}">
    @csrf
    <div class="alert alert-success ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_hidden" role="alert"></div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="tentheloai"
            value="{{ old('tentheloai') ? old('tentheloai') : $cat->sCategories }}"
            id="floatingInput" placeholder="Tên danh mục">
        <label for="floatingInput">Tên danh mục</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Leave a comment here" name="motatheloai" id="floatingTextarea"
            style="height: 300px;">{{ old('motatheloai') ? old('motatheloai') : $cat->sDes }}</textarea>
        <label for="floatingTextarea">Mô tả</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingSelect" name="trangthai"
            aria-label="Floating label select example">
            <option <?php echo $cat->iStatus == 1 ? 'selected' : ''; ?> value="1">Kích hoạt</option>
            <option <?php echo $cat->iStatus == 0 ? 'selected' : ''; ?> value="0">Vô hiệu hóa</option>
        </select>
        <label for="floatingSelect">Trạng thái hoạt động</label>
    </div>
</form>
