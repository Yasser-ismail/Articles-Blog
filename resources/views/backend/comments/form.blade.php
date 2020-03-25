<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="Form" name="Form" class="form-horizontal">
                    <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <div>Comment</div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment"
                                   name="comment" placeholder="Enter Comment"
                                   value="">
                            @error('comment')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="">Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
