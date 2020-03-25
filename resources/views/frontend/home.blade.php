@extends('frontend.layouts.app')
@section('style')
    <meta http-equiv="Pragma" content="no-cache">
@endsection
@section('content')
    <div class="container">
        @auth()
            <div class="row" style="margin-top: 150px; margin-bottom: 50px;">
                <div class="col-sm-5 offset-4">
                    <button id="addPostForm" class="btn btn-facebook-bg btn-lg">Add Post</button>
                </div>
            </div>
        @endauth
        <div class="row">
            <div class="title">
                <h1>Latest Posts</h1>
            </div>
        </div>
        <div id="tag_container">
            @include('frontend.posts.homeIndex')
        </div>
        @include('frontend.posts.addPostForm')
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $(function () {

            var perfEntries = performance.getEntriesByType("navigation");

            if (perfEntries[0].type === "back_forward") {
                location.reload(true);
            }



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#search').on('keyup', function () {
                var value = $(this).val();

                $.ajax({
                    type: 'get',
                    url: '{{route('home')}}',
                    data: {'search': value},
                    success: function (data) {
                        $("#tag_container").empty().html(data);
                        $('.rate').barrating({
                            theme: 'fontawesome-stars-o',
                            readonly: true,
                        });

                    }
                });
            });

            $(window).on('hashchange', function () {
                if (window.location.hash) {
                    var page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    } else {
                        getData(page);
                    }
                }
            });

            $(document).ready(function () {


                $(document).on('click', '.pagination a', function (event) {
                    event.preventDefault();

                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');

                    var myurl = $(this).attr('href');
                    var page = $(this).attr('href').split('page=')[1];


                    getData(page);

                });

                $('.rate').barrating({
                    theme: 'fontawesome-stars-o',
                    readonly: true,
                });


            });

            function getData(page) {

                $.ajax(
                    {
                        url: '?page=' + page,
                        type: "get",
                        datatype: "html"
                    }).done(function (data) {
                    $("#tag_container").empty().html(data);
                    $('.rate').barrating({
                        theme: 'fontawesome-stars-o',
                        readonly: true,
                    });

                    location.hash = page;
                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('No response from server');
                });
            }
        });

        $('#addPostForm').click(function () {
            $('#title').val('');
            $('#body').val('');
            $('#ajaxModelPost').modal('show');
        });

        $(document).on('click', '#addPost', function (e) {
            e.preventDefault();

            var title = $("input[name=title]").val();
            var body = $("textarea[name=body]").val();

            $.ajax({
                data: {title: title, body: body, _token: '{{csrf_token()}}'},
                url: "{{ route('post.store') }}",
                type: "POST",
                success: function (data) {
                    $('#postForm').trigger("reset");
                    $('#ajaxModelPost').modal('hide');
                    $('#tag_container').empty().html(data);
                    location.hash = 1;
                    $('.rate').barrating({
                        theme: 'fontawesome-stars-o',
                        readonly: true,
                    });

                },
                error: function (data) {
                    alert('Invalid data');
                }
            });
        });

    </script>

@endsection
