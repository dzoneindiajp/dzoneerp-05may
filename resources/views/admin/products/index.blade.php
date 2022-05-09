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
            <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
            </a>
        </div>
    </div>

    <div class="card w-100">
        <div class="card-header">
            {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body w-100">
            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>

                            <th>
                                {{ trans('cruds.product.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.category') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.subcategory') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.unit') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.isfinishedproduct') }}
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
                        @foreach ($products as $c)
                            <tr>
                                <td>
                                    {{ ++$i }}
                                </td>
                                <td>
                                    {{ $c->category->name }}
                                </td>
                                <td>
                                    {{ $c->subcategory->name }}
                                </td>
                                <td>
                                    {{ $c->product_name }}
                                </td>
                                <td>
                                    {{ $c->unit->name }}
                                </td>
                                <td>
                                    @if ($c->isfinishedproduct == 0)
                                        <label class="badge badge-info"> NO </label>
                                    @else
                                        <label class="badge badge-primary"> YES </label>
                                    @endif
                                </td>

                                <td>

                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.products.show', $c->id) }}">
                                        {{ trans('global.view') }}
                                    </a>



                                    <a class="btn btn-xs btn-info" href="{{ route('admin.products.edit', $c->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $c->id) }}" method="POST"
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
                'copy', 'csv', 'excel', 'pdf', 'print',
            ]
        });
    });
</script>
