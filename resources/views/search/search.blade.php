<?php

use App\Models\Categories;
use Illuminate\Support\Str;
$cats = Categories::orderBy('id', 'DESC')->where('iStatus', 1)->get();
$value = '';

if (isset($ispage_timkiem) && $ispage_timkiem) {
    if (isset($name) && $name != '') {
        $value = $name;
       
    }
}

?>
<div class="col-md-12 mt-3 mb-1">
    <form class="" method="POST" action="{{ route('Novel.page_tim_kiem') }}">
        @csrf
        <div class="d-flex">
            <input class="form-control me-2 w-75" type="search" value="{{ $value }}" name="novel_name"
                placeholder="Nhập tên truyện cần tìm kiếm" aria-label="Search">
            <button class="btn btn-success w-25" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
        </div>

        @if (isset($ispage_timkiem) && $ispage_timkiem)
            <div class="d-flex mt-3 gap-3">
                <input class="form-control" type="search" value="{{ $author_name }}" name="author_name"
                placeholder="Nhập tên tác giả (Bút danh)">
            </div>
            <div class="d-flex mt-3 gap-3">
                <span class="flex-shrink-0 fw-bold">Thể loại</span>
                <div class="d-flex flex-wrap gap-2">

                    @foreach ($cats as $key => $cat)
                        <input class="form-check-input btn-check"
                            {{ in_array($cat->id, $Search_type_id) ? 'checked' : '' }} type="checkbox"
                            autocomplete="off" value="{{ $cat->id }}" name="theloai[]"
                            id="{{ Str::slug($cat->sCategories) . '_' . $cat->id }}">
                        <label class="btn btn-primary"
                            for="{{ Str::slug($cat->sCategories) . '_' . $cat->id }}">{{ $cat->sCategories }}</label>
                    @endforeach
                </div>
            </div>
            <div class="d-flex mt-3 gap-3">
                <span  class="flex-shrink-0 fw-bold">Sắp xếp theo</span>
                <div class="d-flex flex-wrap gap-2">

                    <input class="form-check-input btn-check" id='ntp_sapxep_luot_doc'
                        {{ $sapxep == 'luot_doc' ? 'checked' : '' }} type="radio"  value="luot_doc"
                        name="sapxep">
                    <label class="btn btn-primary" for="ntp_sapxep_luot_doc">Lượt đọc</label>

                    <input class="form-check-input btn-check" id='ntp_sapxep_danh_gia'
                        {{ $sapxep == 'danh_gia' ? 'checked' : '' }} type="radio" value="danh_gia"
                        name="sapxep">
                    <label class="btn btn-primary" for="ntp_sapxep_danh_gia">Đánh giá cao</label>

                    <input class="form-check-input btn-check" id='ntp_sapxep_cap_nhat'
                        {{ $sapxep == 'cap_nhat' ? 'checked' : '' }} type="radio" value="cap_nhat"
                        name="sapxep">
                    <label class="btn btn-primary" for="ntp_sapxep_cap_nhat">Mới cập nhật</label>

                    @if($sapxep != '')
                        <input class="form-check-input btn-check" id='ntp_sapxep_Khong_sap_xep'
                        {{ $sapxep == 'Khong_sap_xep' ? 'checked' : '' }} type="radio" value=""
                        name="sapxep">
                        <label class="btn btn-primary" for="ntp_sapxep_Khong_sap_xep">Không sắp xếp</label>
                    @endif
                    

                </div>
            </div>
            <div class="d-flex mt-3 gap-3">
                <span  class="flex-shrink-0 fw-bold"> Tiến độ</span>
                <div class="d-flex flex-wrap gap-2">

                    <input class="form-check-input btn-check" id='ntp_tiendo_con_tiep'
                        {{ $tiendo == '1' ? 'checked' : '' }} type="radio"  value="1"
                        name="tiendo">
                    <label class="btn btn-primary" for="ntp_tiendo_con_tiep">Còn tiếp</label>

                    <input class="form-check-input btn-check" id='ntp_tiendo_tam_dung'
                        {{ $tiendo == '2' ? 'checked' : '' }} type="radio" value="2"
                        name="tiendo">
                    <label class="btn btn-primary" for="ntp_tiendo_tam_dung">Tạm ngưng</label>

                    <input class="form-check-input btn-check" id='ntp_tiendo_hoan_thanh'
                        {{ $tiendo == '3' ? 'checked' : '' }} type="radio" value="3"
                        name="tiendo">
                    <label class="btn btn-primary" for="ntp_tiendo_hoan_thanh">Hoàn thành</label>

                    @if($tiendo != '')
                        <input class="form-check-input btn-check" id='ntp_tiendo_tat_ca'
                        {{ $tiendo == 'Khong_sap_xep' ? 'checked' : '' }} type="radio" value=""
                        name="tiendo">
                        <label class="btn btn-primary" for="ntp_tiendo_tat_ca">Không sắp xếp</label>
                    @endif
                    

                </div>
            </div>
        @endif
    </form> 
</div>
