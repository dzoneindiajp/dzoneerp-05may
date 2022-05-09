@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.units.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.units.update", [$unit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.units.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $unit->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.units.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit_code">{{ trans('cruds.units.fields.unit_code') }}</label>
                <input class="form-control {{ $errors->has('unit_code') ? 'is-invalid' : '' }}" type="text" name="unit_code" id="unit_code" value="{{ old('unit_code', $unit->unit_code) }}" required>
                @if($errors->has('unit_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.units.fields.unit_code_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
