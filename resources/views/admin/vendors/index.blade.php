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
            <a class="btn btn-success" href="{{ route('admin.vendors.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vendor.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card w-100">
    <div class="card-header">
        {{ trans('cruds.vendor.title_singular') }} {{ trans('global.list') }}
    </div>


    <div class="card-body w-100">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User w-100">
                <thead>
                    <tr>
                        <th width="">

                        </th>
                        <th>
                            {{ trans('cruds.vendor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.vendor.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.vendor.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.vendor.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.vendor.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.vendor.fields.destignation') }}
                        </th>
                        <th>
                            {{ trans('cruds.vendor.fields.status') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($vendors as $key => $vendor)
                        <tr data-entry-id="{{ $vendor->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $vendor->id ?? '' }}
                            </td>
                            <td>
                                {{ $vendor->name ?? '' }}
                            </td>
                            <td>
                                {{ $vendor->email ?? '' }}
                            </td>
                            <td>
                                {{ $vendor->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $vendor->address ?? '' }}
                            </td>
                            <td>
                                {{ $vendor->destignation ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $vendor->status ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vendor->status ? 'checked' : '' }}>

                            </td>

                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.vendors.show', $vendor->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.vendors.edit', $vendor->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_delete')
                                    <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
                {{ $vendors->links() }}
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
    url: "{{ route('admin.vendors.massDestroy') }}",
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
