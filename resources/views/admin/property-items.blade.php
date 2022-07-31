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
                            <a class="text-muted">Property items</a>
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
                            List of Property items
                        </h3>
                    </div>
                        <div class="card-toolbar">
                            <a href="javascript:void(0)" class="btn btn-primary"
                               data-toggle="modal"
                               data-target="#addModal" >
                                <i class="la la-plus"></i>
                                New Property item
                            </a>
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
                            <td>Description</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($propertyItems ?? []  as $key=>$item)
                            <tr>
                                <td>{{ ++$key }}</td>

                                <td>{{ optional($item->propertyType)->name ?? "-" }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->measurement }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->description }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary  dropdown-toggle btn-sm"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Actions</button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="{{ route('admin.property-items.history',encryptId($item->id)) }}">
                                                    <i class="la la-history"></i>
                                                    History
                                                </a>
                                                <a class="dropdown-item dropdown-item-color btn-edit" href="#"
                                                   data-name="{{$item->name}}"
                                                   data-name_en="{{$item->name_en}}"
                                                   data-measurement="{{$item->measurement}}"
                                                    data-price="{{$item->price}}"
                                                    data-location="{{$item->location}}"
                                                    data-description="{{$item->description}}"
                                                    data-id="{{$item->id}}"
                                                    data-property_type_id="{{$item->property_type_id}}"
                                                   data-url="{{ route('admin.property-items.update', encryptId($item->id)) }}"
                                                   data-toggle="modal"
                                                   data-target="#editModal"> <i class="la la-pencil"></i> Edit</a>
                                                <a class="dropdown-item dropdown-item-color btn-delete" href="#"
                                                   data-url="{{ route('admin.property-items.destroy', encryptId($item->id))}}"><i class="la la-trash"></i> Delete</a>
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
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Property item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form action="{{route("admin.property-items.store")}}" method="POST" id="add-property-items-form">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Name</label>
                                            <input name="name" type="text" id="name" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name_en">Name en</label>
                                            <input name="name_en" type="text" id="name_en" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Property Type</label>
                                            <select name="property_type_id" id="property_type_id" class="form-control">
                                                <option value="">Select Property Type</option>
                                                @foreach($propertyTypes ?? [] as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">measurement unit</label>
                                            <select name="measurement" id="measurement_id" class="form-control">
                                                <option value="">Select measurement unit</option>
                                                @foreach($measurementUnits ?? ["KG","PIECES", "NUMBER"] as $item)
                                                    {{--                                                <option value="{{$item->id}}">{{$item->name}}</option>--}}
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Unit price</label>
                                            <input name="price" type="text" id="price" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Location</label>
                                            <input name="location" type="text" id="location" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group" >
                                            <label for="name">Description</label>
                                            <textarea name="description" id="description" class="form-control"></textarea>
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
                                <h5 class="modal-title" id="exampleModalLabel">Edit Property item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form action="" method="POST" id="edit-property-items-form">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Name</label>
                                            <input name="name" type="text" id="_name" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name_en">Name en</label>
                                            <input name="name_en" type="text" id="_name_en" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Property Type</label>
                                            <select name="property_type_id" id="_property_type_id" class="form-control">
                                                <option value="">Select Property Type</option>
                                                @foreach($propertyTypes ?? [] as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">measurement unit</label>
                                            <select name="measurement" id="_measurement" class="form-control">
                                                <option value="">Select measurement unit</option>
                                                @foreach($measurementUnits ?? ["KG","PIECES", "NUMBER"] as $item)
                                                    {{--                                                <option value="{{$item->id}}">{{$item->name}}</option>--}}
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Unit price</label>
                                            <input name="price" type="text" id="_price" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group" >
                                            <label for="name">Location</label>
                                            <input name="location" type="text" id="_location" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group" >
                                            <label for="name">Description</label>
                                            <textarea name="description" id="_description" class="form-control"></textarea>
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

                <form method="post" id="delete-property-items-form">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
    </div>


@stop

@section('scripts')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ValidatePropertyItem', '#add-property-items-form'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ValidatePropertyItem', '#edit-property-items-form'); !!}
    <script>
        $('.nav-marketplace').addClass('menu-item-active  menu-item-open');
        $('.nav-all-zones').addClass('menu-item-active');

        $('#kt_datatable1').DataTable({
            responsive: true
        });

        $(document).on('click','.btn-edit',function(e) {
            e.preventDefault();
            $('#_name').val($(this).data('name'));
            $('#_name_en').val($(this).data('name_en'));
            $('#_property_type_id').val($(this).data('property_type_id'));
            $('#_measurement').val($(this).data('measurement'));
            $('#_price').val($(this).data('price'));
            $('#_location').val($(this).data('location'));
            $('#_description').val($(this).data('description'));

            $('#edit-property-items-form').attr("action", $(this).data('url'));
        });

        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            swal.fire({
                title: 'Are you sure?',
                text: "This Property item Will be deleted.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#06c4ff',
                confirmButtonText: 'Yes, Continue',
                cancelButtonColor: '#ff1533',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('#delete-property-items-form').attr("action", url);
                    $('#delete-property-items-form').submit();
                }
            });
        })
    </script>
@endsection
