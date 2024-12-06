@php
use App\Models\Novel;
use App\Models\Reading_history;
use App\Models\Chapter;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

$oneWeekAgo = Carbon::now()->subWeek();

$novels = Novel::select('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense', DB::raw('COUNT(tblreading_history.id) as read_count'))
    ->join('tblchapter', 'tblnovel.id', '=', 'tblchapter.idNovel')
    ->join('tblreading_history', 'tblchapter.id', '=', 'tblreading_history.idChapter')
    ->where('tblreading_history.dCreateDay', '>=', $oneWeekAgo)
    ->groupBy('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense')
    ->orderByDesc('read_count')
    ->take(10)
    ->get();
@endphp

<div class="card" style="background-color: #d9eaf3; border: 1px solid #bbb; border-radius: 8px;">
    <div class="card-header fw-bold" 
         style="background-color: #7dbcd0; color: #ffffff; padding: 12px; text-align: center; font-weight: bold; font-size: 1.1rem;">
        Truyện được đọc nhiều trong tuần
    </div>
    <div class="card-body" style="padding: 16px;">
        <div class="ntp_slick" style="display: flex; flex-wrap: wrap; gap: 16px;">
            @foreach ($novels as $key => $novel)
            <div class="card ntp_novel2 d-flex mb-4" 
                 style="background-color: #f6fbfd; border: 1px solid #aaa; border-radius: 8px; width: calc(50% - 8px); height: 150px; overflow: hidden;">
                <!-- Cột ảnh -->
                <div class="img-container" style="flex: 1; height: 100%; overflow: hidden; border-right: 1px solid #ddd;">
                    <a href="{{ route('Novel.show', [$novel->id]) }}">
                        <img class="w-100 ntp_anh_bia" src="{{ asset('uploads/images/'.$novel->sCover) }}" 
                             alt="{{$novel->sCover}}" style="width: 100%; height: 100%; object-fit: cover;">
                    </a>
                </div>

                <!-- Cột thông tin -->
                <div class="info-container d-flex flex-column justify-content-between p-2" 
                     style="flex: 2; background-color: #e4f1f8; padding: 10px;">
                    <a href="{{ route('Novel.show', [$novel->id]) }}">
                        <p class="card-title ntp_novel_title m-0 fw-bold" 
                           style="font-size: 1rem; color: #285369; font-weight: bold;">
                            {{ $novel->sNovel }}
                        </p>
                    </a>
                    <div class="card-footer p-0 ntp_novel_infor" 
                         style="font-size: 0.85rem; color: #486977; text-align: left;">
                         {{ $novel->read_count }} lượt đọc
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>






