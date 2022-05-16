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
            {{ trans('global.edit') }} {{ trans('cruds.finished.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.finished.update',$finished->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf


                <div class="form-group" style="width: 98% !important;">
                    <label class="required" for="processing">{{ trans('cruds.finished.fields.processing') }}</label>
                    <select class="form-control select2 {{ $errors->has('processing') ? 'is-invalid' : '' }} processing" name="processing"
                        id="processing" required>
                        <option value="">Select</option>
                        @foreach ($processings as $processing)
                        <option value="{{ $processing->id }}" @if($processing->id == $finished->processing_id) selected @endif>{{ $processing->processing_code }}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('processing'))
                        <div class="invalid-feedback">
                            {{ $errors->first('processing') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.finished.fields.processing_helper') }}</span>
                </div>

                <div id="productTable"></div>

                <div class="form-group w-100">
                    <label class="required" for="note">{{ trans('cruds.finished.fields.note') }}</label>
                    <textarea name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}"
                        rows="4" required>{{ old('note', $finished->finished_note) }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {!! $errors->first('note') !!}
                        </div>
                    @endif
                    <span id="note_err" class="text-danger"></span>
                    <span class="help-block">{{ trans('cruds.finished.fields.note_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.finished.fields.date') }}</label>
                    <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date"
                        id="date" value="{{ old('date', $finished->finished_date) }}" required>
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {!! $errors->first('date') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.finished.fields.date_helper') }}</span>
                </div>

                <div class="form-group w-100">
                    <label class="required" for="old_image">{{ trans('Old') }}
                        {{ trans('cruds.finished.fields.image') }}</label><br>
                    @if ($finished->finished_image != null && file_exists(public_path('app/finished/' . $finished->finished_image)))
                        <img src="{{ asset('public/app/finished/' . $finished->finished_image) }}" alt="No image" height="100" width="140">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="image">{{ trans('cruds.finished.fields.image') }}</label><br>
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
                    <input type="hidden" name="old_image" id="old_image" value="{{ $finished->finished_image }}">
                    <span class="help-block">{{ trans('cruds.finished.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.finished.fields.status') }}</label>
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
                    <span class="help-block">{{ trans('cruds.finished.fields.status_helper') }}</span>
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

        $(document).ready(function(){
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
                        $('body').find(':input[type="date"]').attr('min',minDate);
                    }
                });
            } else {
                $('#userid').val('').trigger('change').html('<option value=""></option>');
                $("#userid").prop('disabled', false);
            }
        });

        $('body').on('change', '.processing', function(e) {
            var processing_id = $(this).val();

            if (processing_id != '') {
                $("#userid").val('').trigger('change').prop('disabled', true);
                $.ajax({
                    url: "{{ url('admin/finished/getProcessing') }}",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        processing_id: processing_id,
                        finished_qty: 0,
                    },
                    success: function(res) {
                        $('body').find('#productTable').html(res);
                        let minDate = $('body').find('#minDate').val();
                        $('body').find(':input[type="date"]').attr('min',minDate);
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
