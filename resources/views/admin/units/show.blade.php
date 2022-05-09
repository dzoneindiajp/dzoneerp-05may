@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.units.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.units.fields.id') }}
                        </th>
                        <td>
                            {{ $unit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.units.fields.name') }}
                        </th>
                        <td>
                            {{ $unit->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.units.fields.unit_code') }}
                        </th>
                        <td>
                            {{ $unit->unit_code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
