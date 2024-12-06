<?php
use App\Models\Novel;
use App\Models\Bookmarks;
use Illuminate\Support\Facades\Auth;
?>


<div class="card ntp_bookmarks_card" style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
    <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px; text-align: center; font-size: 1.1rem;">
        Đánh dấu của bạn
    </div>
    <div class="card-body" style="background-color: #fffaf5; padding: 16px;">
        
        @if (Auth::check())
            <?php
                $iduser = Auth::user()->id;
                $bookmarks = Bookmarks::where('idUser', $iduser)->get();
            ?>
            <div class="overflow-auto ntp_bookmarks ntp_custom_ver_scrollbar" style="height: 300px;">
                @foreach ($bookmarks as $key => $bookmark)
                    <?php
                    $novel = Novel::find($bookmark->idNovel);
                    ?>
                    <div class="d-flex flex-row my-2 align-items-center justify-content-between" style="background-color: #fff5e6; padding: 8px; border-radius: 8px; margin-bottom: 10px;">
                        <a href="{{ route('Novel.show', [$novel->id]) }}" class="title text-truncate text-decoration-none text-reset" style="font-size: 1rem; color: #d35400;">
                            {{ $novel->sNovel }}
                        </a>
                        <a href="javascript:void(0);" data-link="{{ route('Bookmark.bookmark_remove', [$novel->id]) }}" class="btn btn-danger ntp_bookmark_remove mx-2">X</a>
                    </div>
                    <hr style="border-color: #f7d9c4;">
                @endforeach
            </div>
        @else
            <div class="overflow-auto ntp_bookmarks ntp_bookmarks_locall ntp_custom_ver_scrollbar" style="height: 200px; background-color: #fff5e6; padding: 10px; border-radius: 8px;">
                Bạn chưa có đánh dấu nào. Hãy đánh dấu các truyện yêu thích của bạn.
            </div>
        @endif
    </div>
</div>

