@section('title','Edit')
<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form action = "{{ route('users.update', $user->id) }}" method = 'POST' enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                        alt="{{ $user->name }}">
                    <div>
                        <input name = 'name' value = "{{ $user->name }}" type = 'text' class = 'form-control'>
                        @error('name')
                            <span class = "text-danger fs-6">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    @auth()
                        @if (Auth::id() === $user->id)
                            <a href="{{ route('users.show', $user->id) }}">View</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class ="mt-4">
                <label class = "mt-2">Profile Picture</label>
                <input type = 'file' name = 'image' class = 'form-control mt-1'>
                @error('image')
                    <span class = "d-block fs-6 text-danger mt-3">{{ $message }}</span>
                @enderror
            </div>

            <div class="px-2 mt-4">
                <h5 class="fs-5"> About : </h5>
                <div class="mb-3">
                    <textarea value = "{{ $user->bio }}" name = "bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
                    @error('bio')
                        <span class = "d-block fs-6 text-danger mt-3">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-dark btn-sm mb-3">Save</button>
                @include('users.shared.user-stats')
            </div>
        </form>
    </div>
</div>
