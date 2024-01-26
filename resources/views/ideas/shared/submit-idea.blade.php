@auth()
<h4> Share yours ideas </h4>
<form action ="{{route('ideas.store')}}" method = "POST">
    @csrf
<div class="row">
    <div class="mb-3">
        <textarea name = "content" class="form-control" id="content" rows="3"></textarea>
        @error('content')
            <span class = "d-block fs-6 text-danger mt-3">{{$message}}</span>
        @enderror
    </div>
    <div class="">
        <button name = "btn" type = "submit" class="btn btn-dark"> Share </button>
    </div>
</form>
</div>
@endauth
@guest()
<h4>Login to Share yours ideas </h4>
@endguest



