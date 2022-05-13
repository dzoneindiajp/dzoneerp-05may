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
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.returnpurchases.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.returnpurchases.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label class="required" for="reason">{{ trans('cruds.returnpurchases.fields.reason') }}</label>
                    <input class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" type="text" name="reason"
                        id="reason" value="{{ old('reason', '') }}" required>
                    @if ($errors->has('reason'))
                        <div class="invalid-feedback">
                            {!! $errors->first('reason') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.reason_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="purchase">{{ trans('cruds.returnpurchases.fields.purchase') }}</label>
                    <select name="purchase" id="purchase"
                        class="form-control {{ $errors->has('purchase') ? 'is-invalid' : '' }} purchase" required>
                        <option value="">Select</option>
                        @foreach ($purchases as $purchase)
                            <option value="{{ $purchase->id }}">{{ $purchase->purchase_code }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('purchase'))
                        <div class="invalid-feedback">
                            {!! $errors->first('purchase') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.purchase_helper') }}</span>
                </div>


                <div id="productTable"></div>


                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.returnpurchases.fields.date') }}</label>
                    <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date"
                        id="date" value="{{ old('date', '') }}" required>
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {!! $errors->first('date') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.date_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required"
                        for="refundamount">{{ trans('cruds.returnpurchases.fields.refundamount') }}</label>
                    <input class="form-control {{ $errors->has('refundamount') ? 'is-invalid' : '' }} refundamount"
                        type="number" name="refundamount" id="refundamount" value="{{ old('refundamount', '00') }}"
                        required min="0" max="99999">
                    @if ($errors->has('refundamount'))
                        <div class="invalid-feedback">
                            {!! $errors->first('refundamount') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.refundamount_helper') }}</span>
                </div>


                <div class="form-group" style="width: 98% !important;">
                    <label class="required" for="note">{{ trans('cruds.returnpurchases.fields.note') }}</label>
                    <textarea name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" rows="4"
                        required>{{ old('note', '') }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {!! $errors->first('note') !!}
                        </div>
                    @endif
                    <span id="note_err" class="text-danger"></span>
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.note_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="image">{{ trans('cruds.returnpurchases.fields.image') }}</label><br>
                    <div class="custom-file">
                        <input type="file" id="image" name="image"
                            class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                            value="{{ old('image', '') }}">
                        <label class="custom-file-label" for="image">Choose Image</label>
                    </div>
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {!! $errors->first('image') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.returnpurchases.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.returnpurchases.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value="1" selected>Active</option>
                        <option value="0">In-Active</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
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
        $('input[type="number"]').on('keypress', function(e) {
            // if (e.which < 48 || e.which > 57) {
            //     e.preventDefault();
            //     return false;
            // }
            if ($(this).val().length > 0) {
                $(this).val($(this).val().replace(/^0+/, ''));
            }
        });

        CKEDITOR.replace('note');
        CKEDITOR.add

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
                        let minDate = $('body').find('#minDate').val();
                        $('body').find(':input[type="date"]').attr('min', minDate);
                        $('body').find(':input[type="date"]').val('');
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
