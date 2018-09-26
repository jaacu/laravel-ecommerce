@extends('master')

@section('content')
<div class="row" id="validation">
    <div class="col-12">
        <div class="card wizard-content">
            <div class="card-body">
                <h4 class="card-title">Checkout</h4>
                <h6 class="card-subtitle">Please fill out all the info we need to complete the checkout</h6>
                <form action="{{ route('checkout.store') }}" method="POST" class="validation-wizard wizard-circle">
                    @csrf
                    {{--  Step 1 Personal info --}}
                    <h6>Personal Info </h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName"> First Name : <span class="danger">*</span> </label>
                                <input type="text" class="form-control required" id="firstName" name="firstName" 
                                value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->firstName : old('firstName') }}" > </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName"> Last Name : <span class="danger">*</span> </label>
                                    <input type="text" class="form-control required" id="lastName" name="lastName" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->lastName : old('lastName') }}" > </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> Email Address : <span class="danger">*</span> </label>
                                    <input type="email" class="form-control required" id="email" name="email" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->email : old('email') ?: auth()->user()->email }}" > </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number : <span class="danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control required" id="phone" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->phone : old('phone') }}"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birth">Date of Birth : <span class="danger">*</span> </label>
                                    <input type="date" class="form-control required" id="birth" name="birth" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->birth : old('birth') }}"> </div>
                            </div>
                        </div>
                    </section>
                    {{--  Step 2 billing info  --}}
                    <h6>Billing Info</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billingCountry"> Country : <span class="danger">*</span></label>
                                    <input type="text" class="form-control required" id="billingCountry" name="billingCountry" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->billingCountry() : old('billingCountry') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billingState"> State: <span class="danger">*</span> </label>
                                    <input type="text" class="form-control required" id="billingState" name="billingState" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->billingState() : old('billingState') }}"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billingStreet"> Street: <span class="danger">*</span> </label>
                                    <input type="text" class="form-control required" id="billingStreet" name="billingStreet" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->billingStreet() : old('billingStreet') }}"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="extraBilling"> Extra billing info: </label>
                                    <input type="text" class="form-control" id="extraBilling" name="extraBilling" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->extraBilling() : old('extraBilling') }}"> </div>
                            </div>
                        </div>
                    </section>
                    {{--  Step 3 Shipping info --}}
                    <h6>Shipping Info</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="inline custom-control custom-checkbox block" for="repeatBilling">
                                    <input type="checkbox" checked class="custom-control-input" name="repeatBilling" id="repeatBilling"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">Use the same address billing.</span> </label>
                                </div>
                            </div>
                        </div>
                        <div class="row hide" id="billingAdressWrapper">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shippingCountry"> Country :</label>
                                    <input type="text" class="form-control" id="shippingCountry" name="shippingCountry" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->shippingCountry() : old('shippingCountry') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shippingState"> State: </label>
                                    <input type="text" class="form-control" id="shippingState" name="shippingState" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->shippingState() : old('shippingState') }}"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shippingStreet"> Street: </label>
                                    <input type="text" class="form-control" id="shippingStreet" name="shippingStreet" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->shippingStreet() : old('shippingStreet') }}"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="extraShipping"> Extra Shipping info: </label>
                                    <input type="text" class="form-control" id="extraShipping" name="extraShipping" 
                                    value="{{ auth()->user()->hasCheckout() ? auth()->user()->checkout->extraShipping() : old('extraShipping') }}"> </div>
                            </div>
                        </div>
                    </section>
                    {{-- Step 4 Payment --}}
                    <h6>Payment</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paymentMethod">Pay method</label>
                                    <select class="custom-select form-control required" id="paymentMethod" name="paymentMethod">
                                        <option value="paypal">Paypal</option>
                                        <option value="stripe">Stripe</option>
                                        <option value="credit-card">Credit Card</option>
                                        <option value="free">Free</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/steps.css') }}">
@endsection

@section('scripts')
<script src="{{ url('assets/plugins/wizard/jquery.steps.min.js') }}"></script>
<script src="{{ url('assets/plugins/wizard/jquery.validate.min.js') }}"></script>
@endsection

@section('jQuery')


var form = $(".validation-wizard").show();

$(".validation-wizard").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "fade"
    , titleTemplate: '<span class="step">#index#</span> #title#'
    , labels: {
        finish: "Submit"
    }
    , onStepChanging: function (event, currentIndex, newIndex) {
        return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
    }
    , onFinishing: function (event, currentIndex) {
        return form.validate().settings.ignore = ":disabled", form.valid()
    }
    , onFinished: function (event, currentIndex) {
         form.submit()
    }
}), $(".validation-wizard").validate({
    ignore: "input[type=hidden]"
    , errorClass: "text-danger"
    , successClass: "text-success"
    , highlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , errorPlacement: function (error, element) {
        error.insertAfter(element)
    }
    , rules: {
        email: {
            email: !0
        }
    }
})

$('#repeatBilling').change(function(){
    if(this.checked){
        $('#billingAdressWrapper').slideUp();
        $('#shippingCountry').removeClass('required')
        $('#shippingState').removeClass('required')
        $('#shippingStreet').removeClass('required')
    } else {
        $('#billingAdressWrapper').slideDown();
        $('#shippingCountry').addClass('required')
        $('#shippingState').addClass('required')
        $('#shippingStreet').addClass('required')
    }
})
@endsection