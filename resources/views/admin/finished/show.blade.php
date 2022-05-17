@extends('layouts.master')
@section('content')
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
            {{ trans('global.show') }} {{ trans('cruds.finished.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="#">

                <div class="form-group" style="width: 98% !important;">
                    <label class="required" for="processing">{{ trans('cruds.finished.fields.processing') }}</label>
                    <select disabled
                        class="form-control select2 {{ $errors->has('processing') ? 'is-invalid' : '' }} processing"
                        name="processing" id="processing" required>
                        <option value="">Select</option>
                        @foreach ($processings as $processing)
                            <option value="{{ $processing->id }}" @if ($processing->id == $finished->processing_id) selected @endif>
                                {{ $processing->processing_code }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{ trans('cruds.finished.fields.processing_helper') }}</span>
                </div>

                <div id="productTable"></div>

                <div class="form-group w-100">
                    <label class="required" for="note">{{ trans('cruds.finished.fields.note') }}</label>
                    <textarea readonly name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" rows="4"
                        required>{{ old('note', $finished->finished_note) }}</textarea>

                    <span id="note_err" class="text-danger"></span>
                    <span class="help-block">{{ trans('cruds.finished.fields.note_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.finished.fields.date') }}</label>
                    <input readonly class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date"
                        name="date" id="date" value="{{ old('date', $finished->finished_date) }}" required>
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {!! $errors->first('date') !!}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.finished.fields.status') }}</label>
                    <select disabled class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}"
                        name="status" id="status" required>
                        <option value="1" selected>Active</option>
                        <option value="0">In-Active</option>
                    </select>
                </div>

                @if ($finished->finished_image != null && file_exists(public_path('app/finished/' . $finished->finished_image)))
                    <div class="form-group w-100">
                        <label class="required"
                            for="old_image">{{ trans('cruds.finished.fields.image') }}</label><br>
                        <img src="{{ asset('public/app/finished/' . $finished->finished_image) }}" alt="No image" height="100"
                            width="140">
                    </div>
                @endif


                <div class="form-group save_btn">
                    <a class="btn btn-primary" href="{{ url()->previous() }}">
                        {{ trans('Back') }}
                    </a>
                </div>
            </form>
        </div>

    </div>
    <script type="text/javascript">
        CKEDITOR.replace('note');
        CKEDITOR.add

        $(document).ready(function() {
            var processing_id = $('body').find('.processing').val();

            if (processing_id != '') {
                $("#userid").val('').trigger('change').prop('disabled', true);
                $.ajax({
                    url: "{{ url('admin/finished/getProcessing') }}",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        processing_id: processing_id,
                        finished_qty: 1,
                    },
                    success: function(res) {
                        $('body').find('#productTable').html(res);
                        let minDate = $('body').find('#minDate').val();
                        $('body').find(':input[type="date"]').attr('min', minDate);

                        let returnqty = $('body').find('.used_qty');
                        $.each(returnqty, function() {
                            $(this).prop('readonly', true);
                        });
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
    </script> --}}

    <div class="content pb-4" id="contentBox" media="print">
        <div class="container">
            <div class="">
                <div class="card p-2">
                    <div class="card-header">
                        <h3 class="card-title">View : {{ $finished->finished_code }}</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 table-responsive view-table">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Processing Code:</strong>
                                                {{ $finished->processing->processing_code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Finished Date:</strong>
                                                {{ date('d-M-Y',strtotime($finished->finished_date)) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Products:</strong>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%">#</th>
                                                                <th width="12%">
                                                                    {{ trans('cruds.finished.fields.product') }}</th>
                                                                <th width="8%">
                                                                    {{ trans('cruds.finished.fields.purchaseqty') }}
                                                                <th width="8%">
                                                                    {{ trans('cruds.finished.fields.availableqty') }}
                                                                </th>
                                                                <th width="8%">
                                                                    {{ trans('cruds.finished.fields.usedqty') }}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 0; $i < count(json_decode($finished->product_name, true)); $i++)
                                                                @php
                                                                    $qty = json_decode($finished->purchase_qty, true)[$i];
                                                                    $unitName = json_decode($finished->unit_name, true)[$i];
                                                                    $available_qty = json_decode($finished->available_qty, true)[$i];

                                                                    $return_qty = isset($returnPurchase) ? json_decode($returnPurchase->returnqty, true)[$i] : 0;
                                                                    $damage_qty = isset($damagePurchase) ? json_decode($damagePurchase->damageqty, true)[$i] : 0;

                                                                    $product_name = json_decode($finished->product_name, true)[$i];
                                                                    $used_qty = json_decode($finished->used_qty, true)[$i];
                                                                @endphp

                                                                <tr class="productlist pl-2">
                                                                    <td>
                                                                        {{ $i + 1 }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $product_name }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $qty }} {{ $unitName }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $available_qty }} {{ $unitName }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $used_qty }} {{ $unitName }}
                                                                    </td>

                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Note:</strong>
                                                {!! $finished->finished_note !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong>
                                                @if ($finished->status == 1)
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
                                @if ($finished->finished_image != null && file_exists(public_path('app/finished/' . $finished->finished_image)))
                                    <img src="{{ asset('public/app/finished/' . $finished->finished_image) }}"
                                        alt="No image" height="360" width="640">
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-footer no-print"><a href="{{ url()->previous() }}" class="btn btn-primary"><i
                                class="fas fa-long-arrow-alt-left"></i> Go Back
                        </a>
                        <a href="javascript:void(0)" class="btn btn-secondary float-right print-btn" id="printMe">
                            <i class="fas fa-print"></i>
                            Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // CKEDITOR.replace('note');
        // CKEDITOR.add

    </script>
@endsection
