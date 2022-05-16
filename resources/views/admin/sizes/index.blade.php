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

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sizes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.size.title_singular') }}
            </a>
        </div>
    </div>

<div class="card w-100">
    <div class="card-header">
        {{ trans('cruds.size.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body w-100">
        <div class="table-responsive">
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            {{ trans('cruds.size.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.size.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.size.fields.size_code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sizes as $key => $size)
                        <tr data-entry-id="{{ $size->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $size->id ?? '' }}
                            </td>
                            <td>
                                {{ $size->name ?? '' }}
                            </td>
                            <td>
                                {{ $size->size_code ?? '' }}
                            </td>
                            <td>
                                @can('size_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sizes.show', $size->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('size_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sizes.edit', $size->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('size_delete')
                                    <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>

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
