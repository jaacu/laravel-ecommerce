<div class="modal-dialog modal-dialog-centered" role="alert">
    <div class="modal-content">
        <div class="modal-header alert alert-inverse text-center">
        <h4 class="modal-title text-center alert-heading">Add <strong>{{ $product->name }}</strong> to cart</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{ route('cart.add') }}" method="post">
            @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="numeric" name="max" value="{{ $product->stock }}" class="hide">
        <div class="modal-body">
            <label for="amount" class="form-control-label"> How many of these do you want?</label>
        <input type="number" class="form-control" name="amount" id="amount" placeholder="There are {{ $product->stock }} in stock!" min="1" max="{{ $product->stock }}" required>
        </div>
        <div class="modal-footer ">
            <button type="button" class="btn btn-outline-danger text-center waves-effect waves-dark" data-dismiss="modal">Cancel <i class="fa fa-window-close-o"></i></button>
            <button type="submit" class="btn btn-success text-center waves-effect waves-dark">Add <i class="fa fa-check"></i></button>
        </div>
    </form>

    </div>
</div>