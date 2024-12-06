@php
use App\Models\Comment;
use App\Models\Novel;
use Illuminate\Support\Facades\DB;

$novels = Novel::select('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense', DB::raw('COUNT(tblbookmarks.id) as bookmark_count'))
    ->leftJoin('tblbookmarks', 'tblnovel.id', '=', 'tblbookmarks.idNovel')
    ->groupBy('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense')
    ->where('tblnovel.iLicense_Status', '=', 1)
    ->where('tblnovel.iStatus', '=', 1)
    ->orderByDesc('bookmark_count')
    ->take(10)
    ->get();
@endphp

<div class="card" style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
    <div class="card-header fw-bold" style="background-color: #dff2e6; color: #2d6a4f; padding: 12px; text-align: center; font-weight: bold; font-size: 1.1rem;">
        Truyện được đánh dấu nhiều
    </div>
    <div class="card-body" style="padding: 16px;">
        <div class="ntp_slick" style="display: flex; flex-wrap: wrap; gap: 16px;">
            @foreach ($novels as $key => $novel)
            <div class="card ntp_novel2 d-flex mb-4" 
                 style="background-color: #f0fff4; border: 1px solid #c4e1c2; border-radius: 8px; width: calc(50% - 8px); height: 150px; overflow: hidden;">
                <!-- Cột ảnh -->
                <div class="img-container" style="flex: 1; height: 100%; overflow: hidden; border-right: 1px solid #c4e1c2;">
                    <a href="{{ route('Novel.show', [$novel->id]) }}">
                        <img class="w-100 ntp_anh_bia" src="{{ asset('uploads/images/'.$novel->sCover) }}" 
                             alt="{{$novel->sCover}}" style="width: 100%; height: 100%; object-fit: cover;">
                    </a>
                </div>

                <!-- Cột thông tin -->
                <div class="info-container d-flex flex-column justify-content-between p-2" 
                     style="flex: 2; background-color: #ffffff; padding: 10px;">
                    <a href="{{ route('Novel.show', [$novel->id]) }}">
                        <p class="card-title ntp_novel_title m-0 fw-bold" 
                           style="font-size: 1rem; color: #1b4332; font-weight: bold;">
                            {{ $novel->sNovel }}
                        </p>
                    </a>
                    <div class="card-footer p-0 ntp_novel_infor" 
                         style="font-size: 0.85rem; color: #6c757d; text-align: left;">
                         {{ $novel->bookmark_count }} lượt đánh dấu
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>




