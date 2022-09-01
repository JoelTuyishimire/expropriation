@extends('layouts.master')
@section("title","Expropriations Report")

@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Expropriations</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Expropriations Report</a>
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
            @include('partial._alerts')
            <div class="card card-custom gutter-b">
                <div class="flex-wrap card-header">
                    <div class="card-title">
                        <h3 class="kt-portlet__head-title">
                            Expropriations Report
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-light-primary mx-2 font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="la la-download"></i> Export</a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover">
                                        <li class="navi-item">
                                            <a target="_blank" href="{{request()->fullUrl()}}{{str_contains(request()->fullUrl(), '?')?'&':'?'}}is_download=1&type=excel" class="navi-link">

                                                <i class="la la-file-excel"></i>
                                                Excel
                                            </a>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a target="_blank" href="{{request()->fullUrl()}}{{str_contains(request()->fullUrl(), '?')?'&':'?'}}is_download=1&type=pdf" class="navi-link">

                                                <i class="la la-file-pdf"></i>
                                                PDF
                                            </a>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Dropdown-->

                </div>
                <div class="card-body">
                    <div class="accordion accordion-toggle-arrow mb-3" id="accordionExample1">
                        <div class="card">
                            <div class="card-header py-0">
                                <div class="card-title {{request()->fullUrl()==route("admin.expropriations.report")?'collapsed':''}}" data-toggle="collapse" data-target="#application-payment-section" aria-expanded="false">Advanced Filter</div>
                            </div>
                            <div id="application-payment-section" class="collapse {{request()->fullUrl()==route("admin.expropriations.report")?'hide':'show'}}" data-parent="#accordionExample1" style="">
                                <div class="p-5">
                                    <form method="get" action="{{route('admin.expropriations.report')}}" id="search-form" >
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <input type="hidden" value="0" name="is_download" id="is_download">
                                                <label for="start_date"> Start Date</label>
                                                <input placeholder="YYY-MM-DD"
                                                       required readonly autocomplete="off" value="{{request('start_date')}}" type="text" name="start_date" id="start_date" class="form-control end-today-datepicker">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="end_date"> End Date</label>
                                                <input placeholder="YYY-MM-DD"
                                                       required readonly value="{{request('end_date')}}" type="text" name="end_date" id="end_date" class="form-control end-today-datepicker" >
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="status"> Status</label>
                                                <select multiple id="status" name="status[]" class="form-control">
                                                    <option {{in_array(\App\Models\Expropriation::SUBMITTED,request('status')??[])?'selected':''}} value="{{\App\Models\Expropriation::SUBMITTED}}">{{\App\Models\Expropriation::SUBMITTED}}</option>
                                                    <option {{in_array(\App\Models\Expropriation::APPROVED,request('status')??[])?'selected':''}} value="{{\App\Models\Expropriation::APPROVED}}">{{\App\Models\Expropriation::APPROVED}}</option>
                                                    <option {{in_array(\App\Models\Expropriation::REJECTED,request('status')??[])?'selected':''}} value="{{\App\Models\Expropriation::REJECTED}}">{{\App\Models\Expropriation::REJECTED}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="provinces">Provinces</label>
                                                    <select multiple class="form-control" name="provinces[]" id="provinces">
                                                        @foreach($provinces as $province)
                                                            <option value="{{$province->id}}" {{in_array($province->id,request('provinces')??[])?'selected':''}}>{{$province->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="districts">Districts</label>
                                                    <select multiple class="form-control" name="districts[]" id="districts">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sectors">Sectors</label>
                                                    <select multiple class="form-control" name="sectors[]" id="sectors">

                                                    </select>
                                                </div>
                                            </div>

                                                <div class="form-group col-md-4">
                                                    <label for="citizens"> Citizens</label>
                                                    <select multiple id="citizens" name="citizens[]" class="form-control">
                                                        @foreach($citizens as $citizen)
                                                            <option {{in_array($citizen->id,request('citizens')??[])?'selected':''}} value="{{$citizen->id}}">{{$citizen->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <div class="form-group col-md-4">
                                                <label for="property_types"> Property Types</label>
                                                <select multiple id="property_types" name="property_types[]" class="form-control">
                                                    @foreach($propertyTypes ?? [] as $property_type)
                                                        <option {{in_array($property_type->id,request('property_types')??[])?'selected':''}} value="{{$property_type->id}}">{{$property_type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary btn-sm mb-5 search-btn"> <span class="la la-search"></span> Search</button>
                                                <a href="{{route('admin.expropriations.report')}}" class="btn btn-outline-danger btn-sm mb-5 ml-5"><span class="la la-eraser"></span> Clear Form</a>
                                                <a id="ajaxUrl" href="{{request()->fullUrl()}}"></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!--begin: Datatable-->
                    <div class="table-responsive">
                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Citizen Name</td>
                                <td>Property Type</td>
                                <td>Property Address</td>
                                <td>Property Price</td>
                                <td>Expropriation Status</td>
                                <td>Expropriation Date</td>
                                <th>Done By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expropriations ?? []  as $key=>$expopriation)
                                <tr>
                                    <td>{{ ++$key }}</td>

                                    <td>{{ optional($expopriation->citizen)->name }}</td>
                                    <td>{{ optional($expopriation->propertyType)->name }}</td>
                                    <td>{{
                                        optional($expopriation->province)->name
                                       ." - ". optional($expopriation->district)->name ." - ".
                                        optional($expopriation->sector)->name
                                    }}
                                    </td>
                                    <td>{{$expopriation->amount}} RWF</td>
                                    <td>{{$expopriation->created_at}}</td>
                                    <td>
                                        <span class="badge badge-{{$expopriation->status_color}}">{{$expopriation->status}}</span>
                                    </td>
                                    <td>{{($expopriation->doneBy)->name}}</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>



            </div>

        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    <script>

        $('.nav-all-reports').addClass('menu-item-active menu-item-open');
        $('.nav-expropriations-report').addClass('menu-item-active');
        var confirm_btn=$(".confirm-btn");
        let url= $("#ajaxUrl").attr('href')
        let $btn = $('.search-btn');
        $('#kt_datatable1').DataTable({
            processing: true,
        });

        $(document).ready(function (){
            loadDistricts();
        })

        $(document).on("change","#provinces",function (){
            loadDistricts();
        })
        $(document).on("change","#districts",function (){
            loadSector();
        })
        $(document).on("change","#sectors",function (){
            loadCells();
        })

        let loadDistricts = function () {
            let element = $('#districts');
            element.empty();
            $btn.addClass('spinner spinner-white spinner-right disabled');
            $btn.prop('disabled', true);
            $.ajax({
                url:"{{route('getMultipleDistricts')}}",
                method: "POST",
                data:{
                    "provinces":$('#provinces').val(),
                    "_token":'{{csrf_token()}}'
                },
                success: function (data) {
                    data.forEach(function (item) {
                        element.append("<option value='" + item.id + "' >" + item.name + "</option>");
                    });
                    $btn.removeClass('spinner spinner-white spinner-right disabled')
                        .prop('disabled', false);
                }, error: function (response) {
                    $btn.removeClass('spinner spinner-white spinner-right disabled')
                        .prop('disabled', false);
                }
            })
        };
        let loadSector = function () {
            let element = $('#sectors');
            element.empty();
            $btn.addClass('spinner spinner-white spinner-right disabled');
            $btn.prop('disabled', true);
            $.ajax({
                url:"{{route('getMultipleSectors')}}",
                method: "POST",
                data:{
                    "districts":$('#districts').val(),
                    "_token":'{{csrf_token()}}'
                },
                success: function (data) {
                    data.forEach(function (item) {
                        element.append("<option value='" + item.id + "' >" + item.name + "</option>");
                    });
                    $btn.removeClass('spinner spinner-white spinner-right disabled')
                        .prop('disabled', false);
                }, error: function (response) {
                    $btn.removeClass('spinner spinner-white spinner-right disabled')
                        .prop('disabled', false);
                }
            })

        };
        let loadCells = function () {
            let element = $('#cells');
            element.empty();
            $btn.addClass('spinner spinner-white spinner-right disabled');
            $btn.prop('disabled', true);
            $.ajax({
                url:"{{route('getMultipleCells')}}",
                method: "POST",
                data:{
                    "sectors":$('#sectors').val(),
                    "_token":'{{csrf_token()}}'
                },
                success: function (data) {
                    data.forEach(function (item) {
                        element.append("<option value='" + item.id + "' >" + item.name + "</option>");
                    });
                    $btn.removeClass('spinner spinner-white spinner-right disabled')
                        .prop('disabled', false);
                }, error: function (response) {
                    $btn.removeClass('spinner spinner-white spinner-right disabled')
                        .prop('disabled', false);
                }
            });

        };
    </script>


@endsection

