<?php
use App\Models\Chapter;
use App\Models\Reading_history;
use App\Models\Novel;

if (!isset($novels)) {
    $novels = Novel::select(
                'tblnovel.id as novelId',
                'tblnovel.sNovel',
                'tblnovel.sCover',
                'tblnovel.sDes',
                'tblnovel.dCreateDay as novelCreateDay',
                'tblnovel.dUpdateDay',
                'tblnovel.sProgress',
                'tblnovel.iStatus',
                'tblnovel.idUser',
                'tblnovel.iLicense_Status',
                'tblnovel.sLicense',
                'users.id as authorId',
                'tblauthor.sNickName as sNickName ',
                'users.name as authorName',
                'users.email as authorEmail',
                'users.sRole as authorRole',
                'users.sAvatar as authorAvatar',
                'users.sAdress as authorAddress',
                'users.dBirthday as authorBirthday',
                DB::raw('COUNT(tblreading_history.id) as totalReads'),
                DB::raw('COUNT(DISTINCT tblchapter.id) as totalChapters'),
                DB::raw('COALESCE(AVG(tblcomment.sPoint), 0) AS averagePoints'))

                ->join('tblchapter', 'tblnovel.id', '=', 'tblchapter.idNovel')
                ->leftJoin('tblreading_history', 'tblchapter.id', '=', 'tblreading_history.idChapter')
                ->join('users', 'tblnovel.idUser', '=', 'users.id')
                ->join('tblauthor', 'tblnovel.idUser', '=', 'tblauthor.idUser')
                ->leftJoin('tblcomment', 'tblnovel.id', '=', 'tblcomment.idNovel')
                ->where('tblnovel.iLicense_Status', 1)
                ->where('tblnovel.iStatus', 1)
                ->where('tblchapter.iPublishingStatus', 1)
                ->where('tblchapter.iStatus', 1)
                ->groupBy('tblnovel.id', 
                'users.id',
                'tblnovel.sNovel',
                'tblnovel.sCover',
                'tblnovel.sDes',
                'tblauthor.id',
                'tblnovel.dCreateDay',
                'tblnovel.dUpdateDay',
                'tblnovel.sProgress',
                'tblnovel.iStatus',
                'tblnovel.idUser',
                'tblnovel.iLicense_Status',
                'tblnovel.sLicense',
                'users.id',
                'tblauthor.sNickName',
                'users.name',
                'users.email',
                'users.sRole',
                'users.sAvatar',
                'users.sAdress',
                'users.dBirthday',);
}
// dd($novels);

?>
@extends('layouts.app')

@section('content')
    <div class="container ntp_search_page">

        <div class="row container justify-content-center">
            @include('search.search')
            <div class="col-md-12 row mb-3 p-0">
                @if ($novels)
                    @foreach ($novels as $novel)
                        <div class="col-lg-3 col-md-4 col-sm-6 py-2">
                            <div class="card h-100 novel_item ntp_novel text-center ">
                                <a class="md-2 mb-auto" href="{{ route('Novel.show', [$novel->novelId]) }}">
                                    <img class="w-100 ntp_anh_bia" src="{{ asset('uploads/images/' . $novel->sCover) }}"
                                        class="img-fluid" alt="{{$novel->sCover}}">
                                </a>
                                <a href="{{ route('Novel.show', [1]) }}">
                                    <p class="card-title ntp_novel_title m-0 fw-bold"> {{ $novel->sNovel }} </p>
                                </a>
                                <div class="card-footer d-flex justify-content-around flex-wrap p-1 ntp_novel_infor">
                                    <span class="w-50">{{ $novel->totalReads }} lượt đọc</span>
                                    <span class="w-50">{{ round($novel->averagePoints, 1) }} điểm</span>
                                    <span class="w-50">{{ $novel->totalChapters}} chương</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Không tìm thấy truyện theo yêu cầu của bạn.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
