@extends('layouts.master')
@section('content')



    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
        </div>
    @endif

    <div class="content pb-4" id="contentBox" media="print">
        <div class="container">
            <div class="row">
                <div class="card col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">View processing product for purchase:
                            {{ $processing->purchase->purchase_code }}</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            @if (isset($processing->processing_image))
                                <div class="col-md-12 col-lg-6 text-center justify-content-center align-self-center">
                                    <img src="{{ asset('public/app/processing/' . $processing->processing_image) }}"
                                        alt="Procssing Image" class="img-fluid">
                                </div>

                                <div class="col-md-12 col-lg-6 table-responsive view-table">
                            @else
                                    <div class="col-md-12 col-lg-12 table-responsive view-table">
                            @endif
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Purchased Code:</strong>
                                            {{ $processing->purchase->purchase_code }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Processing Code:</strong>
                                            {{ $processing->processing_code }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Start Date:</strong>
                                            {{ date('d-M-y', strtotime($processing->start_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>End Date:</strong>
                                            {{ date('d-M-y', strtotime($processing->end_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Note:</strong>{!! $processing->processing_note !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong>
                                            @if ($processing->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-success">In Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer no-print"><a href="{{ url()->previous() }}" class="btn btn-primary"><i
                            class="fas fa-long-arrow-alt-left"></i> Go Back
                    </a> <a href="#" class="btn btn-secondary float-right print-btn"><i class="fas fa-print"></i>
                        Print</a></div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // CKEDITOR.replace('note');
        // CKEDITOR.add
        $(".print-btn").click(function() {
            $('#contentBox').print({
                append: "<br/>",
                prepend: "<br/>",
                deferred: $.Deferred(),

            });
        });
    </script>
@endsection
