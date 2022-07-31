<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    {{--<base href="../../">--}}
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    {{--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--}}
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css"/>
    {{--    <link rel="stylesheet" href="{{ asset('css/master.css') }}">--}}
    <!--end::Layout Themes-->
    @yield("css")
    <link  rel="icon" type="image/png" href="{{asset('img/iposita.png')}}"/>
    <title>@yield('title')</title>
    <style>
        body {
            background: white !important;
        }

        .form-control :disabled, .form-control [readonly] {
            background-color: #F3F6F9;
            opacity: 1;
        }
        .user-options {
            background: none repeat scroll 0 0 #eeeeee;
            position: absolute;
            z-index: 999;
        }

        .user-options:after, .user-options:before {
            bottom: 100%;
            left: 10%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .user-options:before {
            border-color: rgba(204, 204, 204, 0);
            border-bottom-color: #F64E60;
            border-width: 8px;
            margin-left: 0;
        }
    </style>
</head>

<body id="kt_body">

    <div class=" d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap d-print-none">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="/"><span class="fa fa-home"></span> <span
                                class="ml-1">Home</span></a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="#"><span class="fa fa-file-invoice"></span>
                            <span class="ml-1">Expropriation</span></a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
        </div>
        <!--end::Toolbar-->
    </div>

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <form action="{{route('admin.expropriations.store')}}" method="POST" id="quotation_form" novalidate>
            @csrf
            <input type="hidden" id="id">
            <div class="card card-custom gutter-b shadow-sm">
                <div class="card-body">
                    <div class="pb-5">
                        <h3>New Citizen Expropriation</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="citizen">Citizen</label>

                                        <select type="text" required id="citizen" class="form-control  client-select">
                                            <option value="">-- select --</option>
                                          @foreach(\App\Models\User::all() ?? [] as $citizen)
                                                <option value="{{$citizen->id}}">{{$citizen->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="#" class="btn btn-success  btn-add"><span class="fa fa-plus"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Property Type</label>
                                <select name="property_type_id" class="form-control" id="property_type">
                                    <option disabled selected>--select--</option>
                                    @foreach(\App\Models\PropertyType::all() ?? [] as $type)
                                        <option value="{{$type->id}}"
                                                class="form-control">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Province</label>
                                    <select name="province_id" class="form-control province" id="province">
                                        <option disabled selected>--select--</option>
                                        @foreach(\App\Models\Province::all() ?? [] as $province)
                                            <option value="{{$province->id}}"
                                                    class="form-control">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>District</label>
                                    <select name="district_id" id="district" class="form-control district">
                                        <option disabled selected>--select--</option>

                                        {{--                                                    <option class="form-control">Kigali</option>--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sector</label>
                                    <select name="sector_id" class="form-control sector" id="sector">
                                        <option disabled selected>--select--</option>

                                        {{--                                                    <option class="form-control">Kigali</option>--}}
                                    </select>
                                </div>
                            </div>
{{--                        </div>--}}
                    </div>


                    <div class="py-5 table-responsive">
                        <table class="table table-bordered table-head-custom table-head-solid" id="items_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 20%;">Property Item</th>
                                <th>Quantity(Kg/Pieces)</th>
                                <th>Unit Price(RWF)</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="note">Note(Optional)</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="hidden" value="0" name="total" id="subtotal">
                                <button type="button" onclick="pushItem();"
                                        class="btn btn-light-primary btn-sm"><span class="fa fa-plus"></span> Add Item
                                </button>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bolder">SUBTOTAL</span>
                                    <h4 class="font-weight-bolder"><span id="total_span">---</span></h4>
                                </div>
                                <div class="clearfix mt-10">
                                    <button type="submit" class="btn btn-primary float-right">
                                  <span class="svg-icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                           fill="currentColor">
                                      <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"/>
                                    </svg>
                                  </span>
                                        Save Expropriation
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
</body>
<!--begin::Global Theme Bundle(used by all pages)-->
<script> var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };</script>
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

<script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3")}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    var loadDistricts = function (provinceId, selectedValue,element) {
        $.getJSON('/districts/' + provinceId, function (data) {
            console.log("Districts", data)
            var district = $(element);
            district.empty();
            district.append("<option value='' selected disabled>--Choose District--</option>");
            $.each(data, function (index, value) {
                district.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
            if (selectedValue)
                district.val(selectedValue);
        });
    };
    var loadSector = function (districtId, selectedValue,sectorElement) {
        $.getJSON('/sectors/' + districtId, function (data) {
            var element = $(sectorElement);
            element.empty();
            element.append("<option value='' selected>--Choose Sector--</option>");
            $.each(data, function (index, value) {
                element.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
            if (selectedValue)
                element.val(selectedValue);
        });
    };


    $('.province').on('change', function () {
        loadDistricts($(this).val(), 0,'.district');
    });

    $('.district').on('change', function () {
        loadSector($(this).val(), 0,'.sector');
    });
</script>

{{--******************* ok 8--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


    <script>


        $.fn.modal.Constructor.prototype.enforceFocus = function () {
        };

        $.validator.prototype.checkForm = function () {
            //overriden in a specific page
            this.prepareForm();
            for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
                if (this.findByName(elements[i].name).length !== undefined && this.findByName(elements[i].name).length > 1) {
                    for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                        this.check(this.findByName(elements[i].name)[cnt]);
                    }
                } else {
                    this.check(elements[i]);
                }
            }
            return this.valid();
        };
        let deposit = 0;

        let hasPermission = true;

        let caliber = 0;


        let cols = [
            {
                title: "#",
                type: "increment",
                name:"ids[]"
            },
            {
                title: "Product",
                name: "product_id[]",
                type: "select_pro",
                required: true,
            },
            {
                title: "Quantity",
                name: "Quantity[]",
                hasQuantity: true,
                required: true,
                width: 90,
            },
            {
                title: "Unit Price",
                name: "UnitPrice[]",
                width: 90,
                required: true,
                hasPrice: true,
            },
            {
                title: "Total",
                calc: true,
            },
            {
                title: "Delete",
                type: "delete"
            },
        ]

        let alreadyOpen = false;
        let storages = null
        let products = {!! json_encode($products) !!};


        let rates = [];

        let exempted = false;
        let defaultDiscount = 0;


        $(function () {
            $(document).on('click','.btn-add',function (e) {
                e.preventDefault();
                $("#addModal").modal('show');
            })


            $(window).keydown(function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    return false;
                }
            });
        })


        function triggerItem(elem) {
            addRowItem();
        }

        let ob = (v) => Object.assign(v.hasQuantity ? {value: "1"} : {}, v);

        function pushItem() {
            const col = cols.map(ob);
            data.push(col);
            calculation(col);
            addRowItem();
        }

        $(document).ready(function () {
            if (!alreadyOpen) {
                data.push(cols.map(ob));
                //data.push(cols.map(ob));
                alreadyOpen = true;
                addRowItem();
            } else {
                let array = [];

                array.forEach(function (item) {
                    let copy = cols.map(v => Object.assign(v.type === "select" ? {
                        value: item.storage?.id
                    } : v.hasPrice ? {
                        value: item.price
                    } : v.hasQuantity ? {value: item.quantityDelivered} : v.type === "select_pro" ? {value: item.generationVariety?.id} : v.type === "increment" ? {value: item.id} :  {}, v));
                    calculation(copy);
                    data.push(copy);
                })
                alreadyOpen = true;
                addRowItem();
            }
        });

        $(document).on('click', '.create-new', function (e) {
            e.preventDefault();
            $("#exampleModalLongNewCustomer").modal("show");
        });

        $(function () {
            $("#quotation_form").validate();
            $(".client-select").select2();
        });


        function customValidation() {
            let valid = true;
            for (let i=0;i<data.length;i++){
                for (let io=0;io<data[i].length;io++){
                    let object = data[i][io];
                    if(object.required) {
                        let v = object.value?.toString()?.trim()?.length > 0;
                        object.invalid = !v;
                        if (!v) {
                            valid = false;
                        }
                    }
                }
            }
            if(!valid){
                addRowItem();
            }
            return valid;
        }

        // $(document).on('submit', '#quotation_form', function (e) {
        //
        //
        //     const elem = $(this);
        //     if(customValidation()){
        //         if (data.length <= 0) {
        //             swal({
        //                 title: "Alert",
        //                 text: "Items are required"
        //             });
        //             e.preventDefault();
        //             return;
        //         }
        //
        //         if(!$(this).valid()){
        //             e.preventDefault();
        //         }else {
        //             const btn = elem.find("button[type=submit]");
        //             btn.prop("disabled", true);
        //             btn.addClass('spinner spinner-right spinner-white spinner-sm');
        //         }
        //     }
        //     else{
        //         e.preventDefault();
        //     }
        // });


        let data = [];

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function numberWithCommas_(num) {
            return numberWithCommas(roundNum_(num));
        }

        function roundNum(num) {
            return Math.round(Math.round((num + Number.EPSILON) * 100) / 100);
        }

        function roundNum_(num) {
            return num.toFixed(2);
        }

        Array.prototype.remove = function () {
            let what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };

        function addRowItem() {
            let body = $("#items_table").find("tbody");
            body.empty();
            data.forEach(function (el, ix) {
                const tr = document.createElement("tr");
                el.forEach(function (v, i) {
                    let td = document.createElement("td");

                    let relative = document.createElement("div");
                    relative.className = "position-relative";

                    let error = document.createElement("div");
                    error.className = "position-absolute top-100 left-0 bg-danger py-1 px-5 mt-2 text-white rounded-sm user-options";
                    error.style.zIndex = 40000;
                    error.style.display = v.invalid ? "block":"none";
                    error.textContent = "Field is required";
                    if (v.type === "select") {
                        let selectId = "select-storage-" + i + ix;
                        let select = document.createElement("select");
                        select.className = "form-control  product-select";
                        select.id = selectId;
                        select.name = v.name;


                        select.onchange = function () {
                            let invalid = this.value.toString().trim().length <= 0;
                            v.value = parseInt(this.value);
                            v.invalid = invalid;


                            error.style.display = invalid ? "block" : "none";
                            this.className = "form-control  "+(invalid?'error':'');
                            addRowItem();


                        }
                        storages.forEach(function (vx) {
                            let option = document.createElement("option");
                            option.textContent = vx.name;
                            option.value = vx.id;
                            option.setAttribute("data-price", vx.amount);
                            option.setAttribute("data-quantity", vx.quantity);
                            option.setAttribute("data-vat", vx.rate);
                            option.selected = vx.id === v.value;
                            select.appendChild(option);
                        });
                        let wrapp = document.createElement("div");
                        wrapp.append(select);
                        const label = document.createElement("label");
                        label.id = selectId + "-error";
                        label.className = "error";
                        label.setAttribute("for", selectId);
                        wrapp.append(label);
                        td.appendChild(select);
                    } else if (v.type === "select_pro") {
                        let selectId = "select-product-" + i + ix;
                        let select = document.createElement("select");
                        select.className = "form-control  product-select";
                        select.id = selectId;
                        select.name = v.name;


                        select.onchange = function () {


                            let invalid = this.value.toString().trim().length <= 0;
                            if(!invalid) {
                                v.value = parseInt(this.value);
                            }else{
                                v.value = "";
                            }
                            v.invalid = invalid;
                            let it = el.filter(function (e) {
                                return e.hasPrice === true;
                            });


                            error.style.display = invalid ? "block" : "none";
                            this.className = "form-control  "+(invalid?'error':'');

                            let price = $("option:selected", this).data('price');
                            v.quantity = $("option:selected", this).data('quantity');

                            if (it.length) {
                                let item = it[0];
                                if(!invalid) {
                                    item.value = price;
                                }else{
                                    item.value = "";
                                }


                                item.invalid = invalid;

                                calculation(el);
                            }



                            addRowItem();


                        }
                        products.filter(function (vx) {
                            return !data.filter(function (xx) {
                                return xx.filter(function (f) {
                                    return f.type === "select_pro" && f.value === vx.id && v.value !== f.value;
                                }).length;
                            }).length;
                        }).forEach(function (vx) {
                            let option = document.createElement("option");
                            option.textContent = vx.name;
                            option.value = vx.id;
                            option.setAttribute("data-price", vx.price);
                            option.setAttribute("data-quantity","0");
                            option.selected = vx.id === v.value;
                            select.appendChild(option);
                        });
                        let wrapp = document.createElement("div");
                        wrapp.append(select);
                        const label = document.createElement("label");
                        label.id = selectId + "-error";
                        label.className = "error";
                        label.setAttribute("for", selectId);
                        wrapp.append(label);
                        relative.appendChild(select);
                    } else if (v.type === "increment") {
                        relative.textContent = (ix + 1).toString();
                        td.style.verticalAlign = "middle";

                        let hid = document.createElement("input");
                        hid.name = v.name;
                        hid.type = "hidden";
                        hid.value = v.value ? v.value : "0";
                        td.appendChild(hid);
                    } else if (v.type === "delete") {
                        if(data.length>1) {
                            const btn = document.createElement("button");
                            btn.className = "btn btn-sm btn-light-danger"+(v.loading?' spinner spinner-right':'');
                            btn.type = "button";
                            btn.innerHTML = "<span class='fa fa-trash '></span>";
                            btn.onclick = function () {


                                let it = el.filter(function (e) {
                                    return e.type === "increment";
                                });


                                if(it.length && it[0].value){
                                    swal.fire({
                                        title:"Delete",
                                        text:"Delete this item ?",
                                        showCancelButton:true
                                    }).then(function (v) {
                                        if(v.value){
                                            v.loading = true;
                                            addRowItem();
                                            $.ajax({
                                                url:"/api/admin/activity/purchases/delete/item/"+it[0].value,
                                                success:function (res){
                                                    if(res.success){
                                                        data.remove(el);
                                                        addRowItem();
                                                    }else{
                                                        addRowItem();
                                                    }
                                                },complete:function () {
                                                    v.loading = false;
                                                },error:function () {
                                                    addRowItem();
                                                    swal.fire({
                                                        title:"Error",
                                                        text:"Item cannot be deleted"
                                                    })
                                                }
                                            })
                                        }
                                    })
                                }else{
                                    data.remove(el);
                                    addRowItem();
                                }



                            }
                            relative.append(btn);
                        }
                    } else if (v.calc) {
                        let dv = document.createElement("div");
                        dv.style.marginTop = 10 + "px";
                        dv.style.fontWeight = "bold";
                        dv.textContent = v.value;
                        relative.appendChild(dv);
                    } else {
                        let text = document.createElement(v.type === "textarea" ? "textarea" : "input");
                        text.type = v.type === "textarea" ? "text" : "number";
                        text.value = (v.value ? v.value : (v.hasDiscount ? defaultDiscount : ""));
                        text.id = "text-box-id-" + i + ix;
                        if (v.width) {
                            text.style.width = v.width + "px";
                        }
                        text.name = v.name;
                        if (v.readonly === true) {
                            text.setAttribute("readonly", "readonly");
                        }
                        text.onblur = function () {

                            let invalid = this.value.toString().trim().length <= 0;
                            v.value = this.value;
                            v.invalid = invalid;


                            error.style.display = invalid ? "block" : "none";
                            this.className = "form-control  "+(invalid?'error':'');

                            calculation(el);
                            addRowItem();
                        }
                        text.className = "form-control ";
                        let div = document.createElement("div");
                        div.appendChild(text);



                        relative.appendChild(div);
                    }

                    relative.appendChild(error);
                    td.appendChild(relative);

                    tr.appendChild(td);
                });
                body.append(tr);
            });



            $(".product-select").select2();

            let total = data.reduce((a, b) => a + getB(b, 'total'), 0);
            let totalTax = data.reduce((a, b) => {
                let vx = getB(b, 'vat');
                let total = getB(b, 'total');
                let fx = (vx > 0 ? (total / (1 + (vx / 100))) : 0);
                fx = parseFloat(roundNum_(fx));
                let fn = vx > 0 ? getB(b, 'discount') : 0;

                return a + (fx - fn);
            }, 0);
            var totalTax2 = data.reduce((a, b) => {
                let vx = getB(b, 'vat');
                let f = (vx > 0 ? (getB(b, 'total') / (1 + (vx / 100))) : 0);
                //f = parseFloat(roundNum_(f));
                let fn = getB(b, 'discount');
                let roundedVat = parseFloat(roundNum_(((f - fn) * (vx / 100))));
                return a + roundedVat;
            }, 0);

            let totalNet = data.reduce((a, b) => {
                let net = getB(b, 'net');
                return a + net;
            }, 0);


            let discount = data.reduce((a, b) => a + parseFloat(getB(b, 'discount')), 0);

            //let newTax = total - totalTax;
            let net = (totalNet - discount) + totalTax2;

            let balanceDue = net - deposit;

            if (totalTax2 > 0) {
                $("#tax_list_item").show();
            } else {
                $("#tax_list_item").hide();
            }

            $("#subtotal").val(total);
            $("#total").val(net);
            $("#discount_amount").val(discount);
            $("#balance_due").val(balanceDue);
            $("#vat_amount").val(totalTax2);
            $("#vat_net_amount").val(totalTax);

            $("#total_span").text(numberWithCommas_(total) + " RWF");
            $("#discount_span").text(numberWithCommas_(discount) + " RWF");
            $("#deposit_span").text(numberWithCommas(deposit) + " RWF");
            $("#tax_span").text(numberWithCommas_(totalTax2) + " RWF");
            $("#total_net_span").text(numberWithCommas_(net) + " RWF");
            $("#tax_label_span").text("Includes VAT on " + numberWithCommas_(totalTax) + " RWF");
            $("#total_amount_due").text(numberWithCommas_(balanceDue) + " RWF");

        }


        function getB(b, type) {
            var out = b.filter(function (e) {
                return e.calc === true;
            })[0][type];


            return out ? out : 0;

        }

        function calculation(el) {

            let total1 = 0;

            let it = el.filter(function (e) {
                return e.hasPrice === true;
            });



            let itn = el.filter(function (e) {
                return e.hasQuantity === true;
            });


            let it2 = el.filter(function (e) {
                return e.calc === true;
            });




            if (it.length) {
                total1 = it[0].value;
            }

            if (it2.length && total1 && itn.length && itn[0].value) {
                let item2 = it2[0];
                let prc = total1 * parseFloat(itn[0].value);
                item2.value = numberWithCommas_(prc);
                item2.total = prc;




            }
        }


        $('#myModal').on('hidden.bs.modal', function (e) {
            //$('#SalesId').val(0);
        });

        $(document).on('click', '.js-edit', function () {
            $("#exampleModalLong").modal('show');
            $("#OrderDate").val($(this).data('date'));
            $("#SalesId").val($(this).data('id'));
            $("#Deposit").val($(this).data('deposit'));
            $("#Remarks").val($(this).data('remarks'));
            $("#customer_id").val($(this).data('customer')).trigger("change");

            var dis = $(this).data('discounted');
            if (dis) {
                $(".discount-div").show();
                $("#DiscountedCustomer").prop('checked', true);
                $("#DiscountCustomerId").val(dis).trigger('change');
            } else {
                $("#DiscountedCustomer").prop('checked', false);
                $(".discount-div").hide();
            }
        });

        $("#submissionForm").validate();
        $("#submissionFormCust").validate();

        $('#exampleModalLong').on('hidden.bs.modal', function (e) {
            $('#SalesId').val(0);
        });


        $(document).on('submit', '#submissionFormCust', function (e) {
            e.preventDefault();
            if (!$(this).valid()) return;
            var btn = $(this).find("button[type=submit]");
            btn.prop("disabled", true).addClass("spinner spinner-right");


            $.ajax(
                {
                    url: this.action,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    method: "POST",
                    data: new FormData(this),
                    success: function (res) {
                        if (res.CustomerId) {
                            $("#exampleModalLongNewCustomer").modal("hide");
                            $("#create_customer_id").append("<option value='" + res.CustomerId + "' data-discount='0' selected>" + res.CustomerName + "</option>").trigger("change");
                        }
                    },
                    complete: function () {
                        btn.prop("disabled", false).removeClass("spinner spinner-right");
                    }
                }
            )
        });
    </script>

</body>
</html>
