@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.staff.title_singular') }}
        </div>

        <div class="card-body usersc">
            <form onsubmit="false">
                <div class="form-group mr-3">
                    <label class="required" for="name">{{ trans('cruds.staff.fields.name') }}</label>
                    <input readonly class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $staff->name) }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.staff.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.staff.fields.email') }}</label>
                    <input readonly class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                        id="email" value="{{ old('email', $staff->email) }}" required>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.staff.fields.email_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.staff.fields.phone') }}</label><br>
                    <input readonly class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="tel" name="phone"
                        id="phone" value="{{ old('phone', $staff->phone) }}">
                    @if ($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.staff.fields.phone_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required" for="company">{{ trans('cruds.staff.fields.company') }}</label>
                    <input readonly class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text"
                        name="company" id="company" value="{{ old('company', $staff->company_name) }}" required>
                    @if ($errors->has('company'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.staff.fields.company_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="destignation">{{ trans('cruds.staff.fields.destignation') }}</label>
                    <input readonly class="form-control {{ $errors->has('destignation') ? 'is-invalid' : '' }}" type="text"
                        name="destignation" id="destignation" value="{{ old('destignation', $staff->destignation) }}"
                        required>
                    @if ($errors->has('destignation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('destignation') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.staff.fields.destignation_helper') }}</span>
                </div>

                <div class="form-group mr-3">
                    <label class="required" for="address">{{ trans('cruds.staff.fields.address') }}</label><br>
                    <textarea class="form-control disabled {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" disabled
                        id="address" value="{{ old('address', '') }}"
                        required> {{ $staff->address }} </textarea>

                    @if ($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.staff.fields.address_helper') }}</span>
                </div>

                <input type="hidden" id="user_id" name="user_id" value="{{ $staff->user_id }}">

                <div class="form-group">
                    <label class="required" for="profile_picture">{{ trans('Old') }}
                        {{ trans('cruds.staff.fields.profile_picture') }}</label><br>
                    {{-- @if ($staff->profile_image != null && file_exists(storage_path('app/staff/' . $staff->profile_image)))
                        <img src="{{ URL::asset('storage/app/staff/' . $staff->profile_image) }}" alt="No image">
                    @endif --}}
                    @if ($staff->profile_image != null && file_exists(public_path('app/staff/' . $staff->profile_image)))
                        <img src="{{ asset('public/app/staff/' . $staff->profile_image) }}" alt="No image" height="100" width="140">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="status">{{ trans('cruds.staff.fields.status') }}</label>
                    <input readonly class="form-control {{ $errors->has('destignation') ? 'is-invalid' : '' }}" type="text"
                    name="destignation" id="destignation" value="@if ($staff->status == 1) Active @endif @if ($staff->status == 0) In-Active @endif"
                    required>


                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.staff.fields.status_helper') }}</span>
                </div>



                {{-- <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.staff.fields.password') }}</label>
                <input readonly class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staff.fields.password_helper') }}</span>
            </div> --}}

            <div class="form-group save_btn">
                <a class="btn btn-danger" href="{{ url()->previous() }}">
                    {{ trans('Back') }}
                </a>
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
