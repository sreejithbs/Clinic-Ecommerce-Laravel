<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Log details</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <span class="badge">
                            <a href="{{ route('admin_inventory_logs_list', $inventory_transfer->product->unqId ) }}" class="btn btn-sm btn-secondary">
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
                                    <td> {{ $inventory_transfer->product->title }} </td>
                                </tr>
                                <tr>
                                    <th>Transfer Reference Number</th>
                                    <td> {{ $inventory_transfer->transferRefNum }} </td>
                                </tr>
                                <tr>
                                    <th>Transfer Order ID</th>
                                    <td> {{ $inventory_transfer->transferNumber }} </td>
                                </tr>
                                <tr>
                                    <th>Transfer Date & Time</th>
                                    <td> {{ $inventory_log->dateTime }} </td>
                                </tr>
                                <tr>
                                    <th>Transfer Created By</th>
                                    <td> {{ $inventory_transfer->created_admin->name }} </td>
                                </tr>
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
                                    <th>Clinic, where Inventory Transferred</th>
                                    <td> {{ $inventory_transfer->clinic->clinic_profile->clinicName }} </td>
                                </tr>
                                <tr>
                                    <th>Transfer Total</th>
                                    <td> ${{ $inventory_transfer->totalPrice }} </td>
                                </tr>
                                <tr>
                                    <th>Transfer Notes</th>
                                    <td> {{ $inventory_transfer->notes }} </td>
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
                            <img class="card-img-top mb-1 img-fluid" src="{{ asset($inventory_transfer->product->product_images()->first()->originalImagePath) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>