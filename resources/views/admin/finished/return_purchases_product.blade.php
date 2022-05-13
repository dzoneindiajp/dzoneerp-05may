@if ($res[0])

    @php
        $processings = $res[1];
    @endphp
    <div class="form-group w-100 m-2  table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="25%">{{ trans('cruds.finished.fields.product') }}</th>
                    <th width="20%">{{ trans('cruds.finished.fields.purchaseqty') }}</th>
                    <th width="20%">{{ trans('cruds.finished.fields.availableqty') }}</th>
                    <th>{{ trans('cruds.finished.fields.usedqty') }}</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($purchase->product_id))
                    @for ($i = 0; $i < count(json_decode($purchase->product_id)); $i++)
                        @php
                            $return_qty = isset($returnPurchase) ? json_decode($returnPurchase->returnqty)[$i] : 00;
                            $damage_qty = isset($damagePurchase) ? json_decode($damagePurchase->damageqty)[$i] : 00;
                            $product_qty  = json_decode($purchase->product_qty, true)[$i];
                            $available_qty = $product_qty - $return_qty - $damage_qty;
                            $unit_name = '';

                            if (isset($units)) {
                                foreach ($units as $unit) {
                                    if ($unit->id == json_decode($purchase->unit_id, true)[$i]) {
                                        $unit_name = $unit->name;
                                    }
                                }
                            }
                        @endphp

                        <input type="hidden" name="minDate" id="minDate" value="{{ $purchase->purchase_date }}">
                        <input type="hidden" name="product_qty[]" id="product_qty" value="{{ $product_qty }}">
                        <input type="hidden" name="available_qty[]" id="available_qty" value="{{ $available_qty }}">
                        <input type="hidden" name="unit_name[]" id="unit_name" value="{{ $unit_name }}">
                        <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">
                        <tr class="productlist">
                            <td>
                                @foreach ($products as $product)
                                    @if ($product->id == json_decode($purchase->product_id)[$i])
                                        <input readonly
                                            class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }} product_name"
                                            type="text" min="0" max="9999" name="product_name[]"
                                            value="{{ $product->product_name }}">
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                <input readonly
                                    class="form-control {{ $errors->has('productqty') ? 'is-invalid' : '' }} productqty"
                                    type="text" min="0" max="9999" name="productqty[]"
                                    value="{{ $product_qty . ' ' . $unit_name }}">
                            </td>
                            <td>
                                <input readonly
                                    class="form-control {{ $errors->has('availableqty') ? 'is-invalid' : '' }} availableqty"
                                    type="text" min="0" max="9999" name="availableqty[]"
                                    value="{{ $available_qty . ' ' . $unit_name }}">
                            </td>


                            <td>
                                <input class="form-control {{ $errors->has('used_qty') ? 'is-invalid' : '' }} used_qty"
                                    type="number" name="used_qty[]"
                                    value="{{ (isset($finished)) ? old('used_qty', json_decode($finished->used_qty, true)[$i]) : old('used_qty','') }}"
                                    min="0" max="{{ $available_qty }}" required>
                                @if ($errors->has('used_qty'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('used_qty') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finished.fields.usedqty_helper') }}</span>
                            </td>
                        </tr>
                    @endfor
                @endif

            </tbody>
        </table>
    </div>

@endif
