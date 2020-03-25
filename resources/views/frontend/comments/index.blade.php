<div class="card-header card-header-warning" id="comments">
    <h4>Comments ({{count($post->comments)}})</h4>
</div>
<div class="card-body">
    @if(count($post->comments) == 0)
        <div class="row">
            <div class="col-sm-8">
                No Comments.....
            </div>
        </div>
    @endif
    @if($post->comments)
        @foreach($post->comments as $comment)
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="card-title"><i class="nc-icon nc-circle-10"></i>
                        <b>{{$comment->user->name}}</b>
                    </h4>
                </div>
                <div class="col-sm-4 text-right">
                    @if(Auth::user())
                        @if(Auth::user() == $comment->user)
                            <a href="javascript:void(0)" data-id="{{$comment->id}}" id="edit_Comment_Form">edit</a>
                        @endif
                        @if(Auth::user() == $comment->user || Auth::user()->isadmin())
                            <a href="javascript:void(0)" data-id="{{$comment->id}}" id="deleteComment">delete</a>
                        @endif
                    @endif
                </div>
            </div>
            <p class="card-text" style="margin: 20px 0px ;"><i
                    class="nc-icon nc-chat-33"></i> {{$comment->comment}}</p>
            <p class="card-text"><i class="nc-icon nc-calendar-60"></i>
                : {{$comment->created_at->diffForHumans()}}</p>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
    @endif
    @if(Auth::user())
        <form>
            <div class="form-group">
                <input type="hidden" name="post_id_add" value="{{$post->id}}">
                <textarea class="form-control @error('comment_add') is-invalid @enderror" name="comment_add"
                          cols="100"
                          rows="1"></textarea>
                @error('comment_add')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="text-right">
                <input type="submit" id="addComment" class="btn btn-primary btn-sm btn-round"
                       value="add comment">
            </div>
        </form>
    @endif
</div>
