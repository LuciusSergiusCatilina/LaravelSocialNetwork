<div>
    <form action = "{{route('ideas.comments.store', $idea->id)}}" method = "POST">
        @csrf
    <div class="mb-3">
        <textarea name = "comment" class="fs-6 form-control" rows="1"></textarea>
        @error('comment')
        <span class = "d-block fs-6 text-danger mt-3">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button type = "submit" class="btn btn-primary btn-sm"> Post Comment </button>
    </div>
    </form>
    <hr>
    @forelse ($idea->comments as $comment)
    <div class="d-flex align-items-start">
        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
            src="{{$comment->user->getImageURL()}}"
            alt="{{ $comment->user->name}}">
        <div class="w-100">
            <div class="d-flex justify-content-between">
                <h6 class=""><a href="{{ route('users.show', $comment->user->id) }}">{{$comment->user->name}}</a>
                </h6>
                {{-- <small class="fs-6 fw-light text-muted">{{date("F j, g:i a",strtotime($comment->created_at))}} </small> --}}
                <small class="fs-6 fw-light text-muted">{{$comment->created_at->diffForHumans()}} </small>
            </div>
            <p class="fs-5 mt-1 fw-light">
                {{$comment->content}}
            </p>
        </div>
    </div>
    @empty
    <p class = "text-center mt-4"> No comments...</p>
    @endforelse

</div>
