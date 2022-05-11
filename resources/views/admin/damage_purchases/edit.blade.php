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
            {{ trans('global.edit') }} {{ trans('cruds.damagepurchases.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.damagepurchases.update',$damage->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label class="required" for="reason">{{ trans('cruds.damagepurchases.fields.reason') }}</label>
                    <input class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" type="text" name="reason"
                        id="reason" value="{{ old('reason', $damage->damage_reason) }}" required>
                    @if ($errors->has('reason'))
                        <div class="invalid-feedback">
                            {!! $errors->first('reason') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.damagepurchases.fields.reason_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="purchase">{{ trans('cruds.damagepurchases.fields.purchase') }}</label>
                    <select name="purchase" id="purchase"
                        class="form-control {{ $errors->has('purchase') ? 'is-invalid' : '' }} purchase" required>
                        <option value="">Select</option>
                        @foreach ($purchases as $purchase)
                            <option value="{{ $purchase->id }}" @if ($purchase->id == $damage->purchase_id) selected  @endif>
                                {{ $purchase->purchase_code }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('purchase'))
                        <div class="invalid-feedback">
                            {!! $errors->first('purchase') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.damagepurchases.fields.purchase_helper') }}</span>
                </div>


                <div id="productTable"></div>


                <div class="form-group" style="width: 98% !important;">
                    <label class="required" for="note">{{ trans('cruds.damagepurchases.fields.note') }}</label>
                    <textarea name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" rows="4"
                        required>{{ old('note', $damage->damage_note) }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {!! $errors->first('note') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.damagepurchases.fields.note_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.damagepurchases.fields.date') }}</label>
                    <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date"
                        id="date" value="{{ old('date', $damage->damage_date) }}" required>
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {!! $errors->first('date') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.damagepurchases.fields.date_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="old_image">{{ trans('Old') }}
                        {{ trans('cruds.damagepurchases.fields.image') }}</label><br>
                    @if ($damage->damage_image != null && file_exists(public_path('app/damage_purchase/' . $damage->damage_image)))
                        <img src="{{ asset('app/damage_purchase/' . $damage->damage_image) }}" alt="No image" height="120"
                            width="180">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required"
                        for="image">{{ trans('cruds.damagepurchases.fields.image') }}</label><br>
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
                        <input type="hidden" id="old_image" name="old_image" value="{{ $damage->damage_image }}">
                        <span class="help-block">{{ trans('cruds.damagepurchases.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.damagepurchases.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value="1" @if ($damage->status == 1) selected @endif>Active</option>
                        <option value="0" @if ($damage->status == 0) selected @endif>In-Active</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.damagepurchases.fields.status_helper') }}</span>
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
        $(document).ready(function() {
            var purchase_id = {{ $damage->purchase_id }};

            if (purchase_id != '') {
                $("#productTable").val('').trigger('change').prop('disabled', true);
                $.ajax({
                    url: "{{ url('admin/damagepurchases/getproducts') }}",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        purchase_id: purchase_id,
                        damage_qty: 1,
                    },
                    success: function(res) {
                        $('body').find('#productTable').html(res);
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
                    url: "{{ url('admin/damagepurchases/getproducts') }}",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        purchase_id: purchase_id,
                        damage_qty: 0,
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
