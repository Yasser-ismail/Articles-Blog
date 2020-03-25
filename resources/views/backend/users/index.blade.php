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
                        <a href="javascript:void(0)" class="btn btn-white btn-round" id="createNew{{$model_name}}">Create
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
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
                var table = $('.dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('users.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'role.name', name: 'name'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ]
                });

            });


            $('#createNewUser').click(function () {
                var model = 'user';
                var Lmodel = 'User';
                $('#saveBtn').val("create-" + model);
                $('#id').val('');
                $('#name').val('');
                $('#email').val('');
                $('#password').val('');
                $('#role').val('');
                $('#modelHeading').html("Create New " + Lmodel);
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var id = $(this).data('id');
                var model = 'user';
                var Lmodel = 'User';
                $.get("{{ route($route_name.'.index') }}" + '/' + id + '/edit', function (data) {
                    $('#modelHeading').html("Edit " + Lmodel);
                    $('#saveBtn').val("edit-" + model);
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#role').val(data.role_id);

                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                var model = 'user';
                var Lmodel = 'User';
                if ($('#saveBtn').val() == "create-" + model) {

                    var name = $("input[name=name]").val();
                    var email = $("input[name=email]").val();
                    var password = $("input[name=password]").val();
                    var role_id = $("select[name=role_id]").val();

                    $.ajax({

                        data: {
                            name: name,
                            email: email,
                            password: password,
                            role_id: role_id,
                            _token: '{{csrf_token()}}'
                        },
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

                    var name = $("input[name=name]").val();
                    var email = $("input[name=email]").val();
                    var id = $("input[name=id]").val();
                    var password = $("input[name=password]").val();
                    var role_id = $("select[name=role_id]").val();
                    $.ajax({
                        data: {
                            name: name,
                            email: email,
                            password: password,
                            role_id: role_id,
                            _token: '{{csrf_token()}}'
                        },
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
