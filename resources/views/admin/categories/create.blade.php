@extends('layouts.master')
@section('content')
<script src="{{ asset('assets/editor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/editor/sample.js') }}"></script>
    <script src="{{ asset('assets/editor/sample2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/editor/toolbarconfigurator/lib/codemirror/neo.css') }}">
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
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

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
        @if($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
    </div>
    <div class="form-group">
        <label class="required" for="description">{{ trans('cruds.category.fields.description') }}</label>
        <textarea
            class="form-control desc {{ $errors->has('description') ? 'is-invalid' : '' }}"
            name="description" id="description" required>{!!old('description')!!}</textarea>

        @if ($errors->has('description'))
            <span class="text-danger">
                {{ $errors->first('description') }}
            </span>
        @endif

    </div>
    <input type="hidden" name="parent_id" value="0">
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
