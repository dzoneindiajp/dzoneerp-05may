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
            {{ trans('global.edit') }} {{ trans('cruds.showrooms.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.showrooms.update',$showroom->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.showrooms.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $showroom->name) }}" required>
                    <input type="hidden" name="id" id="id" value="{{ old('id', $showroom->id) }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {!! $errors->first('name') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.showrooms.fields.name_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="code">{{ trans('cruds.showrooms.fields.code') }}</label>
                    <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code"
                        id="code" value="{{ old('code', $showroom->code) }}">
                    @if ($errors->has('code'))
                        <div class="invalid-feedback">
                            {!! $errors->first('code') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.showrooms.fields.code_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="manager_name">{{ trans('cruds.showrooms.fields.manager_name') }}</label>
                    <input class="form-control {{ $errors->has('manager_name') ? 'is-invalid' : '' }}" type="text" name="manager_name"
                        id="manager_name" value="{{ old('manager_name', $showroom->manager_name) }}" required>
                    @if ($errors->has('manager_name'))
                        <div class="invalid-feedback">
                            {!! $errors->first('manager_name') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.showrooms.fields.manager_name_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.showrooms.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                        id="email" value="{{ old('email', $showroom->email) }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {!! $errors->first('email') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.showrooms.fields.email_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.showrooms.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone"
                        id="phone" value="{{ old('phone',  $showroom->phone) }}">
                    @if ($errors->has('phone'))
                        <div class="invalid-feedback">
                            {!! $errors->first('phone') !!}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.showrooms.fields.phone_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.showrooms.fields.status') }}</label>
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
                    <span class="help-block">{{ trans('cruds.showrooms.fields.status_helper') }}</span>
                </div>

                <div class="form-group w-100">
                    <label class="required" for="address">{{ trans('cruds.showrooms.fields.address') }}</label>
                    <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                        rows="4" required>{{ old('address',  $showroom->address) }}</textarea>
                    @if ($errors->has('address'))
                        <div class="invalid-feedback">
                            {!! $errors->first('address') !!}
                        </div>
                    @endif
                    <span id="address_err" class="text-danger"></span>
                    <span class="help-block">{{ trans('cruds.showrooms.fields.address_helper') }}</span>
                </div>

                <div class="form-group w-100">
                    <label class="required" for="note">{{ trans('cruds.showrooms.fields.note') }}</label>
                    <textarea name="note" id="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}"
                        rows="4" required>{{ old('note', $showroom->note) }}</textarea>
                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {!! $errors->first('note') !!}
                        </div>
                    @endif
                    <span id="note_err" class="text-danger"></span>
                    <span class="help-block">{{ trans('cruds.showrooms.fields.note_helper') }}</span>
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
