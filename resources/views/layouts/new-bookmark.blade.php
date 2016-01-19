<div class="new-bookmark-container animated fadeInUp hidden">
    <div class="new-bookmark-subcontainer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form class="bookmark-form" action="{{ route('add') }}" method="POST" role="form" autocomplete="nope">
                        {!! csrf_field() !!}
                        <legend>New Bookmark</legend>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <input class="form-control" type="text" id="name" name="name" placeholder="Name" required="true">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <input class="form-control" type="text" id="url" name="url" placeholder="URL" required="true">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <input class="form-control" id="tags" name="tags">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="private" checked> Private
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Bookmark</button><button class="btn btn-danger cancel">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>