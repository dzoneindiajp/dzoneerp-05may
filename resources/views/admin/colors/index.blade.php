@extends('layouts.master')
@section('content')
<style>
    table.dataTable {
width: 100%;
margin: 0 ;
margin-top: 0px;
margin-bottom: 0px;
clear: both;
border-collapse: separate;
border-spacing: 0;
}
</style>
{{-- @can('color_create') --}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.colors.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.color.title_singular') }}
            </a>
        </div>
    </div>
{{-- @endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.color.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.color.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.color.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.color.fields.color_code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colors as $key => $color)
                        <tr data-entry-id="{{ $color->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $color->id ?? '' }}
                            </td>
                            <td>
                                {{ $color->name ?? '' }}
                            </td>
                            <td>
                                {{ $color->color_code ?? '' }}
                            </td>
                            <td>
                                @can('color_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.colors.show', $color->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('color_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.colors.edit', $color->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('color_delete')
                                    <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
        ]
    } );
} );
</script>
