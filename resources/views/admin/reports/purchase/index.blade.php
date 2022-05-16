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
            {{ trans('cruds.purchasereport.title_singular') }}
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

                    <label class="required" for="supplier">{{ trans('cruds.supplier.title_singular') }}</label>
                    <select name="supplier" id="supplier"
                        class="form-control select2 {{ $errors->has('supplier') ? 'is-invalid' : '' }}" required>
                        <option value="">Select</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('supplier'))
                        <div class="invalid-feedback">
                            {{ $errors->first('supplier') }}
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
            let supplier = $('body').find('#supplier').val();

            $('#fromDate_err').text('');
            $('#toDate_err').text('');
            if (fromDate != '' && toDate != '') {
                if (fromDate == toDate) {
                    $('#fromDate_err').text('Select Different Date');
                    $('#toDate_err').text('Select Different Date');
                }
                $.ajax({
                    url: '{{ route('admin.reports.purchase.getReport') }}',
                    method: 'POST',
                    datatype: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        fromDate: fromDate,
                        toDate: toDate,
                        supplier: supplier,
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
