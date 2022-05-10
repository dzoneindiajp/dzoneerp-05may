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

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.purchase.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="#">
                <div class="form-group">
                    <label class="" for="date">{{ trans('cruds.purchase.fields.date') }}</label>
                    <input readonly class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date"
                        id="date" value="{{ old('date', $purchase->purchase_date) }}">
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.date_helper') }}</span>
                </div>
                <br>
                <div class="form-group">
                    <label class=""
                        for="usertype">{{ trans('cruds.purchase.fields.usertype') }}</label><br>
                    <input readonly type="radio" name="usertype" class="usertype" value="0"
                        @if ($purchase->user_type == 0) checked @endif> Supplier
                    <input readonly type="radio" name="usertype" class="usertype" value="1"
                        @if ($purchase->user_type == 1) checked @endif> Vendor
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
                <div class="form-group w-100 m-2">
                    <table class="table table-responsive">
                        <thead class="w-100">
                            <tr>
                                <th>{{ trans('cruds.purchase.fields.product') }}</th>
                                <th>{{ trans('cruds.purchase.fields.qty') }}</th>
                                <th>{{ trans('cruds.purchase.fields.unit') }}</th>
                                <th>{{ trans('cruds.purchase.fields.unitprice') }}</th>
                                <th>{{ trans('cruds.purchase.fields.discount') }} %</th>
                                <th>{{ trans('cruds.purchase.fields.producttotal') }}</th>
                            </tr>
                        </thead>
                        <tbody class="w-100">
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
                                        <input readonly class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }} qty"
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
                                        <input readonly class="form-control {{ $errors->has('unitprice') ? 'is-invalid' : '' }} unitprice"
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
                                        <input readonly class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }} discount"
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
                                        <input readonly class="form-control {{ $errors->has('producttotal') ? 'is-invalid' : '' }} producttotal"
                                            type="number" name="producttotal[]"
                                            value="{{ old('producttotal', $producttotal) }}" >
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
                    <input readonly  class="form-control {{ $errors->has('subtotal') ? 'is-invalid' : '' }} subtotal"
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
                    <input readonly class="form-control {{ $errors->has('totaldiscount') ? 'is-invalid' : '' }} totaldiscount"
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
                    <input readonly class="form-control {{ $errors->has('transportcost') ? 'is-invalid' : '' }} transportcost"
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
                    <input readonly  class="form-control {{ $errors->has('grandtotal') ? 'is-invalid' : '' }} grandtotal"
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

                <div class="form-group save_btn">
                    <a class="btn btn-danger" href="{{ url()->previous() }}">
                        {{ trans('Back') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
