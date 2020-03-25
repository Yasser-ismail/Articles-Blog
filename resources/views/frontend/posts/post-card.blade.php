<div class="card-header card-header-warning" id="comments">
    <div class="row">
        <div class="col-sm-6">
            <h4> {{$post->title}}</h4>
        </div>
        @if(Auth::user())
            @if (Auth::user()->id != $post->user->id)
                @if(isset($value))
                    <div class="col-sm-3 text-right" style="margin-top: 30px;">
                        <span>Your rate:</span>
                    </div>
                    <div class="col-sm-3 text-left" style="margin-top: 30px;">
                        <select id="user_rate" data-id="{{$post->id}}">
                            <option value=""></option>
                            <option {{$value == 1 ? 'selected' : ''}} value="1">1</option>
                            <option {{$value == 2 ? 'selected' : ''}} value="2">2</option>
                            <option {{$value == 3 ? 'selected' : ''}} value="3">3</option>
                            <option {{$value == 4 ? 'selected' : ''}} value="4">4</option>
                            <option {{$value == 5 ? 'selected' : ''}} value="5">5</option>
                        </select>
                    </div>
                @else
                    <div class="col-sm-6 text-right" style="margin-top: 30px;">
                        <select id="rate" data-id="{{$post->id}}">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                @endif
            @endif
        @endif
    </div>
</div>
<div class="card-body">
    <div>
        <div class="row">
            <div class="col-sm-8">
                <h4 class="card-title"><i class="nc-icon nc-circle-10"></i>
                    <b>{{$post->user->name}}</b>
                </h4>
            </div>
            @if(Auth::user())
                <div class="col-sm-4 text-right">
                    @if(Auth::user() == $post->user)

                        <a href="javascript:void(0)" id="editPForm" data-id="{{$post->id}}">edit</a>
                    @endif
                    @if(Auth::user() == $post->user || Auth::user()->isadmin())
                        <form action="{{route('post.destroy', $post->id)}}" class="d-inline-block" method="post"
                              id="deletePost">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="delete">
                            <a href="javascript:void(0)" id="submit">delete</a>
                        </form>
                    @endif
                </div>
            @endif
        </div>
        <p class="card-text" style="margin: 20px 0px ;"><i
                class="nc-icon nc-chat-33"></i> {{$post->body}}</p>
        <hr>
        <p class="card-text"><i class="nc-icon nc-calendar-60"></i>
            : {{$post->created_at->diffForHumans()}}</p>
        <hr>
    </div>
</div>
@include('frontend.comments.index')


