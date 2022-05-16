    <div class="card col-md-12 mt-5">
        <div class="card-header">
            <div class="card-tools w-25 float-right">
                <a href="{{ route('admin.purchases.create') }}" class="btn btn-block btn-primary">
                    Add Purchase <i class="fas fa-plus-circle"></i>
                </a>
            </div>
            <h3 class="card-title">
                Purchases For: {{ $res['from'] }} To {{ $res['to'] }}
            </h3>
        </div>
        <div class="card-body p-0 table-responsive min-height-150">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Purchase Code</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Subtotal</th>
                        <th>Discount</th>
                        <th>Trasnport</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $i = 0;
                    @endphp

                    @foreach ($purchases as $c)
                        @php
                            if (isset($c)) {
                                $user_id = $c->user_id;
                                if ($c->user_type == 1) {
                                    $user = \App\Models\Vendor::where('id', $c->user_id)->pluck('name')[0];
                                } else {
                                    $user = \App\Models\Supplier::where('id', $c->user_id)->pluck('name')[0];
                                }
                            } else {
                                $user = [];
                            }
                        @endphp
                        <tr>
                            <td>
                                {{ ++$i }}
                            </td>
                            <td>
                                {{ $c->purchase_code }}
                            </td>
                            <td>
                                {{ date('d-M-Y', strtotime($c->purchase_date)) }}
                            </td>
                            <td>
                                {{ $user }}
                            </td>
                            <td>
                                ${{ $c->subtotal }}
                            </td>
                            <td>
                                ${{ $c->total_discount }}
                            </td>
                            <td>
                                ${{ $c->transport_cost }}
                            </td>
                            <td>
                                ${{ $c->grand_total }}
                            </td>
                            <td>
                                $00
                            </td>
                            <td>
                                $00
                            </td>
                            <td>
                                @if ($c->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">In-Active</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.purchases.show', $c->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
