@extends('layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.staffs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.staff.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card w-100">
    <div class="card-header">
        {{ trans('cruds.staff.title_singular') }} {{ trans('global.list') }}
    </div>


    <div class="card-body w-100">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User w-100">
                <thead>
                    <tr>
                        <th width="">

                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.destignation') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.status') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($staffs as $key => $supplier)
                        <tr data-entry-id="{{ $supplier->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $supplier->id ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->name ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->email ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->address ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->destignation ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $supplier->status ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $supplier->status ? 'checked' : '' }}>

                            </td>

                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.staffs.show', $supplier->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.staffs.edit', $supplier->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_delete')
                                    <form action="{{ route('admin.staffs.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
                {{ $staffs->links() }}
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.staffs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          method: 'POST',
          url: config.url,
          data: {
            "_token": "{{ csrf_token() }}",
              ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
