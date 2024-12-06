@extends('layouts.app')
@section('content')
    <div class="container ntp_chapter_page">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-5">
                @include('chapter.chapter_content')
            </div>
            <div class="ntp_reader_controls">
    <div class="card mb-4">
        <div class="card-header text-center fw-bold">Trình đọc truyện</div>
        <div class="card-body text-center">
            <div class="ntp_controls">
                <button class="ntp_get_content btn btn-icon btn-primary">
                    <i class="fas fa-play"></i> Phát
                </button>
                <button class="ntp_pause btn btn-icon btn-warning">
                    <i class="fas fa-pause"></i> Tạm dừng
                </button>
                <button class="ntp_resume btn btn-icon btn-success">
                    <i class="fas fa-play"></i> Tiếp tục
                </button>
                <button class="ntp_stop btn btn-icon btn-danger">
                    <i class="fas fa-stop"></i> Dừng
                </button>
            </div>
        </div>
    </div>
</div>


            <div class="col-md-12 mb-5">
                @include('home_template.truyenmoicapnhat')
            </div>
        </div>
    </div>
@endsection


