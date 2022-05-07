@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.supplier.title_singular') }}
        </div>

        <div class="card-body usersc">
            <form method="POST" action="{{ route('admin.suppliers.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mr-3">
                    <label class="required" for="name">{{ trans('cruds.supplier.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', '') }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.name_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.supplier.fields.email') }} </label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                        id="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.email_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.supplier.fields.phone') }}</label><br>
                    <input type="hidden" id="country" name="country" />
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="tel" name="phone"
                        id="phone" value="{{ old('phone', '') }}">
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
                        name="company" id="company" value="{{ old('company', '') }}" required>
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
                        name="destignation" id="destignation" value="{{ old('destignation', '') }}" required>
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
                        id="address" required>{{ old('address', '') }}</textarea>

                    @if ($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.address_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="profile_picture">{{ trans('cruds.supplier.fields.profile_picture') }}</label><br>
                    {{-- <input class="form-control {{ $errors->has('profile_picture') ? 'is-invalid' : '' }}" type="file" name="profile_picture"
                        id="profile_picture" value="{{ old('profile_picture', '') }}" required> --}}
                    <div class="custom-file">
                        <input type="file" id="profile_picture" name="profile_picture"
                            class="custom-file-input {{ $errors->has('profile_picture') ? 'is-invalid' : '' }}"
                            value="{{ old('profile_picture', '') }}" required>
                        <label class="custom-file-label" for="profile_picture">Choose Image</label>
                    </div>
                    @if ($errors->has('profile_picture'))
                        <div class="invalid-feedback">
                            {{ $errors->first('profile_picture') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.profile_picture_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.supplier.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status"  required>
                        <option value="1" {{ old('status', '') ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', '') ? 'selected' : '' }}>In-Active</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.supplier.fields.status_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="password">{{ trans('cruds.supplier.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" minlength="8" type="password"
                        name="password" id="password" required>
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

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
