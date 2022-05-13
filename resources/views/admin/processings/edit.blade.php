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
            {{ trans('global.edit') }} {{ trans('cruds.processings.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.processings.update',$processing->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group" style="width: 98% !important;">
                    <label class="required" for="product">{{ trans('cruds.processings.fields.product') }}</label>
                    <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }} product" name="product"
                        id="product" required>
                        <option value="">Select</option>
                        @foreach ($purchases as $purchase)
                        <option value="{{ $purchase->id }}" @if($purchase->id == $processing->purchase_id) selected @endif>{{ $purchase->purchase_code }}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('product'))
                        <div class="invalid-feedback">
                            {{ $errors->first('product') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.processings.fields.product_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="startdate">{{ trans('cruds.processings.fields.startdate') }}</label>
                    <input class="form-control {{ $errors->has('startdate') ? 'is-invalid' : '' }}" type="date" name="startdate"
                        id="startdate" value="{{ old('startdate', $processing->start_date) }}" required>
                    @if ($errors->has('startdate'))
                        <div class="invalid-feedback">
                            {!! $errors->first('startdate') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.processings.fields.startdate_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="enddate">{{ trans('cruds.processings.fields.enddate') }}</label>
                    <input class="form-control {{ $errors->has('enddate') ? 'is-invalid' : '' }}" type="date" name="enddate"
                        id="enddate" value="{{ old('enddate', (isset($processing->end_date)) ? $processing->end_date : '' ) }}">
                    @if ($errors->has('enddate'))
                        <div class="invalid-feedback">
                            {!! $errors->first('enddate') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.processings.fields.enddate_helper') }}</span>
                </div>

                <div class="form-group w-100">
                    <label class="required" for="note">{{ trans('cruds.processings.fields.note') }}</label>
                    <textarea name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}"
                        rows="4" required>{{ old('note', $processing->processing_note) }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {!! $errors->first('note') !!}
                        </div>
                    @endif
                    <span id="note_err" class="text-danger"></span>
                    <span class="help-block">{{ trans('cruds.processings.fields.note_helper') }}</span>
                </div>

                <div class="form-group w-100">
                    <label class="required" for="old_image">{{ trans('Old') }}
                        {{ trans('cruds.processings.fields.image') }}</label><br>
                    @if ($processing->processing_image != null && file_exists(public_path('app/processing/' . $processing->processing_image)))
                        <img src="{{ asset('app/processing/' . $processing->processing_image) }}" alt="No image" height="100" width="140">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="image">{{ trans('cruds.processings.fields.image') }}</label><br>
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
                    <input type="hidden" value="{{ $processing->processing_image }}" name="old_image">
                    <span class="help-block">{{ trans('cruds.processings.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.processings.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value="1" @if($processing->status == 1) selected @endif>Active</option>
                        <option value="0" @if($processing->status == 0) selected @endif>In-Active</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.processings.fields.status_helper') }}</span>
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
            let date = $('body').find('#startdate').val();
            $('body').find('#enddate').attr('min',date);
        });

        $('body').on('change','#startdate',function(){
            let date = $(this).val();
            $('body').find('#enddate').attr('min',date).val('');

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
