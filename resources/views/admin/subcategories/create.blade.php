@extends('layouts.master')
@section('content')
<script src="{{ asset('assets/editor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/editor/sample.js') }}"></script>
    <script src="{{ asset('assets/editor/sample2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/editor/toolbarconfigurator/lib/codemirror/neo.css') }}">
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.subcategory.title_singular') }}
    </div>

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

<form action="{{ route('admin.subcategory.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="required" for="name">{{ trans('cruds.subcategory.fields.name') }}</label>
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
        @if($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
    </div>

    <div class="form-group">
        <label class="required" for="parent_id">{{ trans('cruds.subcategory.fields.category') }}</label><br>
         <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id"  required>
            @foreach($cat as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
        @if($errors->has('parent_id'))
        <div class="invalid-feedback">
            {{ $errors->first('parent_id') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.subcategory.fields.category_helper') }}</span>
    </div>
    <div class="form-group">
        <label class="required" for="description">{{ trans('cruds.subcategory.fields.description') }}</label>
        <textarea
            class="form-control desc {{ $errors->has('description') ? 'is-invalid' : '' }}"
            name="description" id="description" required>{!!old('description')!!}</textarea>

        @if ($errors->has('description'))
            <span class="text-danger">
                {{ $errors->first('description') }}
            </span>
        @endif

    </div>
    <div class="form-group">
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
<script type="text/javascript">

    CKEDITOR.replace( 'description' );
    CKEDITOR.add

    CKEDITOR.replace( 'return' );
    CKEDITOR.add
</script>
</div>
@endsection
