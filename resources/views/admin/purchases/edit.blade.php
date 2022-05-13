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
            {{ trans('global.edit') }} {{ trans('cruds.purchase.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.purchases.update', $purchase->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.purchase.fields.date') }}</label>
                    <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date"
                        id="date" value="{{ old('date', $purchase->purchase_date) }}" required>
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.date_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="usertype">{{ trans('cruds.purchase.fields.usertype') }}</label>
                    <select class="form-control select2 {{ $errors->has('usertype') ? 'is-invalid' : '' }} usertype" name="usertype"
                        id="usertype" required>
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
                    <label class="required" for="userid">{{ trans('cruds.purchase.fields.user') }}</label>
                    <select name="userid" id="userid"
                        class="form-control {{ $errors->has('userid') ? 'is-invalid' : '' }}" required>
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

                <div class="form-group w-100 m-2  table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">{{ trans('cruds.purchase.fields.product') }}</th>
                                <th width="10%">{{ trans('cruds.purchase.fields.qty') }}</th>
                                <th>{{ trans('cruds.purchase.fields.unit') }}</th>
                                <th>{{ trans('cruds.purchase.fields.unitprice') }}</th>
                                <th>{{ trans('cruds.purchase.fields.discount') }} %</th>
                                <th width="15%">{{ trans('cruds.purchase.fields.producttotal') }}</th>
                                <th>{{ trans('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count(json_decode($purchase->product_id, true)); $i++)
                                <tr class="productlist">
                                    <td>
                                        <select name="product[]" id="product"
                                            class="form-control {{ $errors->has('product') ? 'is-invalid' : '' }} product"
                                            required>
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
                                        <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }} qty"
                                            type="number" min="0" max="9999" name="qty[]"
                                            value="{{ old('qty', json_decode($purchase->product_qty, true)[$i]) }}"
                                            required>
                                        @if ($errors->has('qty'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qty') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.qty_helper') }}</span>
                                    </td>

                                    <td>
                                        <select name="unitid[]" id="unitid"
                                            class="form-control {{ $errors->has('unitid') ? 'is-invalid' : '' }} unitid"
                                            required>
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
                                        <input
                                            class="form-control {{ $errors->has('unitprice') ? 'is-invalid' : '' }} unitprice"
                                            type="number" name="unitprice[]"
                                            value="{{ old('unitprice', json_decode($purchase->unit_price, true)[$i]) }}"
                                            min="0" max="99999" required>
                                        @if ($errors->has('unitprice'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('unitprice') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.unitprice_helper') }}</span>
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
                                        <input
                                            class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }} discount"
                                            type="number" name="discount[]"
                                            value="{{ old('discount', json_decode($purchase->discount, true)[$i]) }}"
                                            min="0" max="99" required>
                                        <input type="hidden" name="discountVal[]" class="discountVal"
                                            value="{{ $dis }}">

                                        @if ($errors->has('discount'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('discount') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.discount_helper') }}</span>
                                    </td>

                                    <td>
                                        <input
                                            class="form-control {{ $errors->has('producttotal') ? 'is-invalid' : '' }} producttotal"
                                            type="number" name="producttotal[]"
                                            value="{{ old('producttotal', $producttotal) }}" readonly required>
                                        @if ($errors->has('producttotal'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('producttotal') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.purchase.fields.producttotal_helper') }}</span>
                                    </td>

                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-success add">+</a>
                                        <a href="javascript:void(0)" class="btn btn-danger minus">-</a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>

                    </table>
                </div>

                <div class="form-group">
                    <label class="required" for="subtotal">{{ trans('cruds.purchase.fields.subtotal') }}</label>
                    <input readonly class="form-control {{ $errors->has('subtotal') ? 'is-invalid' : '' }} subtotal"
                        type="text" name="subtotal" id="subtotal" value="{{ old('subtotal', $purchase->subtotal) }}"
                        required>
                    @if ($errors->has('subtotal'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subtotal') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.subtotal_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="totaldiscount">{{ trans('cruds.purchase.fields.totaldiscount') }}</label>
                    <input readonly
                        class="form-control {{ $errors->has('totaldiscount') ? 'is-invalid' : '' }} totaldiscount"
                        type="text" name="totaldiscount" id="totaldiscount"
                        value="{{ old('totaldiscount', $purchase->total_discount) }}" required>
                    @if ($errors->has('totaldiscount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('totaldiscount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.totaldiscount_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="transportcost">{{ trans('cruds.purchase.fields.transportcost') }}</label>
                    <input class="form-control {{ $errors->has('transportcost') ? 'is-invalid' : '' }} transportcost"
                        type="number" name="transportcost" id="transportcost"
                        value="{{ old('transportcost', $purchase->transport_cost) }}" required min="0" max="99999">
                    @if ($errors->has('transportcost'))
                        <div class="invalid-feedback">
                            {{ $errors->first('transportcost') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.transportcost_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="grandtotal">{{ trans('cruds.purchase.fields.grandtotal') }}</label>
                    <input readonly class="form-control {{ $errors->has('grandtotal') ? 'is-invalid' : '' }} grandtotal"
                        type="text" name="grandtotal" id="grandtotal"
                        value="{{ old('grandtotal', $purchase->grand_total) }}" required>
                    @if ($errors->has('grandtotal'))
                        <div class="invalid-feedback">
                            {{ $errors->first('grandtotal') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.grandtotal_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="note">{{ trans('cruds.purchase.fields.note') }}</label>
                    <textarea name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}"
                        rows="4" required>{{ old('note', $purchase->purchase_note) }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {{ $errors->first('note') }}
                        </div>
                    @endif
                    <span id="note_err" class="text-danger"></span>

                    <span class="help-block">{{ trans('cruds.purchase.fields.note_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="image">{{ trans('Old') }}
                        {{ trans('cruds.purchase.fields.image') }}</label><br>
                    @if ($purchase->purchase_image != null && file_exists(public_path('app/purchase/' . $purchase->purchase_image)))
                        <img src="{{ asset('app/purchase/' . $purchase->purchase_image) }}" alt="No image" height="100"
                            width="140">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="image">{{ trans('cruds.purchase.fields.image') }}</label><br>
                    <div class="custom-file">
                        <input type="file" id="image" name="image"
                            class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                            value="{{ old('image', '') }}">
                        <label class="custom-file-label" for="image">Choose Image</label>
                    </div>
                    <input type="hidden" name="old_image" class="old_image" value="{{ $purchase->purchase_image }}">
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.purchase.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.purchase.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
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
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>

                    <a class="btn btn-primary" href="{{ url()->previous() }}">
                        {{ trans('Back') }}
                    </a>

                </div>
            </form>
        </div>

    </div>
    <script type="text/javascript">
        CKEDITOR.replace( 'note' );
        CKEDITOR.add
        $('input[type="number"]').on('keypress', function(e) {
            // if (e.which < 48 || e.which > 57) {
            //     e.preventDefault();
            //     return false;
            // }
            if ($(this).val().length > 0) {
                $(this).val($(this).val().replace(/^0+/, ''));
            }
        });

        function calculation() {
            var total_discount = 0;
            $.each($('.productlist'), function() {
                total_discount += Number($(this).find('.discountVal').val());
                $('body').find(':input[name="totaldiscount"]').val(total_discount);
            });

            let transportcost = Number($('body').find('.transportcost').val());
            var subtotal = 0;
            $.each($('.productlist'), function() {
                subtotal += Number($(this).find('.producttotal').val());
                $('body').find(':input[name="subtotal"]').val(subtotal);
                $('body').find(':input[name="grandtotal"]').val(subtotal);

                if (transportcost != null || transportcost > 0) {
                    $('body').find(':input[name="grandtotal"]').val(transportcost + subtotal);
                }
            });
        }

        $('body').on('click', '.add', function(e) {
            let $tr = $(this).closest('.productlist');
            let $clone = $tr.clone();

            $clone.find('input').val('');
            $clone.find('.discount').val(00);
            $tr.after($clone);
        });

        $('body').on('click', '.minus', function(e) {
            if ($('.productlist').length > 1) {
                $(this).closest('.productlist').remove();
                calculation();
            }
        });


        $('body').on('change', '#transportcost', function(e) {
            let transportcost = Number($(this).val());
            var subtotal = Number($('body').find(':input[name="subtotal"]').val());

            $('body').find(':input[name="grandtotal"]').val(transportcost + subtotal);
        });

        $('body table').on('change', 'input', function(e) {
            let tr = $(this).closest('.productlist');
            var qty = Number(tr.find('.qty').val());
            var unit_price = Number(tr.find('.unitprice').val());
            var discount = Number(tr.find('.discount').val());

            let calc = qty * unit_price;
            var totaldiscount = Number((calc * discount) / 100);
            var total = calc - totaldiscount;

            tr.find('.producttotal').val(total);
            tr.find('.discountVal').val(totaldiscount);

            if ($('.productlist').length <= 1) {
                $('body').find(':input[name="transportcost"]').val('00');
            }

            calculation();
        });


        $('body').on('change', '.usertype', function(e) {

            var user_type = $(this).val();
            if (user_type != '') {
                $("#userid").val('').trigger('change').prop('disabled', true);
                $.ajax({
                    url: "{{ url('admin/purchases/getUsers') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        user_type: user_type,
                    },
                    success: function(res) {
                        if (res[0]) {
                            $("#userid").val('').trigger('change');
                            $("#userid").html('<option value="">Select</option>');
                            $.each(res[1], function(key, value) {
                                $("#userid").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            $("#userid").prop('disabled', false);
                        } else {

                        }
                    }
                });
            } else {
                $('#userid').val('').trigger('change').html('<option value=""></option>');
                $("#userid").prop('disabled', false);
            }
        });

        $("form").submit(function(e) {
            var messageLength = CKEDITOR.instances['note'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {
                $('#note_err').text('Please enter Note');
                e.preventDefault();
            } else {
                $('#note_err').text('');
            }
        });

    </script>
@endsection
