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
            {{ trans('global.create') }} {{ trans('cruds.processings.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.processings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="form-group" style="width: 98% !important;">
                    <label class="required" for="product">{{ trans('cruds.processings.fields.product') }}</label>
                    <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }} product" name="product"
                        id="product" required>
                        <option value="">Select</option>
                        @foreach ($purchases as $purchase)
                        <option value="{{ $purchase->id }}">{{ $purchase->purchase_code }}</option>
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
                        id="startdate" value="{{ old('startdate', '') }}" required>
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
                        id="enddate" value="{{ old('enddate', '') }}">
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
                        rows="4" required>{{ old('note', '') }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {!! $errors->first('note') !!}
                        </div>
                    @endif
                    <span id="note_err" class="text-danger"></span>
                    <span class="help-block">{{ trans('cruds.processings.fields.note_helper') }}</span>
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
                    <span class="help-block">{{ trans('cruds.processings.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.processings.fields.status') }}</label>
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
