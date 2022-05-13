@if ($res[0])

    @php
        $purchase = $res[1];
    @endphp
    <div class="form-group w-100 m-2  table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="20%">{{ trans('cruds.returnpurchases.fields.product') }}</th>
                    <th width="20%">{{ trans('cruds.returnpurchases.fields.qty') }}</th>
                    <th width="20%">{{ trans('cruds.returnpurchases.fields.unit') }}</th>
                    <th width="15%">{{ trans('cruds.returnpurchases.fields.unitprice') }}</th>
                    <th>{{ trans('cruds.returnpurchases.fields.returnqty') }}</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count(json_decode($purchase->product_id, true)); $i++)
                <input type="hidden" name="minDate" id="minDate" value="{{ $purchase->purchase_date }}">
                    <tr class="productlist">
                        <td>
                            @foreach ($products as $product)
                                @if ($product->id == json_decode($purchase->product_id, true)[$i])
                                    <input readonly
                                        class="form-control {{ $errors->has('product') ? 'is-invalid' : '' }} product"
                                        type="text" min="0" max="9999" name="product[]"
                                        value="{{ $product->product_name }}">
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach ($units as $unit)
                                @if ($unit->id == json_decode($purchase->unit_id, true)[$i])
                                    <input readonly
                                        class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }} qty"
                                        type="text" min="0" max="9999" name="qty[]"
                                        value="{{ json_decode($purchase->product_qty, true)[$i] . ' ' . $unit->name }}">
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach ($units as $unit)
                                @if ($unit->id == json_decode($purchase->unit_id, true)[$i])
                                    <input readonly
                                        class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }} unit"
                                        type="text" min="0" max="9999" name="unit[]"
                                        value="{{ (isset($return)) ? (json_decode($purchase->product_qty, true)[$i] - json_decode($return->returnqty, true)[$i]) . ' ' . $unit->name   : json_decode($purchase->product_qty, true)[$i] . ' ' . $unit->name }}">
                                @endif

                            @endforeach
                        </td>

                        <td>
                            <input readonly
                                class="form-control {{ $errors->has('unitprice') ? 'is-invalid' : '' }} unitprice"
                                type="number" name="unitprice[]"
                                value="{{ old('unitprice', json_decode($purchase->unit_price, true)[$i]) }}" min="0"
                                max="99999">
                            @if ($errors->has('unitprice'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unitprice') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.returnpurchases.fields.unitprice_helper') }}</span>
                        </td>

                        <td>
                            <input class="form-control {{ $errors->has('returnqty') ? 'is-invalid' : '' }} returnqty"
                                type="number" name="returnqty[]" value="{{ (isset($return)) ? old('returnqty', json_decode($return->returnqty, true)[$i]) : old('returnqty', '') }}" min="0"
                                max="{{ json_decode($purchase->product_qty, true)[$i] }}" required>
                            @if ($errors->has('returnqty'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('returnqty') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.returnpurchases.fields.returnqty_helper') }}</span>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

@endif
