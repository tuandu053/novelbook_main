<?php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use App\Models\Chapter;

    $new_updates = DB::table('tblchapter')
        ->select('tblchapter.dCreateDay','tblnovel.sNovel','tblnovel.sCover','tblnovel.id','tblauthor.sNickName')
        ->join(DB::raw('(SELECT MAX(dCreateDay) as dCreateDay, idNovel FROM tblchapter  WHERE iStatus = 1 AND iPublishingStatus = 1 GROUP BY idNovel) as latest'), function($join) {
            $join->on('tblchapter.dCreateDay', '=', 'latest.dCreateDay')
                ->on('tblchapter.idNovel', '=', 'latest.idNovel');
        })
        ->join('tblnovel', function($join) {
            $join->on('tblchapter.idNovel', '=', 'tblnovel.id')
                ->where('tblnovel.iLicense_Status', '=', 1)
                ->where('tblnovel.iStatus', '=', 1);
        })
        ->join('tblauthor', 'tblnovel.idUser', '=', 'tblauthor.idUser')
        ->orderBy('tblchapter.dCreateDay', 'DESC')
        ->limit(20)
        ->get();
?>

<div class="card">
    <div class="card-header fw-bold">Tuyện mới cập nhật</div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
            @foreach ($new_updates as $key => $new_update)
                <div class="d-flex ntp_history_item p-1">
                    <div class="flex-shrink-0" style="width: 50px;">
                        <img class="w-100 ntp_anh_bia" src="{{ asset('uploads/images/'.$new_update->sCover) }}" alt="{{$new_update->sCover}}">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <a href="{{route('Novel.show',[$new_update->id])}}" class="title text-decoration-none text-reset fw-bold">{{$new_update->sNovel}}</a>
                        <br>
                        <span class="fw-lighter">Tác giả: {{$new_update->sNickName}}</span>
                    </div>
                    <span class="ms-3">
                        <?php                                
                            $time = Carbon::parse($new_update->dCreateDay);
                            $time = $time->locale('Vi');
                            $diff = $time->diffForHumans();
                            echo $diff;
                        ?>
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
