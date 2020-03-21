<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Log details</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <span class="badge">
                            <a href="{{ route('admin_inventory_logs_list', $product->unqId ) }}" class="btn btn-sm btn-secondary">
                                <i class="ft-arrow-left"></i> Back to Listing Page
                            </a>
                        </span>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0 txt-left">
                            <tbody>
                                <tr>
                                    <th>Inventory Log Event</th>
                                    <td> {{ $inventory_log->logEvent }} </td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td> {{ $product->title }} </td>
                                </tr>
                                <tr>
                                    <th> Sale Order ID</th>
                                    <td> {{ $user_order->orderRefNum }} </td>
                                </tr>
                                <tr>
                                    <th>Order Date & Time</th>
                                    <td> {{ $inventory_log->dateTime }} </td>
                                </tr>
                                <tr>
                                    <th>Order Created By</th>
                                    <td> {{ $user_order->created_clinic->clinic_profile->clinicName }} </td>
                                </tr>
                                <tr>
                                    <th>Customer Type</th>
                                    <td>
                                        @if( $user_order->isWalkinCustomer == 0 )
                                            <span class="badge badge-success"> registered </span>
                                        @else
                                            <span class="badge badge-warning"> walk-in </span>
                                        @endif
                                    </td>
                                </tr>

                                @if( $user_order->isWalkinCustomer == 0 )
                                    <tr>
                                        <th>Customer Details</th>
                                        <td> {{ $user_order->customer->name }} ({{ $user_order->customer->email }}) </td>
                                    </tr>
                                @endif

                                <tr>
                                    <th>Opening Inventory</th>
                                    <td> {{ $inventory_log->openingQty }} </td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td> <span class="badge badge-danger"> {{ $inventory_log->quantity }} </span> </td>
                                </tr>
                                <tr>
                                    <th>Closing Inventory</th>
                                    <td> {{ $inventory_log->closingQty }} </td>
                                </tr>
                                <tr>
                                    <th>Order Total</th>
                                    <td> ${{ $user_order->netTotal }} </td>
                                </tr>
                                <tr>
                                    <th>Order Notes</th>
                                    <td> {{ $user_order->notes }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Product Image</h4>
                        <hr/>
                        <div class="text-center">
                            <img class="card-img-top mb-1 img-fluid" src="{{ asset($product->product_images()->first()->originalImagePath) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>