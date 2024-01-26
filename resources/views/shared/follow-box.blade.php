<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">Top Users</h5>
    </div>
    <div class="card-body">
        @foreach ($topUsers as $user)
        <div class="hstack gap-2 mb-3">
            <div class="avatar">
                <a href="{{route('users.show',$user)}}"><img class="avatar-img rounded-circle"
                        src="{{$user->getImageURL()}}"
                        style="width:50px"
                        alt="dsa">
                </a>
            </div>
            <div class="overflow-hidden">
                <a class="h6 mb-0" href="{{route('users.show',$user)}}">{{$user->name}}</a>
                <p class="mb-0 small text-truncate">{{$user->email}}</p>
                <p class ="mb-0 small text-truncate">Count of ideas: {{$user->ideas_count}}</p>
            </div>

        </div>

        @endforeach
    </div>
</div>
