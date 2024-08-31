@extends("layouts.master")
@section("title","Claims")

@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Claims</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Claims</a>
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
                            List of Claims
                        </h3>
                    </div>
                    @if(auth()->user()->is_citizen)
                        <div class="card-toolbar">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="btn btn-primary">
                                <i class="la la-plus"></i>
                                New Claim
                            </a>
                        </div>
                    @endif
                    <!--end::Dropdown-->


                </div>
                <div class="card-body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-hover table-checkable" id="kt_datatable1">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Citizen Name</td>
                            <td>Citizen Phone</td>
                            <td>Expropriated Property</td>
                            <td>Claim</td>
                            <td>Claim Date</td>
                            <td>Attachment</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($claims ?? []  as $key=>$claim)
                            <tr>
                                <td>{{ ++$key }}</td>

                                <td>{{ optional($claim->citizen)->name }}</td>
                                <td>{{ optional($claim->citizen)->telephone }}</td>
                                <td><a href="{{route('admin.expropriations.show', $claim->expropriation_id)}}">{{optional(optional($claim->expropriation)->propertyType)->name}}</a></td>
                                <td>{{$claim->title}}</td>
                                <td>{{$claim->created_at}}</td>
                                <td>
                                    @if($claim->getAttachment())
                                        <a class="btn btn-dark btn-sm" href="{{$claim->getAttachment()}}" target="_blank"><i class="la la-download"></i>Download</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{$claim->status_color}}">{{$claim->status}}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary  dropdown-toggle btn-sm"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Actions</button>
                                        <div class="dropdown-menu" style="">
                                            @if($claim->comment == null)
                                                @if(auth()->user()->is_citizen)
                                                    <a class="dropdown-item"
                                                       href="#">
                                                        Not yet Reviewed
                                                    </a>
                                                @else
                                                    <a class="dropdown-item btn-review"
                                                       data-toggle="modal"
                                                       data-target="#claimModal"
                                                       href="{{route('admin.claims.review',$claim->id)}}">
                                                        <i class="la la-file-contract"></i>
                                                        Review this claim
                                                    </a>
                                                @endif
                                            @else
                                                <a class="dropdown-item btn-claim-review"
                                                   data-content="{{$claim->comment}}"
                                                   data-toggle="modal"
                                                   data-target="#reviewModal"
                                                   href="#">
                                                    <i class="la la-file-contract"></i>
                                                    Review
                                                </a>
                                            @endif


                                            @if($claim->status == 'Pending')
                                                <a class="dropdown-item btn-submit" href="{{route('admin.claims.submit',$claim->id)}}">
                                                    <i class="la la-eye"></i>
                                                    Submit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item dropdown-item-color btn-delete" href="#"
                                                   data-url="{{ route('admin.claims.destroy', $claim->id)}}"><i class="la la-trash"></i> Delete</a>
                                            @endif

                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>



                <div class="modal fade " id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Claim</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form action="{{route("admin.claims.store")}}" method="POST" id="add-property-types-form" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
{{--                                        <input type="hidden" name="citizen_id" value="{{auth()->user()->id}}">--}}
                                        <div class="col-md-12 form-group" >
                                            <label for="title">Title</label>
                                            <input name="title" type="text" id="title" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group" >
                                            <label for="expropriation_id">Expropriated Property</label>
                                            <select name="expropriation_id" id="expropriation_id"class="form-control">
                                                <option value="">--Choose--</option>
                                                @foreach($expropriations ?? [] as $expropriation)
                                                    <option value="{{$expropriation->id}}">
                                                        {{
                                                        optional($expropriation->propertyType)->name ." | ".
                                                        optional($expropriation->province)->name ." - ".
                                                        optional($expropriation->district)->name ." - ".
                                                        optional($expropriation->sector)->name." | ".
                                                        $expropriation->amount." RWF "

                                                        }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group" >
                                            <label for="title">Attachment</label>
                                            <input name="attachment" type="file" id="attachment" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group" >
                                            <label for="name">Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle-o"></span> Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Property type</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form action="" method="POST" id="edit-property-types-form">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group" >
                                        <label for="name">Name</label>
                                        <input name="name" type="text" id="_name" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label for="name">Name En</label>
                                        <input name="name_en" type="text" id="_name_en" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle-o"></span> Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <form method="post" id="delete-property-types-form">
                    @csrf
                    @method('DELETE')
                </form>

                <div class="modal fade " id="claimModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form action="" method="POST" id="review-form">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group" >
                                        <label for="add-name">Comment</label>
                                        <textarea required name="comment" id="comment" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group" >
                                        <label for="status">Status</label>
                                        <select required name="status" class="form-control" id="status">
                                            <option value="">--Select--</option>
                                            <option value="Accepted">Accepted</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle-o"></span> Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade " id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Claim Review</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form action="" method="POST" id="review-form">
                                @csrf
                                <div class="modal-body">
                                        <div id="review-content" class="mb-5"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@stop

@section('scripts')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ValidateClaims', '#add-property-types-form'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ValidateClaims', '#edit-property-types-form'); !!}
    <script>
        $('.nav-marketplace').addClass('menu-item-active  menu-item-open');
        $('.nav-all-zones').addClass('menu-item-active');

        $('#kt_datatable1').DataTable({
            responsive: true
        });


        $(document).on('click','.btn-edit',function(e) {
            e.preventDefault();
            $('#_name').val($(this).data('name'));
            $('#_name_en').val($(this).data('nameEn'));

            $('#edit-property-types-form').attr("action", $(this).data('url'));
        });

        $(document).on('click','.btn-review',function(e) {
            e.preventDefault();
            $('#review-form').attr("action", $(this).attr('href'));
        });
        $(document).on('click','.btn-claim-review',function(e) {
            e.preventDefault();
            let content = $(this).data("content");
            $("#review-content").html(content)
        });
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            swal.fire({
                title: 'Are you sure?',
                text: "This Claim Will be deleted.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#06c4ff',
                confirmButtonText: 'Yes, Continue',
                cancelButtonColor: '#ff1533',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('#delete-property-types-form').attr("action", url);
                    $('#delete-property-types-form').submit();
                }
            });
        })
        $(document).on('click', '.btn-submit', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            swal.fire({
                title: 'Are you sure?',
                text: "This Claim Will be Submitted.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#06c4ff',
                confirmButtonText: 'Yes, Continue',
                cancelButtonColor: '#ff1533',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    window.location.href = url;
                }
            });
        })
    </script>
@endsection
