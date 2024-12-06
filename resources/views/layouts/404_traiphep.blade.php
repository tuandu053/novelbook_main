<div class="alert alert-danger" role="alert">
    
@guest
    bạn đang truy cập trái phép trang không thuộc quyền truy cập của mình
@else
    @auth
    {{ Auth::user()->name }} bạn đang truy cập trái phép trang không thuộc quyền truy cập của mình
    @endauth
@endguest

</div>

