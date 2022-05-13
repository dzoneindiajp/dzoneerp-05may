@extends('layouts.master')
@section('content')
    <script src="{{ asset('assets/editor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/editor/sample.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/editor/sample2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/editor/toolbarconfigurator/lib/codemirror/neo.css') }}">


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
        </div>
    @endif

    {{-- <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.purchase.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="#">
                <div class="form-group">
                    <label class="" for="date">{{ trans('cruds.purchase.fields.date') }}</label>
                    <input readonly class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date"
                        name="date" id="date" value="{{ old('date', $purchase->purchase_date) }}">
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.date_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="usertype">{{ trans('cruds.purchase.fields.usertype') }}</label>
                    <select disabled
                        class="form-control select2 {{ $errors->has('usertype') ? 'is-invalid' : '' }} usertype"
                        name="usertype" id="usertype" required>
                        <option value="0" @if ($purchase->user_type == 0) selected @endif>Supplier</option>
                        <option value="1" @if ($purchase->user_type == 1) selected @endif>Vendor</option>
                    </select>
                    @if ($errors->has('usertype'))
                        <div class="invalid-feedback">
                            {{ $errors->first('usertype') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.usertype_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="" for="userid">{{ trans('cruds.purchase.fields.user') }}</label>
                    <select disabled name="userid" id="userid"
                        class="form-control {{ $errors->has('userid') ? 'is-invalid' : '' }}">
                        <option value="">Select</option>
                        @if ($purchase->user_type == 0)
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @if ($purchase->user_id == $supplier->id) selected @endif>
                                    {{ $supplier->name }}</option>
                            @endforeach
                        @else
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}" @if ($purchase->user_id == $vendor->id) selected @endif>
                                    {{ $vendor->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('userid'))
                        <div class="invalid-feedback">
                            {{ $errors->first('userid') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.user_helper') }}</span>
                </div>
                <div class="form-group w-100 m-2 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">{{ trans('cruds.purchase.fields.product') }}</th>
                                <th width="10%">{{ trans('cruds.purchase.fields.qty') }}</th>
                                <th>{{ trans('cruds.purchase.fields.unit') }}</th>
                                <th>{{ trans('cruds.purchase.fields.unitprice') }}</th>
                                <th>{{ trans('cruds.purchase.fields.discount') }} %</th>
                                <th width="18%">{{ trans('cruds.purchase.fields.producttotal') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count(json_decode($purchase->product_id, true)); $i++)
                                <tr class="productlist">
                                    <td>
                                        <select disabled name="product[]" id="product"
                                            class="form-control {{ $errors->has('product') ? 'is-invalid' : '' }} product">
                                            <option value="">Select</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @if ($product->id == json_decode($purchase->product_id, true)[$i]) selected @endif>
                                                    {{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('product'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('product') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.unit_helper') }}</span>
                                    </td>

                                    <td>
                                        <input readonly
                                            class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }} qty"
                                            type="number" min="0" max="9999" name="qty[]"
                                            value="{{ old('qty', json_decode($purchase->product_qty, true)[$i]) }}">
                                        @if ($errors->has('qty'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qty') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.qty_helper') }}</span>
                                    </td>

                                    <td>
                                        <select disabled name="unitid[]" id="unitid"
                                            class="form-control {{ $errors->has('unitid') ? 'is-invalid' : '' }} unitid">
                                            <option value=""></option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    @if ($unit->id == json_decode($purchase->unit_id, true)[$i]) selected @endif>{{ $unit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('unitid'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('unitid') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.unit_helper') }}</span>
                                    </td>

                                    <td>
                                        <input readonly
                                            class="form-control {{ $errors->has('unitprice') ? 'is-invalid' : '' }} unitprice"
                                            type="number" name="unitprice[]"
                                            value="{{ old('unitprice', json_decode($purchase->unit_price, true)[$i]) }}"
                                            min="0" max="99999">
                                        @if ($errors->has('unitprice'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('unitprice') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.unitprice_helper') }}</span>
                                    </td>

                                    <td>
                                        <input readonly
                                            class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }} discount"
                                            type="number" name="discount[]"
                                            value="{{ old('discount', json_decode($purchase->discount, true)[$i]) }}"
                                            min="0" max="99">
                                        <input readonly type="hidden" name="discountVal[]" class="discountVal" value="">

                                        @if ($errors->has('discount'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('discount') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.discount_helper') }}</span>
                                    </td>

                                    <td>
                                        @php
                                            $qty = json_decode($purchase->product_qty, true)[$i];
                                            $unitprice = json_decode($purchase->unit_price, true)[$i];
                                            $discount = json_decode($purchase->discount, true)[$i];

                                            $total = $qty * $unitprice;
                                            $dis = ($total * $discount) / 100;
                                            $producttotal = $total - $dis;
                                        @endphp
                                        <input readonly
                                            class="form-control {{ $errors->has('producttotal') ? 'is-invalid' : '' }} producttotal"
                                            type="number" name="producttotal[]"
                                            value="{{ old('producttotal', $producttotal) }}">
                                        @if ($errors->has('producttotal'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('producttotal') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.producttotal_helper') }}</span>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>

                    </table>
                </div>
                <div class="form-group">
                    <label class="" for="subtotal">{{ trans('cruds.purchase.fields.subtotal') }}</label>
                    <input readonly class="form-control {{ $errors->has('subtotal') ? 'is-invalid' : '' }} subtotal"
                        type="text" name="subtotal" id="subtotal" value="{{ old('subtotal', $purchase->subtotal) }}">
                    @if ($errors->has('subtotal'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subtotal') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.subtotal_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class=""
                        for="totaldiscount">{{ trans('cruds.purchase.fields.totaldiscount') }}</label>
                    <input readonly
                        class="form-control {{ $errors->has('totaldiscount') ? 'is-invalid' : '' }} totaldiscount"
                        type="text" name="totaldiscount" id="totaldiscount"
                        value="{{ old('totaldiscount', $purchase->total_discount) }}">
                    @if ($errors->has('totaldiscount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('totaldiscount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.totaldiscount_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class=""
                        for="transportcost">{{ trans('cruds.purchase.fields.transportcost') }}</label>
                    <input readonly
                        class="form-control {{ $errors->has('transportcost') ? 'is-invalid' : '' }} transportcost"
                        type="number" name="transportcost" id="transportcost"
                        value="{{ old('transportcost', $purchase->transport_cost) }}" min="0" max="99999">
                    @if ($errors->has('transportcost'))
                        <div class="invalid-feedback">
                            {{ $errors->first('transportcost') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.transportcost_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class=""
                        for="grandtotal">{{ trans('cruds.purchase.fields.grandtotal') }}</label>
                    <input readonly class="form-control {{ $errors->has('grandtotal') ? 'is-invalid' : '' }} grandtotal"
                        type="text" name="grandtotal" id="grandtotal"
                        value="{{ old('grandtotal', $purchase->grand_total) }}">
                    @if ($errors->has('grandtotal'))
                        <div class="invalid-feedback">
                            {{ $errors->first('grandtotal') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.grandtotal_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="" for="note">{{ trans('cruds.purchase.fields.note') }}</label>
                    <textarea readonly name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}"
                        rows="4">{{ old('note', $purchase->purchase_note) }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {{ $errors->first('note') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.note_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="" for="image">{{ trans('cruds.purchase.fields.image') }}</label><br>
                    @if ($purchase->purchase_image != null && file_exists(public_path('app/purchase/' . $purchase->purchase_image)))
                        <img src="{{ asset('app/purchase/' . $purchase->purchase_image) }}" alt="No image" height="100"
                            width="140">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.purchase.fields.status') }}</label>
                    <select disabled class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}"
                        name="status" id="status" required>
                        <option value="1" @if ($purchase->status == 1) selected @endif>Active</option>
                        <option value="0" @if ($purchase->status == 0) selected @endif>In-Active</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.status_helper') }}</span>
                </div>


                <div class="form-group save_btn">
                    <a class="btn btn-danger" href="{{ url()->previous() }}">
                        {{ trans('Back') }}
                    </a>
                </div>
            </form>
        </div>
    </div> --}}



    <div class="content pb-4" id="contentBox" media="print">
        <div class="container">
            <div class="row">
                <div class="card p-2">
                    <div class="card-header">
                        <h3 class="card-title">View purchase : {{ $purchase->purchase_code }}</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 table-responsive view-table">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Purchased Code:</strong>
                                                {{ $purchase->purchase_code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Supplier:</strong>
                                                {{ $user->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Purchase Products:</strong>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%">#</th>
                                                                <th width="12%">
                                                                    {{ trans('cruds.purchase.fields.product') }}</th>
                                                                <th width="8%">{{ trans('cruds.purchase.fields.qty') }}
                                                                </th>
                                                                <th width="8%">Used</th>
                                                                <th width="8%">Return</th>
                                                                <th width="8%">Damage</th>
                                                                <th width="8%">Available</th>
                                                                <th width="5%">
                                                                    {{ trans('cruds.purchase.fields.unitprice') }}</th>
                                                                <th width="5%">
                                                                    {{ trans('cruds.purchase.fields.discount') }} %</th>
                                                                <th width="20%">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 0; $i < count(json_decode($purchase->product_id, true)); $i++)
                                                                @foreach ($units as $unit)
                                                                    @if ($unit->id == json_decode($purchase->unit_id, true)[$i])
                                                                        @php $unitName = $unit->name @endphp
                                                                    @endif
                                                                @endforeach

                                                                @php
                                                                    $qty = json_decode($purchase->product_qty, true)[$i];
                                                                    $unitprice = json_decode($purchase->unit_price, true)[$i];
                                                                    $discount = json_decode($purchase->discount, true)[$i];

                                                                    $return_qty = isset($returnPurchase) ? json_decode($returnPurchase->returnqty, true)[$i] : 0;
                                                                    $damage_qty = isset($damagePurchase) ? json_decode($damagePurchase->damageqty, true)[$i] : 0;

                                                                    $total = $qty * $unitprice;
                                                                    $dis = ($total * $discount) / 100;
                                                                    $producttotal = $total - $dis;
                                                                @endphp
                                                                <tr class="productlist pl-2">
                                                                    <td>
                                                                        {{ $i + 1 }}
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($products as $product)
                                                                            @if ($product->id == json_decode($purchase->product_id, true)[$i])
                                                                                {{ $product->product_name }}
                                                                            @endif
                                                                        @endforeach
                                                                    </td>

                                                                    <td>
                                                                        {{ $qty }} {{ $unitName }}
                                                                    </td>

                                                                    <td>
                                                                        0 {{ $unitName }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $return_qty }} {{ $unitName }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $damage_qty }} {{ $unitName }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $qty - $return_qty - $damage_qty }}
                                                                        {{ $unitName }}
                                                                    </td>

                                                                    <td>
                                                                        ${{ $unitprice }}
                                                                    </td>

                                                                    <td>
                                                                        ${{ $dis }} ({{ $discount }} %)
                                                                    </td>

                                                                    <td>
                                                                        ${{ $total }} - ${{ $dis }} =
                                                                        ${{ $producttotal }}
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Subtotal:</strong>
                                                ${{ number_format($purchase->subtotal, 2) }}
                                                (After reducing discount.)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Discount:</strong>
                                                ${{ number_format($purchase->total_discount, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Trasnport Cost:</strong>
                                                +${{ number_format($purchase->transport_cost, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Grand Total:</strong>
                                                ${{ number_format($purchase->grand_total, 2) }}
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td><strong>Total Paid:</strong>
                                                $120
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td><strong>Total Due:</strong>
                                                ${{ number_format($purchase->grand_total, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Refund Amount:</strong>
                                                ${{ (isset($returnPurchase)) ? number_format($returnPurchase->return_amount, 2) : 0}}
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td><strong>Payment Method:</strong>
                                                money
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td><strong>Note:</strong>
                                                {!! $purchase->purchase_note !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong>
                                                @if ($purchase->status == 1)
                                                <span class="badge badge-success">Active</span>
                                                @else
                                                <span class="badge badge-danger">In Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-12 col-lg-12 text-center justify-content-center align-self-center">
                                @if ($purchase->purchase_image != null && file_exists(public_path('app/purchase/' . $purchase->purchase_image)))
                                    <img src="{{ asset('app/purchase/' . $purchase->purchase_image) }}" alt="No image"
                                        height="360" width="640">
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-footer no-print"><a href="{{ url()->previous() }}" class="btn btn-primary"><i
                                class="fas fa-long-arrow-alt-left"></i> Go Back
                        </a> <a href="javascript:void(0)" class="btn btn-secondary float-right print-btn" id="printMe"><i
                                class="fas fa-print"></i>
                            Print</a></div>
                </div>
            </div>


            @if (isset($returnPurchase))
                <div class="row mt-5">
                    <div class="card col-md-12">
                        <div class="card-header">
                            <h3 class="card-title">View returns products for purchase: {{ $purchase->purchase_code }}
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 table-responsive view-table min-height-150">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Return Reason:</strong>
                                                    {{ $returnPurchase->return_reason }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Return Date:</strong>
                                                    {{ date('d-M-Y', strtotime($returnPurchase->return_date)) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Purchase Products:</strong>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Product</th>
                                                                    <th>Purchased Qty</th>
                                                                    <th>Return</th>
                                                                    <th>Unit Price</th>
                                                                    <th class="text-right">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @for ($i = 0; $i < count(json_decode($returnPurchase->purchase->product_id, true)); $i++)
                                                                    @foreach ($units as $unit)
                                                                        @if ($unit->id == json_decode($purchase->unit_id, true)[$i])
                                                                            @php $unitName = $unit->name @endphp
                                                                        @endif
                                                                    @endforeach

                                                                    @php
                                                                        $qty = json_decode($purchase->product_qty, true)[$i];
                                                                        $unitprice = json_decode($purchase->unit_price, true)[$i];
                                                                        $discount = json_decode($purchase->discount, true)[$i];

                                                                        $return_qty = isset($returnPurchase) ? json_decode($returnPurchase->returnqty, true)[$i] : 0;
                                                                        $damage_qty = isset($damagePurchase) ? json_decode($damagePurchase->damageqty, true)[$i] : 0;

                                                                        $total = $qty * $unitprice;
                                                                        $dis = ($total * $discount) / 100;
                                                                        $producttotal = $total - $dis;
                                                                    @endphp
                                                                    <tr class="productlist pl-2">
                                                                        <td>
                                                                            {{ $i + 1 }}
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($products as $product)
                                                                                @if ($product->id == json_decode($purchase->product_id, true)[$i])
                                                                                    {{ $product->product_name }}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>

                                                                        <td>
                                                                            {{ $qty }} {{ $unitName }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $return_qty }} {{ $unitName }}
                                                                        </td>

                                                                        <td>
                                                                            ${{ $unitprice }}
                                                                        </td>

                                                                        <td class="text-right">
                                                                            ${{ $producttotal }}
                                                                        </td>
                                                                    </tr>
                                                                @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Refund Amount:</strong>
                                                    ${{ number_format($returnPurchase->return_amount,2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Note:</strong>
                                                    {{ $returnPurchase->return_note }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong>
                                                    @if ($returnPurchase->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                    @else
                                                    <span class="badge badge-danger">In Active</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // CKEDITOR.replace('note');
        // CKEDITOR.add
        $("#printMe").click(function() {
            // $("#contentBox").printArea({
            //     mode: 'popup',
            //     popClose: true
            // });
            $('#contentBox').print({
                append: "<br/>",
                prepend: "<br/>",
                deferred: $.Deferred(),

            });
        });
    </script>
@endsection
