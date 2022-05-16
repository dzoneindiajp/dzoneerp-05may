@extends('layouts.master')
@section('content')



    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.returnpurchases.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="#" onsubmit="false">

                <div class="form-group">
                    <label class="required" for="reason">{{ trans('cruds.returnpurchases.fields.reason') }}</label>
                    <input readonly class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" type="text"
                        name="reason" id="reason" value="{{ old('reason', $return->return_reason) }}" required>
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.reason_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="purchase">{{ trans('cruds.returnpurchases.fields.purchase') }}</label>
                    <select disabled name="purchase" id="purchase"
                        class="form-control {{ $errors->has('purchase') ? 'is-invalid' : '' }} purchase" required>
                        <option value="">Select</option>
                        @foreach ($purchases as $purchase)
                            <option value="{{ $purchase->id }}" @if ($purchase->id == $return->purchase_id) selected @endif>
                                {{ $purchase->purchase_code }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.purchase_helper') }}</span>
                </div>


                <div id="productTable"></div>


                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.returnpurchases.fields.date') }}</label>
                    <input readonly class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date"
                        name="date" id="date" value="{{ old('date', $return->return_date) }}" required>
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.date_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required"
                        for="refundamount">{{ trans('cruds.returnpurchases.fields.refundamount') }}</label>
                    <input readonly
                        class="form-control {{ $errors->has('refundamount') ? 'is-invalid' : '' }} refundamount"
                        type="number" name="refundamount" id="refundamount"
                        value="{{ old('refundamount', $return->return_amount) }}" required min="0" max="99999">
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.refundamount_helper') }}</span>
                </div>


                <div class="form-group" style="width: 98% !important;">
                    <label class="required" for="note">{{ trans('cruds.returnpurchases.fields.note') }}</label>
                    <textarea readonly name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" rows="4"
                        required>{{ old('note', $return->return_note) }}</textarea>
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.note_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required" for="old_image">
                        {{ trans('cruds.returnpurchases.fields.image') }}</label><br>
                    @if ($return->return_image != null && file_exists(public_path('app/return_purchase/' . $return->return_image)))
                        <img src="{{ asset('public/app/return_purchase/' . $return->return_image) }}" alt="No image"
                            height="120" width="180">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.returnpurchases.fields.status') }}</label>
                    <select disabled class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value="1" @if ($return->status == 1) selected @endif>Active</option>
                        <option value="0" @if ($return->status == 0) selected @endif>In-Active</option>
                    </select>
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.status_helper') }}</span>
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
        $(document).ready(function() {
            var purchase_id = {{ $return->purchase_id }};

            if (purchase_id != '') {
                $("#productTable").val('').trigger('change').prop('disabled', true);
                $.ajax({
                    url: "{{ url('admin/returnpurchases/getproducts') }}",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        purchase_id: purchase_id,
                        return_qty: 1,
                    },
                    success: function(res) {
                        $('body').find('#productTable').html(res);
                        let returnqty = $('body').find('.returnqty');
                        $.each(returnqty, function() {
                            $(this).prop('readonly',true);
                        });
                    }
                });
            } else {
                $('#productTable').val('').trigger('change').html('');
                $("#productTable").prop('disabled', false);
            }

        });
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

            var subtotal = 0;
            $.each($('.productlist'), function() {
                subtotal += Number($(this).find('.producttotal').val());
                $('body').find(':input[name="subtotal"]').val(subtotal);
                $('body').find(':input[name="grandtotal"]').val(subtotal);
            });
        }

        $('body').on('change', '.purchase', function(e) {

            var purchase_id = $(this).val();
            console.log(purchase_id);

            if (purchase_id != '') {
                $("#userid").val('').trigger('change').prop('disabled', true);
                $.ajax({
                    url: "{{ url('admin/returnpurchases/getproducts') }}",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        purchase_id: purchase_id,
                        return_qty: 0,
                    },
                    success: function(res) {
                        $('body').find('#productTable').html(res);
                    }
                });
            } else {
                $('#userid').val('').trigger('change').html('<option value=""></option>');
                $("#userid").prop('disabled', false);
            }
        });
    </script>
@endsection
