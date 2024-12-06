@extends('layouts.app')

@section('content')
    <div class="container">
    
        <div class="row justify-content-center" >
        <img src="{{ asset('uploads/background/banner.jpg') }}" alt="banner" class="w-100">
            @include('search.search')
            <div class="col-md-12 mb-4">
                        {{-- Thể loại --}}
                        @include('home_template.theloai')
                    </div>
            <div class="col-md-12 mb-5">
                @include('home_template.danhgiacao')
            </div>
            
            <div class="col-md-4 mb-5">
                @include('home_template.docnhieu')
            </div>

            <div class="col-md-4 mb-5">
                {{-- truyện được đánh dấu nhiều --}}
                @include('home_template.danhdaunhieu')
            </div>
            <div class="col-md-4 mb-5">
                @include('home_template.docnhieutrongtuan')

            </div>

            <div class="col-md-12 mb-5">
                <div class=" row">
                    <div class="col-md-12 mb-4 ">
                        {{-- truyện mới cập nhật --}}
                        @include('home_template.truyenmoicapnhat')
                    </div>
                    
                </div>
            </div>

            

        </div>
    </div>
@endsection
