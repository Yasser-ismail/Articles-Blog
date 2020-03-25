@extends('backend.layouts.app')
@section('title')
    {{$title}}
@endsection
@section('nav_title')
    {{$nav_title}}
@endsection
@section('content')
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{$post->title}}</h4>
            </div>
            <div class="card-body">
                <p>{{$post->body}}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card" id="comments">
            <div class="card-header card-header-primary">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title">Post Comments</h4>
                        <p class="card-category">Here you can Add \ Edit \ Delete Post Comments</p>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="javascript:void(0)" class="btn btn-white btn-round" id="createNew">Add
                            New Comment</a>
                        <div class="ripple-container"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('backend.comments.index')
            </div>
        </div>
    </div>
    @include('backend.'.$route_name.'.form')




@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function () {
                let table = $('.dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('posts.show', $post->id) }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'user.name', name: 'user.name'},
                        {data: 'comment', name: 'comment'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ]
                });

            });
            $('#createNew').click(function () {
                var model = 'comment';
                var Lmodel = 'Comment';
                $('#saveBtn').val("create-" + model);
                $('#comment').val('');
                $('#modelHeading').html("Create New " + Lmodel);
                $('#ajaxModel').modal('show');
            });


            $('body').on('click', '.edit', function () {
                var id = $(this).data('id');
                var model = 'comment';
                var Lmodel = 'Comment';
                $.get("{{ route($route_name.'.index') }}" + '/' + id + '/edit', function (data) {
                    $('#modelHeading').html("Edit " + Lmodel);
                    $('#saveBtn').val("edit-" + model);
                    $('#ajaxModel').modal('show');
                    $('#post_id').val(data.post_id);
                    $('#comment').val(data.comment);
                    $('#id').val(data.id);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                var model = 'comment';
                var Lmodel = 'Comment';
                if ($('#saveBtn').val() == "create-"+model) {

                    var post_id = $("input[name=post_id]").val();
                    var commment = $("input[name=comment]").val();

                    $.ajax({

                        data: {post_id: post_id, comment: commment,  _token: '{{csrf_token()}}'},
                        url: "{{ route('comments.store') }}",
                        type: "POST",
                        success: function (data) {

                            $('#Form').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            $('.dataTable').DataTable().ajax.reload();
                            $('#saveBtn').html('Save Changes');

                        },
                        error: function (data) {
                            alert('Invalid data');
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                }

                if ($('#saveBtn').val() == "edit-"+model) {

                    var post_id = $("input[name=post_id]").val();
                    var comment = $("input[name=comment]").val();
                    var id = $("input[name=id]").val();

                    $.ajax({
                        data: {post_id: post_id, comment: comment,  _token: '{{csrf_token()}}'},
                        url: "{{ route($route_name.'.store') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        success: function (data) {

                            $('#Form').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            $('.dataTable').DataTable().ajax.reload();
                            $('#saveBtn').html('Save Changes');

                        },
                        error: function (data) {
                            alert('Invalid data');
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                }

            });

            $('body').on('click', '.delete', function () {

                var id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route($route_name.'.store') }}" + '/' + id,
                    success: function (data) {
                        $('.dataTable').DataTable().ajax.reload(null, false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
@endsection
