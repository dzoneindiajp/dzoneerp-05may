@extends('layouts.master')
@section('content')



    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
        </div>

        <div class="card-body usersc" style="background: transparent;">
            <form action="#" onsubmit="false">
                @csrf
                <div class="form-group">
                    <label class="required" for="catid">{{ trans('cruds.product.fields.category') }}</label>
                    <select disabled name="catid" id="catid" class="form-control {{ $errors->has('catid') ? 'is-invalid' : '' }}"
                        required>
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $product->catid) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                </div enctype="multipart/form-data">

                <div class="form-group">
                    <label class="required" for="subcatid">{{ trans('cruds.product.fields.subcategory') }}</label>
                    <select disabled name="subcatid" id="subcatid"
                        class="form-control {{ $errors->has('subcatid') ? 'is-invalid' : '' }}" required>
                        <option value="">Select</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" @if ($subcategory->id == $product->subcatid) selected @endif>
                                {{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ trans('cruds.product.fields.subcategory_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                    <input readonly class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $product->product_name) }}" required>

                    <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="unitid">{{ trans('cruds.product.fields.unit') }}</label>
                    <select disabled name="unitid" id="unitid"
                        class="form-control {{ $errors->has('unitid') ? 'is-invalid' : '' }}" required>
                        <option value="">Select</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" @if ($unit->id == $product->unitid) selected @endif>
                                {{ $unit->name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required" for="image">{{ trans('cruds.product.fields.image') }}</label><br>
                    {{-- @if ($product->productimage != null && file_exists(storage_path('app/product/' . $product->productimage)))
                        <img src="{{ asset('storage/app/product/' . $product->productimage) }}" alt="No image">
                    @endif --}}
                    @if ($product->productimage != null && file_exists(public_path('app/product/' . $product->productimage)))
                        <img src="{{ asset('public/app/product/' . $product->productimage) }}" alt="No image" height="100" width="140">
                    @endif
                </div>

                <div class="form-group">
                    <label class="required"
                        for="isfinishedproduct">{{ trans('cruds.product.fields.isfinishedproduct') }}</label><br>
                    <input type="radio" name="isfinishedproduct" value="0" @if($product->isfinishedproduct == 0) checked @endif> No
                    <input type="radio" name="isfinishedproduct" value="1" @if($product->isfinishedproduct == 1) checked @endif> Yes
                    <span class="help-block">{{ trans('cruds.product.fields.isfinishedproduct_helper') }}</span>
                </div>


                <div class="form-group save_btn">
                    <a class="btn btn-danger" href="{{ url()->previous() }}">
                        {{ trans('Back') }}
                    </a>
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
