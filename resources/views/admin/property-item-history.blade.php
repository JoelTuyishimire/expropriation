@extends("layouts.master")
@section("title","Property items")

@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Property items</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Property item History</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--end::Toolbar-->
        </div>
    </div>
@stop
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            @include('partial._alerts')
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="kt-portlet__head-title">
                             {{$item->name}} History
                        </h3>
                    </div>
                    <!--end::Dropdown-->


                </div>
                <div class="card-body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-hover table-checkable" id="kt_datatable1">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Property Type</td>
                            <td>Name</td>
                            <td>Measurement</td>
                            <td>Unit Price</td>
                            <td>Location</td>
                            <td>Creation Date</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories ?? []  as $key=>$history)
                            <tr>
                                <td>{{ ++$key }}</td>

                                <td>{{ optional($item->propertyType)->name ?? "-" }}</td>
                                <td>{{ $history->name }}</td>
                                <td>{{ $history->measurement_unit }}</td>
                                <td>{{ $history->unit_price }}</td>
                                <td>{{ $history->location }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>


@stop

@section('scripts')
    <script>
        $('.nav-marketplace').addClass('menu-item-active  menu-item-open');
        $('.nav-all-zones').addClass('menu-item-active');

        $('#kt_datatable1').DataTable({
            responsive: true
        });
    </script>
@endsection
