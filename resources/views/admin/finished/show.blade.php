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
                        <img src="{{ asset('app/finished/' . $finished->finished_image) }}" alt="No image" height="100"
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
    </script>
@endsection
