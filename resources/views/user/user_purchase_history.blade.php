
<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase_history;
use App\Models\Chapter;
use App\Models\Novel;

    if(Auth::check()) {
        $iduser = Auth::user()->id;
        $purchase_historys = Purchase_history::where('idUser',$iduser)->get();
    }
?>

@if(Auth::check())
<div class="card" style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
    <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px; text-align: center; font-size: 1.1rem;">
        Lịch sử mua chương
    </div>
    <div class="card-body" style="background-color: #fffaf5;">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 600px;">
            <table class="table table-hover">
                <thead>
                    <tr style="background-color: #ffe6cc; color: #d35400;">
                        <th scope="col">STT</th>
                        <th scope="col">Tên truyện</th>
                        <th scope="col">Tên chương</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Ngày mua</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase_historys as $key => $purchase_history)
                    <tr style="background-color: #fff5e6;">
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            <?php 
                            $chapter = Chapter::find($purchase_history->idChapter);
                            $novel = Novel::find($chapter->idNovel);
                            echo($novel->sNovel);
                            ?>
                        </td>
                        <td>Chương {{ $chapter->iChapterNumber }}: {{ $chapter->sChapter }}</td>
                        <td>{{ $purchase_history->iprice }} <i class="fa-solid fa-coins" aria-hidden="true"></i></td>
                        <td>
                            <?php
                            $date = $purchase_history->dCreateDay;
                            $formatted_date = $date->format('d / m / Y');
                            echo $formatted_date;
                            ?>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endif