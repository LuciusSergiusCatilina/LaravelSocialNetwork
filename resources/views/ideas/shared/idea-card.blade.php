<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageURL() }}"
                    alt="{{ $idea->user->name }} Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">
                            {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div class ="d-flex">
                <a href ="{{ route('ideas.show', $idea->id) }}">view</a>
                @auth()
                    {{-- @can('idea.edit', $idea)  GATES--}}
                    @can('update',$idea)
                        <form method = "POST", action = "{{ route('ideas.destroy', $idea->id) }}">
                            @csrf
                            @method('delete')
                            <a href ="{{ route('ideas.edit', $idea->id) }} " class = "mx-2">edit</a>
                            <button class = "btn btn-danger btn-sm ms-1">X</button>
                        </form>
                    @endcan
                @endauth
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form method = "POST" action ="{{ route('ideas.update', $idea->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea name = "content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class = "d-block fs-6 text-danger mt-3">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button type = "submit" class="btn btn-dark"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ date('F j, g:i a', strtotime($idea->created_at)) }} </span>
            </div>
        </div>
        @include('ideas.shared.comments-box')
    </div>
</div>
