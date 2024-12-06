

<?php

use Carbon\Carbon;

?>
<div class="card" id="ntp_mucluc">
    <div class="card-header fw-bold" >Mục lục</div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
            <table class="table table-hover ntp_novel_list">
                <thead>
                    <tr>
                        <th scope="col">Tên chương</th>
                        <th scope="col">Giá tiền</th>
                        <th scope="col">Cập nhật lúc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chapters as $key => $chapter)
                    <tr class="ntp_mucluc">
                        <td class=" ntp_chapter_name text-start">
                            <a href="{{ route('Chapter.show', [$chapter->id]) }}"
                                class="title text-decoration-none text-reset fw-bold">
                                Chương
                                <?php echo $chapter->iChapterNumber; ?>: {{$chapter->sChapter}}.
                            </a>
                        </td>
    
                        <td class="ntp_chapter_price w-20">
                            <?php
                                if($chapter->icharges == 1) {
                                    echo $chapter->iPrice . ' <i class="fa-solid fa-coins" aria-hidden="true"></i>';
                                } else {
                                    echo 'Miễn phí';
                                }
                            ?>
                        </td>
    
                        <td class="ntp_time_update w-20">
                            <?php
                            $minutes = 36450; // Ví dụ số phút
                            
                            $days = floor($minutes / (24 * 60));
                            $hours = floor(($minutes - $days * 24 * 60) / 60);
                            $remainingMinutes = $minutes % 60;
    
                            $time = Carbon::parse($chapter->dCreateDay);
                            $time = $time->locale('Vi');
    
                            // Tính khoảng thời gian so với thời điểm hiện tại
                            $diff = $time->diffForHumans();
                            
                            echo  $diff ;
                            ?>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>

        </div>
    </div>
</div>
