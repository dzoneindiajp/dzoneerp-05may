@if(count($purchases) > 0)
<div class="card col-md-12 mt-5">
        <div class="card-header">
            <div class="card-tools w-25 float-right">
                <a href="{{ route('admin.processings.create') }}" class="btn btn-block btn-primary">
                    Add Procesing Product <i class="fas fa-plus-circle"></i>
                </a>
            </div>
            <h4 class="card-title">
                {{ trans('cruds.processings.title_singular') }} For: {{ $res['from'] }} To {{ $res['to'] }}
            </h4>
        </div>
        <div class="card-body p-0 table-responsive min-height-150">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Purchase Code</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
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
                                {{ $c->purchase->purchase_code }}
                            </td>
                            <td>
                                {{ date('d-M-Y', strtotime($c->start_date)) }}
                            </td>
                            <td>
                                {{ date('d-M-Y', strtotime($c->end_date)) }}
                            </td>
                            <td>
                                @if ($c->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">In-Active</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.processings.show', $c->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="col-md-12 mt-5">

        <div role="alert" class="w-100 alert alert-primary alert-dismissible fade show">

                <strong>
                    <i class="fas fa-folder-open"></i>
                </strong> Sorry no records found for your filter!
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
    </div>
@endif
