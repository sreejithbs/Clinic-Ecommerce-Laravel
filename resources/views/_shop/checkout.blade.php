@extends('_shop.partials.master')
@section('page_title', 'Cart | Inner Beauty')

@section('content')

<form method="post" action="{{ route('checkout_store') }}" id="checkout-form" class="form" novalidate="" data-parsley-validate="">
    {{ csrf_field() }}

    <section class="section-pagetop bg-dark">
        <div class="clearfix"> <h2 class="title-page">Order Checkout</h2> </div>
    </section>
    <br/>
    <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
        {{ Session::get('error') }}
    </div>
    <section class="section-content bg padding-y">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Billing Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="card">
                            <article class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required data-parsley-required-message="Please enter First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required data-parsley-required-message="Please enter Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email ID</label>
                                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" disabled>
                                            <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number *</label>
                                            <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required data-parsley-required-message="Please enter Phone Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Address *</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" required data-parsley-required-message="Please enter Address">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City *</label>
                                            <input type="text" class="form-control" name="city" placeholder="City" required data-parsley-required-message="Please enter City">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State/Locality *</label>
                                            <input type="text" class="form-control" name="state" placeholder="State/Locality" required data-parsley-required-message="Please enter State/Locality">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Zip Code *</label>
                                            <input type="text" class="form-control" name="zip_code" placeholder="Zip Code" required data-parsley-required-message="Please enter Zip Code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country *</label>
                                            <input type="text" class="form-control" name="country" placeholder="Country" required data-parsley-required-message="Please enter Country">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Order Notes (optional)</label>
                                    <textarea class="form-control" name="notes" rows="3"></textarea>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Order Summary</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-borderless table-responsive">
                                    @foreach(Cart::getContent() as $product)
                                        <tr class="no-border">
                                            <td>
                                                <img src="{{ asset($product->model->product_images()->first()->originalImagePath) }}" height="50px" width="50px">
                                            </td>
                                            <td> {{ $product->name }} x {{ $product->quantity }}</td>
                                            <td> ${{ Cart::get($product->id)->getPriceSum() }} </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="row">
                                    <div class="col-md-6"> <h4><strong> Total Amount </strong></h4></div>
                                    <div class="col-md-6 text-right"> <h4><strong> $ {{ Cart::getTotal() }} </strong></h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Payment Details</h3>
                            </div>
                            <div class="panel-body">
                                <p>
                                    <small class="form-text text-muted">
                                        Use the card number <strong>4242424242424242</strong> with any CVC and a future expiration date for testing purpose.
                                    </small>
                                </p>
                                <div class="form-group">
                                    <label for="">Card Holder Name *</label>
                                    <input type="text" id="card_holder_name" name="card_holder_name" maxlength="70" class="form-control" placeholder="Card Holder Name" required data-parsley-required-message="Please enter Card Holder Name">
                                </div>
                                <div class="form-group">
                                    <label for="">Card Number *</label>
                                    <input type="tel" id="card_number" maxlength="18" class="form-control" placeholder="Card Number" required data-parsley-required-message="Please enter Card Number" data-parsley-type="digits">
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label" for="">Expiry Month *</label>
                                            {!! Form::selectMonth('card_expiry_month', null, ['id' => 'card_expiry_month', 'class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Expiry Year *</label>
                                            {!! Form::selectYear('card_expiry_year', date('Y'), date('Y') + 15, 'S', ['id' => 'card_expiry_year', 'class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">CVC *</label>
                                            <input type="tel" id="card_cvc" maxlength="4" class="form-control" placeholder="CVC" required data-parsley-required-message="Please enter CVC" data-parsley-type="digits">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="subscribe btn btn-success btn-lg btn-block">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<div style="display: inline-block;"></div>

@endsection

@push('page_scripts')
    <script src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">

        Stripe.setPublishableKey('{{ env("STRIPE_TEST_KEY") }}');

        var $form = $('#checkout-form');

        $form.submit(function (event) {
            event.preventDefault();
            if ($form.parsley().isValid()){
                $('#charge-error').addClass('hidden');
                $form.find('button').prop('disabled', true);

                Stripe.card.createToken({
                    number: $('#card_number').val(),
                    cvc: $('#card_cvc').val(),
                    exp_month: $('#card_expiry_month').val(),
                    exp_year: $('#card_expiry_year').val(),
                }, stripeResponseHandler);

                return false; //stop form submit event - or else it sends a Laravel Post request
            }
        });

        function stripeResponseHandler(status, response) {
            if(response.error) {
                $('#charge-error').removeClass('hidden');
                $('#charge-error').text(response.error.message);
                $form.find('button').prop('disabled', false);
                $('html, body').animate({
                    scrollTop: 0
                }, 1000);
            }
            else {
                var token = response.id;

                // Insert the token into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                $form.append($('<input type="hidden" name="card_last_4" />').val(response.card.last4));

                // Submit the form:
                $form.get(0).submit();
            }
        }
    </script>
@endpush