<div class="card gutter-b rounded">
    <div class="card-body">
        <div class="d-md-flex align-items-center justify-content-between mb-2">
            <h4 class="font-weight-bolder">Expropriation Details
            </h4>
        </div>
        <div class="separator separator-dashed  mb-3"></div>
        <div class="row">
            <div class="col-md-12">
                <p>
                    <strong>Citizen Photo:</strong> <br>
                    @if($expropriation->customer_photo)
                        <a href="{{$expropriation->getCustomerPhoto()}}" target="_blank">
                            <img src="{{$expropriation->getCustomerPhoto()}}" width="100" height="50" alt="Customer Photo" class="img-fluid">
                        </a>
                    @else
                        <span class="text-primary">N/A</span>
                    @endif
                </p>
            </div>
            <div class="col-md-4">
                <p>
                    <strong>Citizen Name:</strong> <br>
                    <span class="text-primary">{{ $expropriation->citizen->name }}</span>
                </p>
            </div>
            <div class="col-md-4">
                <p>
                    <strong>Citizen Phone:</strong> <br>
                    <a href="tel:{{ $expropriation->citizen->telephone }}">{{ $expropriation->citizen->telephone }}</a>
                </p>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
            <p>
                <strong>Property Type:</strong> <br>
                <span class="text-primary">{{ $expropriation->propertyType->name ?? 'N/A'}}</span>
            </p>
        </div>
        <div class="col-md-4">
            <p>
                <strong>Property Items:</strong> <br>
                <span class="text-primary">{{ $expropriation->details ? $expropriation->details->count() : 'N/A' }}</span>
            </p>
        </div>
        <div class="col-md-4">
            <p>
                <strong>Total Amount:</strong> <br>
                <span class="text-primary">{{ $expropriation->amount ?? 'N/A' }}</span>
            </p>
        </div>
            <div class="col-12">
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Items</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
{{--                        {{dd($expropriation->details)}}--}}
                            @forelse($expropriation->details as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($detail->item)->name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->price }}</td>
                                    <td>{{ $detail->quantity * $detail->price }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
        <div class="row">
            <div class="col-12 mt-5">
                <p>
                    <strong>Reason/Comment:</strong> <br>
                    <span class="text-primary">{{ $expropriation->description ?? 'N/A' }}</span>
                </p>
            </div>
        </div>
</div>
