@extends('layouts.master')
@section('content')
    <style>
        table.dataTable {
            width: 100%;
            margin: 0;
            margin-top: 0px;
            margin-bottom: 0px;
            clear: both;
            border-collapse: separate;
            border-spacing: 0;
        }

    </style>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.purchases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.purchase.title_singular') }}
            </a>
        </div>
    </div>

    <div class="card w-100">
        <div class="card-header">
            {{ trans('cruds.purchase.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body w-100">
            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>

                            <th>
                                {{ trans('cruds.purchase.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.purchase.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.purchase.fields.usertype') }}
                            </th>
                            <th>
                                {{ trans('cruds.purchase.fields.qty') }}
                            </th>
                            <th>
                                {{ trans('cruds.purchase.fields.grandtotal') }}
                            </th>
                            <th>
                                {{ trans('cruds.purchase.fields.note') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($purchases as $c)
                            <tr>
                                <td>
                                    {{ ++$i }}
                                </td>
                                <td>
                                    {{ $c->purchase_date }}
                                </td>
                                <td>
                                    @if ($c->user_type == 0)
                                        Supplier
                                        @else
                                        Vendor
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $qty = 0;
                                    @endphp

                                    @foreach (json_decode($c->product_qty, true) as $prod)
                                        @php $qty = $qty + $prod @endphp
                                    @endforeach
                                    {{ $qty }}
                                </td>
                                <td>
                                    {{ $c->grand_total }}
                                </td>
                                <td>
                                    {{ $c->purchase_note }}
                                </td>

                                <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.purchases.show', $c->id) }}">
                                        {{ trans('global.view') }}
                                    </a>



                                    <a class="btn btn-xs btn-info" href="{{ route('admin.purchases.edit', $c->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.purchases.destroy', $c->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>


                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print',
                {
                    extend: 'copy',
                    exportOptions: {
                        'columns': ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        'columns': ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        'columns': ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        'columns': ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        'columns': ':visible:not(:last-child)'
                    }
                },
            ],
        });
    });
</script>
