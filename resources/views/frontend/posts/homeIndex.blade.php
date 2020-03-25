<div class="row">
    @foreach($posts as $post)
        <div class="col-sm-4">
            <div class="card" style="height: 250px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8"style="height: 80px;">
                            <a href="{{route('post.show', $post->id)}}"><h5>
                                    <strong>{{str_limit($post->title, 20)}}</strong>
                                </h5></a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="height:80px; ">
                            <a href="{{route('post.show', $post->id)}}"><p
                                    class="card-text">{{str_limit($post->body, 30)}}</p></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <small> <i class="nc-icon nc-circle-10"></i> : {{$post->user->name}}</small>
                        </div>
                        <div class="col-sm-5 text-right">
                            <small>{{$post->created_at->diffForHumans()}}</small>
                        </div>
                    </div>
                    <div class="row content-center" style="margin-top: 20px; margin-bottom: 20px;">
                        <div class="col-sm-4 offset-3">
                            <select class="rate">
                                <option
                                    {{isset($post->average_rating) && $post->average_rating == null ? 'selected' : ''}} value=""></option>
                                <option
                                    {{isset($post->average_rating) && $post->average_rating == 1 ? 'selected' : ''}} value="1">
                                    1
                                </option>
                                <option
                                    {{isset($post->average_rating) && $post->average_rating == 2 ? 'selected' : ''}} value="2">
                                    2
                                </option>
                                <option
                                    {{isset($post->average_rating) && $post->average_rating == 3 ? 'selected' : ''}} value="3">
                                    3
                                </option>
                                <option
                                    {{isset($post->average_rating) && $post->average_rating == 4 ? 'selected' : ''}} value="4">
                                    4
                                </option>
                                <option
                                    {{isset($post->average_rating) && $post->average_rating == 5 ? 'selected' : ''}} value="5">
                                    5
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <span><strong>{{$post->average_rating}}</strong></span>

                            <span><strong>{{isset($post->count_rating) && $post->count_rating != null ? '('.$post->count_rating.')' : ''}}</strong></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endforeach
</div>
<div class="row" style="margin-top: 30px">
    <div class="col-sm-5 offset-sm-5">
        {{$posts->render()}}
    </div>
</div>
