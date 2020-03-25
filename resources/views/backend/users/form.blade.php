<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="Form" name="Form" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <div>UserName</div>
                        <div class="col-sm-12">
                            <input type="text" class=" @error('name') is-invalid @enderror" id="name"
                                   name="name" placeholder="Enter Name"
                                   value="">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div>Email</div>
                        <div class="col-sm-12">
                            <input type="text" class=" @error('email') is-invalid @enderror" id="email"
                                   name="email" placeholder="Enter Email"
                                   value="">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div>password</div>
                        <div class="col-sm-12">
                            <input type="password" class=" @error('password') is-invalid @enderror" id="password"
                                   name="password"
                                   value="">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <div>Role</div>
                            <select id="role" name="role_id" class="@error('role_id') is-invalid @enderror">
                                <option value="" disabled {{isset($row) ? '' : 'selected'}}>Choose Role</option>
                                @foreach($roles as $role)
                                    <option
                                        value="{{$role->id}}" {{isset($row->role_id) && $row->role->id == $role->id ? 'selected' : ''}}>{{ucwords($role->name)}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
