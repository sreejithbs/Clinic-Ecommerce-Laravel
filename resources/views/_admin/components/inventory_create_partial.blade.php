<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">
                    <h4 class="card-title" id="bordered-layout-basic-form">Info</h4>
                </div> -->
                <div class="card-content collpase show">
                    <div class="card-body">
                        <!-- <div class="card-text">
                            <p>Info</p>
                        </div> -->
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th><code>Inventory Event</code></th>
                                    <th> {{ $inventory_log->logEvent }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><code>Product Created Date</code></th>
                                    <th> {{ $product->dateTime }} </th>
                                </tr>
                                <tr>
                                    <th><code>Product Created By</code></th>
                                    <th> {{ $product->created_admin->name }} </th>
                                </tr>
                                <tr>
                                    <th><code>Opening Inventory</code></th>
                                    <th> {{ $inventory_log->openingQty }} </th>
                                </tr>
                                <tr>
                                    <th><code>Quantity</code></th>
                                    <th> <span class="badge badge-success"> {{ $inventory_log->quantity }} </span> </th>
                                </tr>
                                <tr>
                                    <th><code>Closing Inventory</code></th>
                                    <th> {{ $inventory_log->closingQty }} </th>
                                </tr>
                                <tr>
                                    <th><code>Remarks</code></th>
                                    <th> {{ $product->remarks }} </th>
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
                        <h4 class="card-title">Product Details</h4>
                        <hr/>
                        <div class="text-center">
                            <img class="card-img-top mb-1 img-fluid" src="{{ asset($product->product_images()->first()->originalImagePath) }}" alt="Image">
                        </div>
                        <h4 class="card-title"> {{ $product->title }} </h4>
                        <p class="card-text"> {{ $product->description }} </p>
                        <p class="card-text"> ${{ $product->sellingPrice }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>