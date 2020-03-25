<a class="nav-link" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown"
   aria-haspopup="true" aria-expanded="true">
    <i class="material-icons">notifications</i>
    <span class="notification">{{count(Auth::user()->notifications)}}</span>
    <p class="d-lg-none d-md-block">
        Some Actions
    </p>
    <div class="ripple-container"></div>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
    @foreach(Auth::user()->notifications as $noty)
        <div class="row dropdown-item">
            <div class="col-sm-10">
                <a class="dropdown-item"
                   href="{{route('posts.show', $noty->data['post_id'])}}">{{$noty->data['owner']}} {{$noty->data['message']}}
                    <br>{{$noty->created_at->diffForHumans()}}
                </a>
                @if(!$loop->last)
                    <hr>
                @endif
            </div>
            <div class="col-sm-2 dropdown-item">
                <a class="deleteNotification" href="javascript:void(0)" data-id="{{$noty->id}}">
                    <i class="material-icons">close</i>
                </a>
            </div>
        </div>
    @endforeach
    @if(count(Auth::user()->notifications) == 0)
        <span class="dropdown-item">No Notification</span>
    @endif
</div>

