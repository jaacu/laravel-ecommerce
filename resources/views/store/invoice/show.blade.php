@extends('master')

@section('content')
    <div class="col-md-12">
        <div class="card card-body printableArea">
            <h3><b>INVOICE</b> <span class="pull-right">#{{$invoice->id}}</span></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <address>
                        <h3> &nbsp;<b class="text-danger">{{ config('app.name')  }}</b></h3>
                        <h5> &nbsp; Billing </h5>
                            <p class="text-muted m-l-5">
                                @foreach ( App\Checkout::getAddressArray($invoice->billing_address) as $string)
                                {{ $string }} <br>
                                @endforeach
                                </p>
                        <h6 class="">{{ $invoice->lastName . ' ' . $invoice->firstName }} </h6>
                        <h6 class="">{{ $invoice->email }} </h6>
                        <h6 class="">{{  $invoice->phone }} </h6>
                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address>
                            <h5> Shipping</h5>
                            <p class="text-muted m-l-30">
                                @foreach ( App\Checkout::getAddressArray($invoice->shipping_address) as $string)
                                {{ $string }} <br>
                                @endforeach
                            </p>
                        <p class="m-t-30"><b>Pay Method :</b> <i class="fa fa-credit-card"></i> {{ $invoice->pay_method }}</p>
                            <p><b>Due Date :</b> <i class="fa fa-calendar"></i> {{ $invoice->created_at }}</p>
                        </address>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive m-t-40" style="clear: both;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Name</th>
                                    <th>Description</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Unit Cost</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( collect( json_decode( $invoice->products ) ) as $product)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td class="description">{{$product->description}}</td>
                                    <td class="text-right">{{ $product->order->amount }} </td>
                                    <td class="text-right"> ${{ $product->price}} </td>
                                    <td class="text-right"> ${{ $product->price * $product->order->amount }} </td>
                                </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pull-right m-t-30 text-right">
                        <p>Sub - Total amount: ${{ $invoice->total }}</p>
                        <p>Extras : 0 </p>
                        <hr>
                        <h3><b>Total :</b> ${{ $invoice->total }}</h3>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="text-right">
                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>

</style>    
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.PrintArea.js') }}"></script>    
@endsection

@section('jQuery')
$("#print").click(function() {
    var mode = 'iframe'; //popup
    var close = mode == "popup";
    var options = {
        mode: mode,
        popClose: close
    };
    $("div.printableArea").printArea(options);
});
@endsection