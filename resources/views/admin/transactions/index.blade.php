@extends('layouts.master')
@section("title","All Transactions")

@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Transactions</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Transactions</a>
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
                            All Transactions
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        @can("Create Transaction")
                            <a href="javascript:void(0)" class="btn btn-primary"
                               data-toggle="modal"
                               data-target="#addModal" >
                                <i class="la la-plus"></i>
                                New Transaction
                            </a>
                        @endcan
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
                    <!--begin: Datatable-->
                    <div class="table-responsive">
                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Customer Telephone</th>
                                <th>Customer Email</th>
                                <th>Service Provider</th>
                                <th>Service</th>
                                <th>Amount</th>
                                <th>Is Exclusive</th>
                                <th>External Branch Commission</th>
                                <th>Total Charges</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>



            </div>

        </div>
    </div>

    <div  data-backdrop="static"  class="modal fade" id="addModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" id="add-form" action="{{route('admin.transaction.store')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display:none" id="add-error-bag">
                        </div>
                        <div class="form-group">
                            <label for="service_provider">Service Provider</label>
                            <select id="service_provider" class="form-control" name="service_provider">
                                <option disabled selected value="">---Select---</option>
                                @foreach($serviceProviders as $provider)
                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_id">Service </label>
                            <select id="service_id" class="form-control" name="service">
                                <option value="">---Select---</option>
                            </select>
                            <input type="hidden" name="service_charges_id" id="service_charges_id">
                        </div>

                        <div class="form-group reference_number_container" >
                            <label for="reference-number" id="display-label"> </label>
                            <div id="reference_number_input">

                            </div>

                        </div>
                        <div class="form-group after_check_container">
                            <label for="amount"> Amount </label>
                            <input id="amount" type="number" name="amount" class="form-control" aria-describedby="amount">
                        </div>
                        <div class="form-group" id="alert-charges">
                            <div class="alert alert-custom alert-notice alert-light-success fade show mb-5 py-2" role="alert">
                                <div class="alert-text">Charges:
                                    <span id="charges_fee"></span>
                                </div>
                                <div class="alert-close">
{{--                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                            <span aria-hidden="true">--}}
{{--                                                <i class="ki ki-close"></i>--}}
{{--                                            </span>--}}
{{--                                    </button>--}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group after_check_container">
                                <label class="col-3 col-form-label">Is Exclusive?</label>
                                <div class="col-9 col-form-label">
                                    <div class="radio-inline">
                                        <label class="radio radio-success">
                                            <input type="radio" name="is_exclusive" checked="checked" value="0">
                                            <span></span>No</label>
                                        <label class="radio radio-success">
                                            <input type="radio" name="is_exclusive" value="1">
                                            <span></span>Yes</label>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group after_check_container">
                            <label for="customer-name"> Customer Name </label>
                            <input id="customer-name" type="text" name="customer_name" class="form-control" aria-describedby="Customer Name">
                        </div>
                        <div class="form-group after_check_container">
                            <label for="customer-phone"> Customer Phone </label>
                            <input id="customer-phone" type="text" name="customer_phone" class="form-control" aria-describedby="Customer phone">
                        </div>
                        <div class="form-group after_check_container">
                            <strong for="choose-notification "> Which One You prefer to receive </strong>
                            <br>
                            <label for="">
                                <input type="radio" name="notification_type" class="notification_type" value="SMS"> SMS
                            </label>
                            <label for="">
                                <input type="radio" name="notification_type" class="notification_type" value="Email"> Email
                            </label>
                        </div>

{{--                            <input id="choose-notification" type="text" name="choose_notification" class="form-control" aria-describedby="Choose notification">--}}
{{--                        </div>--}}
{{--                        <div class="d-none" id="phone_notification_container">--}}
{{--                        </div>--}}
                        <div class="d-none" id="email_notification_container">
                        <div class="form-group after_check_container">
                            <label for="customer-email"> Customer Email </label>
                            <input id="customer-email" type="email" name="customer_email" class="form-control" aria-describedby="Customer email">
                        </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                class="la la-close"></span> Close
                        </button>
                        <button type="submit" class="btn btn-primary confirm-btn"><span class="la la-check-circle-o"></span>
                            Confirm Transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a id="ajaxUrl" href="{{request()->fullUrl()}}"></a>
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\TransactionRequest::class,'#add-form') !!}
    <script>
        $('.reference_number_container').hide();
        $('.after_check_container').hide();
        $('#alert-charges').hide();
        $('.nav-transactions').addClass('menu-item-active');
        var confirm_btn=$(".confirm-btn");
        let url= $("#ajaxUrl").attr('href')
        let charges = null;
        $('#kt_datatable1').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'print_btn', name: 'print_btn', orderable: false, searchable: false},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'customer_phone', name: 'customer_phone'},
                {data: 'customer_email', name: 'customer_email'},
                {data: 'service_provider_name', name: 'serviceCharges.serviceProvider.name'},
                {data: 'service_name', name: 'serviceCharges.service.name'},
                {data: 'amount', name: 'amount'},
                {data: 'is_exclusive', name: 'is_exclusive'},
                {data: 'external_branch_commission', name: 'external_branch_commission'},
                {data: 'total_charges', name: 'total_charges'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
            ],
            'order': [[8, 'desc']]
        });

        $("#service_provider").change(function (){
            $('.reference_number_container').hide();
            loadServices($(this).val())
        })
        $("#service_id").change(function (){
           var data=$(this).find(':selected').data('service');
           charges=data.charges;
            console.log(charges)
            $("#display-label").html(data.display_label);
            if(data.require_remote_fetch===true){
            $("#reference_number_input").html('<div class="input-group">'
               +'<input class="form-control py-2" type="search" name="reference_number" id="reference-number">'
                +'<span class="input-group-append">'
                +' <button class="btn btn-primary border-left-0 border check-btn" type="button"> Check</button>'
                +' </span></div>');
                confirm_btn.hide();
            }else{
                $("#reference_number_input").html('<input id="reference-number" type="text" name="reference_number" class="form-control" aria-describedby="emailHelp">');
                $('.after_check_container').show();
                confirm_btn.show();
            }
            $('.reference_number_container').show();
        })

        var loadServices=function (providerId){
            let el = $('#service_id');
            $.ajax({
                url: '/admin/load/services/'+providerId+'/provider',
            }).done(function(response) {
                el.empty();
                el.append('<option selected disabled value="">-- select--</option>');
                response.forEach(function(item) {
                    el.append($("<option data-service='"+JSON.stringify(item)+"' value='"+item.id+"'>"+item.name+"</option>"))
                })
            })
        }

        $(document).on("click",".check-btn",function (e) {
            e.preventDefault();
            checkReference();
            $(".check-btn").attr("disabled", true);
        })

        var checkReference=function (){
           var referenceNumber=$("#reference-number").val();
           if(referenceNumber){
               let el = $('#service_id');

               $.ajax({
                   url: "/admin/load/services/"+$("#service_provider").val()+"/provider",
               }).done(function(response) {
                   $('#customer-name').val("Josephine Mukankusi")
                   $(".check-btn").attr("disabled", false);
                   $('.after_check_container').show();
                   confirm_btn.show();
               })
           }else{
               swal.fire({
                   title: "Error",
                   text: "Reference Number is required",
                   icon: 'warning',
                   showCancelButton:false,
                   confirmButtonColor: '#06c4ff',
                   confirmButtonText: 'Ok',
                   cancelButtonColor: '#ff1533',
                   cancelButtonText: 'ok',
                   reverseButtons: true
               }).then(function (result) {
                   $(".check-btn").attr("disabled", false);
               })
           }

        }

        $(document).on("keyup","#amount",function (e) {
            e.preventDefault();
            let amount = $("#amount").val();
            let charge_fee = 0;
            let message = "<br>";
            let serviceChargesId = $("#service_charges_id");
            chargeType = charges[0].charges_type;
            if (chargeType === 'Flat') {
                serviceChargesId.val(charges[0].id);
                let flat = charges[0].charges
                message += "Flat : "+ flat;
                $("#charges_fee").html(flat+message);
            } else if (chargeType === 'Percentage') {
                serviceChargesId.val(charges[0].id);
                percent = charges[0].charges
                message += "Percentage : "+percent;
                 charge_fee = (amount * percent / 100);
                $("#charges_fee").html(charge_fee+message);
            } else if (chargeType === 'Range') {
                //amount between range min and max
              let cat = charges.filter(item => Number(item.min) <= amount && Number(item.max )>= amount);
                console.log(cat)
              if (cat.length > 0) {
                  serviceChargesId.val(cat[0].id);
                  message += "Range : " +cat[0].min + " - "+cat[0].max, " Fee : "+cat[0].charges;
                $("#charges_fee").html(cat[0].charges+message);
              } else {
                  message +='Category not found'
                $("#charges_fee").html("0"+message);
              }
            }
            checkBalance();
            $("#alert-charges").show();
        })

        $(document).on('change','#branches', function (e){
            e.preventDefault();
            let el = $(this)
            let branchesId =el.val();
            loadUsers(branchesId,"#users");
        });
        var loadUsers=function (branches,element,selectedValue=null) {
            let el = $(element);
            $.ajax({
                url: '{{route("branches.users")}}',
                data:{
                    // branches:branches.toString().split(','),
                }
            }).done(function(response) {
                el.empty();
                el.append('<option value="">-- select--</option>');
                response.forEach(function(item) {
                    el.append($('<option>', {
                        value: item.id,
                        text: item.name,
                    }))
                })
                if(selectedValue){
                    el.val(selectedValue);
                }
            })
        }

        $(function (){
            var users =@json(request("users"));
            loadUsers($("#branches").val(),'#users',users);
        })

        $(document).on("change",".notification_type",function (e) {
            e.preventDefault();
            let notificationType = $("[name='notification_type']:checked").val();
                if(notificationType==='Email'){
                $("#email_notification_container").removeClass("d-none");
                $("#customer-email").attr("required",true);
            }else{
                $("#email_notification_container").addClass("d-none");
                $("#customer-email").attr("required",false);
            }
            });

        //ask for confirmation before submitting
        $(document).on("submit",".confirm-btn",function (e) {
            e.preventDefault();
            checkBalance();
            form = $('#add-form');
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#06c4ff',
                confirmButtonText: 'Yes, continue!',
                cancelButtonColor: '#ff1533',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (!result.isConfirmed) if (
                    /* Read more about handling dismissals below */
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Submitting Transaction Cancelled :)',
                        'error'
                    )
                } else {
                    form.submit();
                }
            })
        })

        //check if branch has enough balance to make transaction
        function checkBalance() {
            $.ajax({
                url: "{{route('admin.branch.checkBalance')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    amount: $("#amount").val(),
                    service_id: $("#service_id").val(),
                    service_provider_id: $("#service_provider").val(),
                    is_exclusive: $('input[name=is_exclusive]:checked').val(),
                },
                success: function (data) {
                    console.log(data.success);
                    if(data.success){
                        confirm_btn.attr('disabled', false);
                        //hide alert
                        $("#add-error-bag").hide();
                    }else{
                        confirm_btn.attr('disabled', true);
                        // add error message to the page add-error-bag
                        $("#add-error-bag").html("<span>No enough Amount to make this transaction</span>");
                        $("#add-error-bag").show();

                    }
                }
            });
        }
        //check balance when is_exclusive is checked
        $(document).on("change","input[name=is_exclusive]",function (e) {
            e.preventDefault();
            checkBalance();
        })

    </script>


@endsection

