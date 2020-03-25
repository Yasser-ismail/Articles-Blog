@extends('backend.layouts.app')
@section('title')
    {{$title}}
@endsection
@section('nav_title')
    {{$nav_title}}
@endsection
@section('content')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title">{{$table_title}}</h4>
                        <p class="card-category">{{$table_des}}</p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="javascript:void(0)" class="btn btn-white btn-round" id="createNew">Create
                            New {{$model_name}}</a>
                        <div class="ripple-container"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover text-left dataTable">
                    <thead class="text-warning">
                    <tr>
                        <th>ID</th>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Created_at</th>
{{--                        <th>Updated_at</th>--}}
                        <th>Post</th>
                        <th width="280px">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                    ajax: "{{ route($route_name.'.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'user.name', name: 'user.name'},
                        {data: 'title', name: 'title'},
                        {data: 'body', name: 'body'},
                        {data: 'created_at', name: 'created_at'},
                        // {data: 'updated_at', name: 'updated_at'},
                        // {data: 'viewPost', name:'viewPost', orderable: false, searchable: false},
                        {
                            data: 'id', name: 'id', orderable: false, searchable: false, render: function (data) {
                                let url = "posts/" + data;
                                return '<a href="' + url + '" data-toggle="tooltip"  data-id="' + data + '" data-original-title="viewPost" class="btn btn-primary btn-sm viewPost">' +
                                    'View Posts</a>';

                            }
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ]
                });

            });


            $('#createNew').click(function () {
                var model = 'post';
                var Lmodel = 'Post';
                $('#saveBtn').val("create-" + model);
                $('#id').val('');
                $('#title').val('');
                $('#body').val('');
                $('#modelHeading').html("Create New " + Lmodel);
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var id = $(this).data('id');
                var model = 'post';
                var Lmodel = 'Post';
                $.get("{{ route($route_name.'.index') }}" + '/' + id + '/edit', function (data) {
                    $('#modelHeading').html("Edit " + Lmodel);
                    $('#saveBtn').val("edit-" + model);
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#body').val(data.body);
                })
            });
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                var model = 'post';
                var Lmodel = 'Post';
                if ($('#saveBtn').val() == "create-" + model) {

                    var title = $("input[name=title]").val();
                    var body = $("textarea[name=body]").val();

                    $.ajax({

                        data: {title: title, body: body, _token: '{{csrf_token()}}'},
                        url: "{{ route($route_name.'.store') }}",
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

                if ($('#saveBtn').val() == "edit-" + model) {

                    var title = $("input[name=title]").val();
                    var body = $("textarea[name=body]").val();
                    var id = $("input[name=id]").val();
                    $.ajax({
                        data: {title: title, body: body, _token: '{{csrf_token()}}'},
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

            $('body').on('click', '.deleteProduct', function () {

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
