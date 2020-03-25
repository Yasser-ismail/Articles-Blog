<div class="modal fade" id="ajaxModelComment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-left">
                <h4 class="modal-title" id="modelHeading">Edit Comment</h4>
            </div>
            <div class="modal-body">
                <form id="FormComment" name="Form" class="form-horizontal">
                    <div class="form-group">
                        <input type="hidden" name="post_id" id="post_id">
                        <input type="hidden" name="id" id="id">
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" cols="100"
                                  rows="1"></textarea>

                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <input type="submit"
                               class="btn btn-primary btn-sm btn-round" id="editComment"
                               value="edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
