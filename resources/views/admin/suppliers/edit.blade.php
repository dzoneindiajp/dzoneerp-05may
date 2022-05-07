@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.supplier.title_singular') }}
        </div>

        <div class="card-body usersc">
            <form method="POST" action="{{ route('admin.suppliers.update', [$supplier->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group mr-3">
                    <label class="required" for="name">{{ trans('cruds.supplier.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $supplier->name) }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.supplier.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                        id="email" value="{{ old('email', $supplier->email) }}" required>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.email_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.supplier.fields.phone') }}</label><br>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="tel" name="phone"
                        id="phone" value="{{ old('phone', $supplier->phone) }}">
                    @if ($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.phone_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required" for="company">{{ trans('cruds.supplier.fields.company') }}</label>
                    <input class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text"
                        name="company" id="company" value="{{ old('company', $supplier->company_name) }}" required>
                    @if ($errors->has('company'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.company_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="destignation">{{ trans('cruds.supplier.fields.destignation') }}</label>
                    <input class="form-control {{ $errors->has('destignation') ? 'is-invalid' : '' }}" type="text"
                        name="destignation" id="destignation" value="{{ old('destignation', $supplier->destignation) }}"
                        required>
                    @if ($errors->has('destignation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('destignation') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.destignation_helper') }}</span>
                </div>

                <div class="form-group mr-3">
                    <label class="required" for="address">{{ trans('cruds.supplier.fields.address') }}</label><br>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address"
                        id="address" value="{{ old('address', '') }}"
                        required> {{ $supplier->address }} </textarea>

                    @if ($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.address_helper') }}</span>
                </div>

                <input type="hidden" id="user_id" name="user_id" value="{{ $supplier->user_id }}">

                <div class="form-group">
                    <label class="required"
                        for="profile_picture">{{ trans('cruds.supplier.fields.profile_picture') }}</label><br>
                    {{-- <input class="form-control {{ $errors->has('profile_picture') ? 'is-invalid' : '' }}" type="file" name="profile_picture"
                    id="profile_picture" value="{{ old('profile_picture', '') }}" required> --}}
                    <div class="custom-file">
                        <input type="file" id="profile_picture" name="profile_picture"
                            class="custom-file-input {{ $errors->has('profile_picture') ? 'is-invalid' : '' }}"
                            value="{{ old('profile_picture', '') }}"
                            {{ isset($supplier->profile_picture) ? 'required' : '' }}>

                        <label class="custom-file-label" for="profile_picture">Choose Image</label>
                    </div>
                    @if ($errors->has('profile_picture'))
                        <div class="invalid-feedback">
                            {{ $errors->first('profile_picture') }}
                        </div>
                    @endif
                    <input type="hidden" id="old_profile_picture" name="old_profile_picture" value="{{ $supplier->profile_picture }}">
                            <span class="help-block">{{ trans('cruds.supplier.fields.profile_picture_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.supplier.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value="1" @if ($supplier->status == 1) selected @endif>Active</option>
                        <option value="0" @if ($supplier->status == 0) selected @endif>In-Active</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.status_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="profile_picture">{{ trans('Old') }}
                        {{ trans('cruds.supplier.fields.profile_picture') }}</label><br>
                    @if ($supplier->profile_image != null && file_exists(storage_path('app/supplier/' . $supplier->profile_image)))
                        <img src="{{ storage_path('app/supplier/1651816236.png') }}" style="width:50px;height:50px;border-radius:10px;">
                    @endif
                </div>


                <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.supplier.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" minlength="8" type="password" name="password" id="password">
                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.password_helper') }}</span>
            </div>

                <div class="form-group save_btn">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script>
        var phone_number = window.intlTelInput(document.querySelector("#phone"), {
            separateDialCode: true,
            preferredCountries: ["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });

        $("form").submit(function() {
            var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
            $("input[name='phone_number[full]'").val(full_number);
            //   alert(full_number)

        });
    </script>
@endsection
