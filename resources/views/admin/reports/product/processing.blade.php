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

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.processings.title_singular') }} {{ trans('global.report') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="#" method="POST" enctype="multipart/form-data">
                {{-- @csrf --}}

                <div class="form-group col-md-3"><label for="fromDate">From Date</label>
                    <input type="date" id="fromDate" name="fromDate" required="required" class=" form-control">
                    <label id="fromDate_err" class="text-danger"></label>
                </div>

                <div class="form-group col-md-3"><label for="toDate">To Date</label>
                    <input type="date" id="toDate" name="toDate" required="required" class=" form-control">
                    <label id="toDate_err" class="text-danger"></label>
                </div>

                <div class="form-group col-md-3">

                    <label class="required" for="purchase">{{ trans('cruds.purchase.title_singular') }}</label>
                    <select name="purchase" id="purchase"
                        class="form-control select2 {{ $errors->has('purchase') ? 'is-invalid' : '' }}" required>
                        <option value="">Select</option>
                        @foreach ($purchases as $purchase)
                            <option value="{{ $purchase->id }}">{{ $purchase->purchase_code }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('purchase'))
                        <div class="invalid-feedback">
                            {{ $errors->first('purchase') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.subcategory_helper') }}</span>
                </div>

                <div class="form-group col-md-2">
                    <br>
                    <button class="btn btn-primary" type="submit" id="filter">
                        {{ trans('global.filter') }} <i class="fas fa-filter"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>


    <div id="load_data"></div>


    <script type="text/javascript">
        fromDate.max = new Date().toISOString().split("T")[0];

        $('body').on('change', '#fromDate', function(e) {
            dat = $(this).val();
            $('#toDate').attr('min', dat);
            $('#toDate').val(' ');
        });

        $('body').on('change', '#toDate', function(e) {
            dat = $(this).val();
            $('#fromDate').attr('max', dat);
        });

        $('body').on('click', '#filter', function(e) {
            e.preventDefault();
            let fromDate = $('body').find('#fromDate').val();
            let toDate = $('body').find('#toDate').val();
            let purchase = $('body').find('#purchase').val();

            $('#fromDate_err').text('');
            $('#toDate_err').text('');
            if (fromDate != '' && toDate != '') {
                if (fromDate == toDate) {
                    $('#fromDate_err').text('Select Different Date');
                    $('#toDate_err').text('Select Different Date');
                }
                $.ajax({
                    url: '{{ route('admin.reports.product.getprocessingReport') }}',
                    method: 'POST',
                    datatype: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        fromDate: fromDate,
                        toDate: toDate,
                        purchase: purchase,
                    },
                    success: function(res) {
                        $('body').find('#load_data').html(res);
                    },
                });
            } else {
                $('#fromDate_err').text('Select Date');
                $('#toDate_err').text('Select Date');
            }
        });
    </script>
@endsection
