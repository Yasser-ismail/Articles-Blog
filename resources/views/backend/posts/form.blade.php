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
                        <div>Title</div>
                        <div class="col-sm-12">
                            <input type="text" class=" @error('title') is-invalid @enderror" id="title"
                                   name="title" placeholder="Enter Title"
                                   value="">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $error->title }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div>Body</div>
                        <div class="col-sm-12">
                          <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30"
                                    rows="6"></textarea>
                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
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
