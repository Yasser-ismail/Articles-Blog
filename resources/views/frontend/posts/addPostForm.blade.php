<div class="modal fade" id="ajaxModelPost" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-left">
                <h4 class="modal-title" id="modelHeading">Add Post</h4>
            </div>
            <div class="modal-body">
                <form id="postForm" name="Form" class="form-horizontal">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text"  id="title" name="title" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <label>Body:</label>
                        <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" cols="100"
                                  rows="3"></textarea>
                        @error('body')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <input type="submit" id="addPost"
                               class="btn btn-primary btn-sm btn-round"
                               value="add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
