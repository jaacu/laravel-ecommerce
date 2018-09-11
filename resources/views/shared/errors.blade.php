<div id="errorNotification" class="col-12 notification hide">
    <div class="col-lg-7 col-md-12 mx-auto col-7">
        <div class="alert alert-danger">        
        @foreach ( $errors->all() as $error )
            @if( $loop->first )
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <h5 class="text-danger"><i class="fa fa-exclamation-triangle"></i> We have encounter some errors!</h5>
            @endif
                    {{ $error }} <br>
        @endforeach
        </div>
    </div>
</div>