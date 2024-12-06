@php
    use Illuminate\Support\Facades\DB;

$cats = DB::table('tblcategories as categories')
    ->select(
        'categories.id', 
        'categories.sCategories', 
        DB::raw('COUNT(DISTINCT novels.id) as novel_count')
    )
    ->leftJoin('tblclassify as classify', 'categories.id', '=', 'classify.idCategories')
    ->leftJoin('tblnovel as novels', 'classify.idNovel', '=', 'novels.id')
    ->leftJoin('tblchapter as chapters', 'novels.id', '=', 'chapters.idNovel')
    ->where('chapters.iPublishingStatus', '=', 1) // Ensure the chapter is published
    ->whereNotNull('chapters.id') // Ensure the novel has at least one chapter
    ->groupBy('categories.id', 'categories.sCategories')
    ->orderBy('novel_count', 'desc')
    ->get();

@endphp

<div class="card">
    <div class="card-header fw-bold">Thể loại</div>
    <form class="ntp_home_cat_search_form" method="POST" action="{{ route('Novel.page_tim_kiem') }}">
        @csrf
        <div class="card-body d-inline-flex gap-3 overflow-auto flex-nowrap" style="max-width: 100%; white-space: nowrap;">
            @foreach ($cats as $key => $cat)
                <input class="form-check-input btn-check ntp_home_cat_search_item" type="radio" autocomplete="off" value="{{  $cat->id }}" name="theloai[]" id="{{ Str::slug($cat->sCategories) . '_' . $cat->id }}">
                <label class="btn btn-outline-primary position-relative" for="{{ Str::slug($cat->sCategories) . '_' . $cat->id }}">
                    {{ $cat->sCategories }}
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> {{$cat->novel_count}}</span>
                </label>
            @endforeach
        </div>
        <button class="btn btn-outline-success ntp_home_cat_search_form_submit  ntp_hidden" type="submit"></button>
    </form>
</div>