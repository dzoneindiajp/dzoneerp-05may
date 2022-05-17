@extends('layouts.master')
@section('content')
    <div class="content pb-4" id="contentBox" media="print">
        <div class="container">
            <div class="row">
                <div class="card card-body">
                    <div class="col-md-12">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <small>Production Management System </small>
                                        <small
                                            class="float-right">{{ date('d-M-Y', strtotime($purchase->purchase_date)) }}</small>
                                    </h4>
                                </div>
                            </div> <br>
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    <h4>User Info:</h4>
                                    <address><strong>{{ $user->name }}</strong><br>
                                        {{ $user->email }}<br>
                                        @if ($user->user->phone)
                                            {{ $user->user->phone ?? '' }}<br>
                                        @endif
                                        {{ $user->user->address }}
                                    </address>
                                </div>
                                <div class="col-sm-6 invoice-col text-right"><b>PURCHASE CODE: </b>
                                    {{ $purchase->purchase_code }}
                                    <br> <b>Date: </b>
                                    {{ date('d-M-Y', strtotime($purchase->purchase_date)) }}<br> <b>Total:
                                    </b>${{ $purchase->grand_total }}<br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Purchased Qty</th>
                                                <th>Unit Price</th>
                                                <th>Discount</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $j = 0;
                                                $product_id = json_decode($purchase->product_id);
                                                $product_qty = json_decode($purchase->product_qty);
                                                $unit_id = json_decode($purchase->unit_id);
                                                $unit_price = json_decode($purchase->unit_price);
                                                $discount = json_decode($purchase->discount);
                                            @endphp
                                            @for ($i = 0; $i < count($product_id); $i++)
                                                @php
                                                    $product = \App\Models\Product::find($product_id[$i]);
                                                    $unit = \App\Models\Unit::find($unit_id[$i]);

                                                    $price = $product_qty[$i] * $unit_price[$i];
                                                    $dis = ($price * $discount[$i]) / 100;
                                                @endphp
                                                <tr>
                                                    <td>{{ ++$j }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product_qty[$i] }} {{ $unit->name }}</td>
                                                    <td>${{ $unit_price[$i] }}</td>
                                                    <td>${{ $dis }} ({{ $discount[$i] }}%)</td>
                                                    <td class="text-right">${{ $price - $dis }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <p></p> <strong>Status:</strong>
                                    @if ($purchase->status == 1)
                                        <p><span class="badge badge-success">Active</span></p>
                                    @else
                                        <p><span class="badge badge-danger">In Active</span></p>
                                    @endif

                                    <strong>Payment Note:</strong><br>
                                    {!! $purchase->purchase_note !!}
                                </div>
                                <div class="col-4">
                                    <div class="table-responsive text-right">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Subtotal:</th>
                                                    <td>${{ $purchase->grand_total }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Discount:</th>
                                                    <td>-${{ $purchase->total_discount }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Trasnport:</th>
                                                    <td>+${{ $purchase->transport_cost }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Grand Total:</th>
                                                    <td>${{ $purchase->grand_total }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Paid:</th>
                                                    <td>${{ $purchase->total_paid }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Due:</th>
                                                    <td>${{ $purchase->grand_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="no-print"><a href="{{ url()->previous() }}"
                                    class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i> Go Back
                                </a> <a href="javascript:void(0)" class="btn btn-secondary float-right print-btn"
                                    id="printMe"><i class="fas fa-print"></i>
                                    Print</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
