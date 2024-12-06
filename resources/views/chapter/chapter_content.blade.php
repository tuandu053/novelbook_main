
<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase_history;


    $p_link = $previousChapterId != '0' ? route('Chapter.show', [$previousChapterId]) : route('Novel.show',[$novel->id]);
    $n_link = $nextChapterId != '0' ? route('Chapter.show', [$nextChapterId]) : route('Novel.show',[$novel->id]);

    $btn_pay = '<button class="btn btn-success ntp_pay_chapter ntp_un_auth">Mua ngay <i class="fa-solid fa-coins" aria-hidden="true"></i></button>';

    $is_paied = false;

        $btn_pay = '<button class="btn btn-success ntp_pay_chapter" data-link="' . route('Chapter.mua_chuong',[$chapter->id]) . '">Mua ngay ' . $chapter->iPrice . ' <i class="fa-solid fa-coins" aria-hidden="true"></i></button>';
    if(Auth::check()) {
        $purchase_history = Purchase_history::where('idChapter',$chapter->id)->where('idUser',Auth::user()->id)->first();

        if ($purchase_history) {
        $is_paied = true;
    }
    }

?>

<div class="ntp_chapter_title text-center mb-4" data-id-novel="{{$novel->id}}" data-link-novel="{{route('Novel.show',[$novel->id])}}">
    <a href="{{route('Novel.show',[$novel->id])}}" class="title text-decoration-none text-reset fw-bold"><h3 class="ntp_novel_name">{{$novel->sNovel}}</h3></a>
    <h5 class="ntp_chapter_name">{{'Chương '.$chapter->iChapterNumber.': '.$chapter->sChapter}}</h5>
</div>

<div class="card">
    <div class="alert alert-success ntp_alert_content ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_alert_content ntp_hidden" role="alert"></div>
    <div class="card-header d-flex gap-3 fw-bold justify-content-evenly align-items-center">
        <a href="{{$p_link}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Chương trước </a>
        <a href="{{route('Novel.show',[$novel->id]).'#ntp_mucluc'}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-bars" aria-hidden="true"></i>Mục lục</a>
        <a href="{{$n_link}}" class="d-flex gap-2 align-items-center">Chương sau <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
    </div>
    <div class="card-body ntp_content">
        @if($chapter->iPublishingStatus == 1)
            @if($chapter->iStatus == 1)
                @if($chapter->icharges == 1)
                    @if($is_paied)
                        {!!htmlspecialchars_decode($chapter->sContent)!!}
                    @else
                        @if(Auth::check())
                            @if(Auth::user()->id == $novel->idUser)
                                {!!htmlspecialchars_decode($chapter->sContent)!!}
                            @else
                                <div class="alert alert-danger ntp_default w-100 text-center ntp_alert_static" role="alert">Bạn cần trả phí để xem chương này <?php echo($btn_pay); ?></div>
                            @endif
                        @else
                            <div class="alert alert-danger ntp_default w-100 text-center ntp_alert_static" role="alert">Bạn cần trả phí để xem chương này <?php echo($btn_pay); ?></div>
                        @endif
                    @endif
                @else
                    {!!htmlspecialchars_decode($chapter->sContent)!!}
                @endif
            @else
                <div class="alert alert-danger ntp_default w-100 text-center" role="alert">Chương này đã bị gỡ bỏ</div>
            @endif
        @elseif($chapter->iPublishingStatus == 3)
            <div class="alert alert-danger ntp_default w-100 text-center" role="alert">Chương này không thông qua xét duyệt</div>
        @else
            <div class="alert alert-danger ntp_default w-100 text-center" role="alert">Chương này chưa qua xét duyệt</div>
        @endif
    </div>
    <div class="card-footer d-flex gap-3 fw-bold justify-content-evenly align-items-center">
        <a href="{{$p_link}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Chương trước </a>
        <a href="{{route('Novel.show',[$novel->id]).'#ntp_mucluc'}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-bars" aria-hidden="true"></i>Mục lục</a>
        <a href="{{$n_link}}" class="d-flex gap-2 align-items-center">Chương sau <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
    </div>
</div>

