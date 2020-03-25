@extends('frontend.layouts.app')
@section('content')
    <div style="margin-top: 120px;">

        <div class="container-fluid content-center">
            <div class="row ">
                <div class="col-sm-8 offset-2">
                    <div id="tag_container">
                        @include('frontend.posts.post-card')
                    </div>
                    @include('frontend.comments.form')
                    @include('frontend.posts.form')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

            $(function () {
                $('#rate').barrating({
                    theme: 'fontawesome-stars-o',
                    onSelect: function (value, text, event) {
                        event.preventDefault();
                        var post_id = $('#rate').data('id');
                        $.ajax({
                            data: {value: value, post_id: post_id, _token: '{{csrf_token()}}'},
                            url: "{{ route('store.rate') }}",
                            type: "POST",
                            success: function (data) {
                                $('#tag_container').empty().html(data);
                                $('#user_rate').barrating({
                                    theme: 'fontawesome-stars-o',
                                });
                            },
                            error: function (data) {
                                alert('Invalid data');
                            }
                        });
                    }
                });

                $('#user_rate').barrating({
                    theme: 'fontawesome-stars-o',
                    onSelect: function (value, text, event) {
                        event.preventDefault();
                        var post_id = $('#user_rate').data('id');
                        $.ajax({
                            data: {value: value, post_id: post_id, _token: '{{csrf_token()}}'},
                            url: "{{ route('store.rate') }}" + '/' + post_id + '/' + 'edit',
                            type: "POST",
                            success: function (data) {
                                $('#tag_container').empty().html(data);
                                $('#user_rate').barrating({
                                    theme: 'fontawesome-stars-o',
                                });
                            },
                            error: function (data) {
                                alert('Invalid data');
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#editPForm', function (event) {
                event.preventDefault();

                var id = $(this).data('id');

                $.get("{{ route('post.store') }}" + '/' + id + '/edit', function (data) {
                    $('#ajaxModelPost').modal('show');
                    $('#title').val(data.title);
                    $('#body').val(data.body);
                    $('#id').val(data.id);
                })

            });

            $(document).on('click', '#editPost', function (e) {
                e.preventDefault();

                var title = $("input[name=title]").val();
                var body = $("textarea[name=body]").val();
                var id = $("input[name=id]").val();
                $.ajax({
                    data: {title: title, body: body, _token: '{{csrf_token()}}'},
                    url: "{{ route('post.store') }}" + '/' + id,
                    type: "PATCH",
                    success: function (data) {
                        $('#postForm').trigger("reset");
                        $('#ajaxModelPost').modal('hide');
                        $('#tag_container').empty().html(data);
                        $('#rate').barrating({
                            theme: 'fontawesome-stars-o'
                        });
                        $('#user_rate').barrating({
                            theme: 'fontawesome-stars-o',
                        });
                    },
                    error: function (data) {
                        alert('Invalid data');
                    }
                });
            });

            $(document).on('click', '#submit', function (event) {
                $('#deletePost').submit();
            });


            $(document).on('click', '#addComment', function (event) {
                event.preventDefault();

                var post_id = $("input[name=post_id_add]").val();
                var comment = $("textarea[name=comment_add]").val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('comment.store')}}",
                    data: {post_id: post_id, comment: comment, _token: '{{csrf_token()}}'},

                    success: function (data) {
                        $("#tag_container").empty().html(data);
                        $('#rate').barrating({
                            theme: 'fontawesome-stars-o'
                        });
                        $('#user_rate').barrating({
                            theme: 'fontawesome-stars-o',
                        });
                    },
                    error: function (data) {
                        alert('Invalid data');
                    }
                });
            });

            $(document).on('click', '#edit_Comment_Form', function (e) {
                e.preventDefault();

                var id = $(this).data('id');

                $.get("{{ route('comment.store') }}" + '/' + id + '/edit', function (data) {
                    $('#comment').val(data.comment);
                    $('#id').val(data.id);
                    $('#post_id').val(data.post_id);
                    $('#ajaxModelComment').modal('show');
                })

            });

            $(document).on('click', '#editComment', function (event) {
                event.preventDefault();
                var id = $("input[name=id]").val();
                var post_id = $("input[name=post_id]").val();
                var comment = $("textarea[name=comment]").val();
                $.ajax({
                    type: 'PATCH',
                    url: "{{route('comment.store')}}" + '/' + id,
                    data: {post_id: post_id, comment: comment, _token: '{{csrf_token()}}'},

                    success: function (data) {
                        $('#FormComment').trigger("reset");
                        $('#ajaxModelComment').modal('hide');
                        $("#tag_container").empty().html(data);
                        $('#rate').barrating({
                            theme: 'fontawesome-stars-o'
                        });
                        $('#user_rate').barrating({
                            theme: 'fontawesome-stars-o',
                        });
                    },
                    error: function (data) {
                        alert('Invalid data');
                    }
                });
            });

            $(document).on('click', '#deleteComment', function (event) {
                event.preventDefault();

                var id = $(this).data("id");

                $.ajax({
                    type: 'DELETE',
                    url: "{{route('comment.store')}}" + '/' + id,

                    success: function (data) {
                        $("#tag_container").empty().html(data);
                        $('#rate').barrating({
                            theme: 'fontawesome-stars-o'
                        });
                        $('#user_rate').barrating({
                            theme: 'fontawesome-stars-o',
                        });
                    },
                    error: function (data) {
                        console.log('erroe', data);
                    }
                });
            });

        });
    </script>

@endsection
