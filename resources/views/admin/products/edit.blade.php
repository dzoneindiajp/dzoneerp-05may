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
            {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="{{ route('admin.products.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="catid">{{ trans('cruds.product.fields.category') }}</label>
                    <select name="catid" id="catid" class="form-control {{ $errors->has('catid') ? 'is-invalid' : '' }}"
                        required>
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $product->catid) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('catid'))
                        <div class="invalid-feedback">
                            {{ $errors->first('catid') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                </div enctype="multipart/form-data">

                <div class="form-group">
                    <label class="required" for="subcatid">{{ trans('cruds.product.fields.subcategory') }}</label>
                    <select name="subcatid" id="subcatid"
                        class="form-control {{ $errors->has('subcatid') ? 'is-invalid' : '' }}" required>
                        <option value="">Select</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" @if ($subcategory->id == $product->subcatid) selected @endif>
                                {{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('subcatid'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subcatid') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.subcategory_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $product->product_name) }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="unitid">{{ trans('cruds.product.fields.unit') }}</label>
                    <select name="unitid" id="unitid"
                        class="form-control {{ $errors->has('unitid') ? 'is-invalid' : '' }}" required>
                        <option value="">Select</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" @if ($unit->id == $product->unitid) selected @endif>
                                {{ $unit->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('unitid'))
                        <div class="invalid-feedback">
                            {{ $errors->first('unitid') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>



                <div class="form-group">
                    <label class="required" for="image">{{ trans('cruds.product.fields.image') }}</label><br>
                    <div class="custom-file">
                        <input type="file" id="image" name="image"
                            class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                            value="{{ old('image', '') }}" {{ isset($product->image) ? 'required' : '' }}>
                        <label class="custom-file-label" for="image">Choose Image</label>
                    </div>
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.image_helper') }}</span>
                    <input type="hidden" name="old_productimage" value="{{ $product->productimage }}">
                </div>


                <div class="form-group">
                    <label class="required" for="image">{{ trans('Old') }}
                        {{ trans('cruds.product.fields.image') }}</label><br>
                    {{-- @if ($product->productimage != null && file_exists(storage_path('app/product/' . $product->productimage)))
                        <img src="{{ asset('storage/app/product/' . $product->productimage) }}" alt="No image">
                        @endif --}}
                    @if ($product->productimage != null && file_exists(public_path('app/product/' . $product->productimage)))
                        <img src="{{ asset('app/product/' . $product->productimage) }}" alt="No image" height="100" width="140">
                        @endif

                </div>

                <div class="form-group">
                    <label class="required"
                        for="isfinishedproduct">{{ trans('cruds.product.fields.isfinishedproduct') }}</label><br>
                    <input type="radio" name="isfinishedproduct" value="0" @if($product->isfinishedproduct == 0) checked @endif> No
                    <input type="radio" name="isfinishedproduct" value="1" @if($product->isfinishedproduct == 1) checked @endif> Yes
                    @if ($errors->has('isfinishedproduct'))
                        <div class="invalid-feedback">
                            {{ $errors->first('isfinishedproduct') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.isfinishedproduct_helper') }}</span>
                </div>



                <div class="form-group save_btn">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>

    </div>
    <script type="text/javascript">
        $('body').on('change', '#catid', function(e) {
            var categoryId = $('body').find('#catid').val();
            if (categoryId != '') {
                $("#subcatid").val('').trigger('change').prop('disabled', true);
                $.ajax({
                    url: "{{ url('admin/products/getsubCategory') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        catid: categoryId,
                    },
                    success: function(res) {
                        if (res[0]) {
                            $("#subcatid").val('').trigger('change');
                            $("#subcatid").html('<option value="">Select</option>');
                            $.each(res[1], function(key, value) {
                                $("#subcatid").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            $("#subcatid").prop('disabled', false);
                        } else {

                        }
                    }
                });
            } else {
                $('#subcatid').val('').trigger('change').html('<option value=""></option>');
                $("#subcatid").prop('disabled', false);
            }
        });
    </script>
@endsection
