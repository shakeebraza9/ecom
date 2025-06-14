@extends('admin.layout')
@section('css')

<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
<link href="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet" type="text/css" />

<style>

    table td{
        /* border: 1px solid lightgray; */
    }

    table th{
        /* border: 1px solid lightgray; */
    }

    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
            overflow: scroll!important;
        }
    }

</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">ALL BRAND LIST
            </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Brand</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- page start-->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="card">
                            <header class="card-header bg-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0 text-white" >All Brand List</h4>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a class="btn btn-primary" href="{{URL::to('admin/brand/create')}}">Create New </a>
                                    </div>
                                </div>
                            </header>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="" >
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Status</th>

                                            <th class="hidden-phone">Action</th>
                                        </tr>
                                     </thead>
                                    <tbody>
                             </tbody>
                        </table>
                    </div>
                    </div>
                </div>
           </section>
        </div>
      </div>

@endsection
 @section('js')


       <!-- This is data table -->
       <script src="{{asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>


       <script>
        $(function () {


            var application_table = $('.mydatatable').DataTable({
            processing: true,
            "searching": true,
            fixedColumns: false,
            fixedHeader: false,
            scrollCollapse: false,
            scrollX: true,
            // scrollY: '500px',
            autoWidth: false,
            dom: 'lfrtip',
            serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
            ajax: {
                url: "{{URL::to('admin/brand/index')}}",
                type: "GET",
                data: function ( d ) {

                }
            },
            initComplete: function () {
                // $('.js-switch').each(function () {
                //    new Switchery($(this)[0], $(this).data());
                //  });
            }
        });

        application_table.on( 'draw', function () {
            $('.js-switch').each(function () {
               new Switchery($(this)[0], $(this).data());
            });
        } );



        // $('input[type=search]').unbind();
        $("#searchButton").click(e =>{
            application_table.search($('input[type=search]').val());
            application_table.draw();
        });



        $(".mydatatable").delegate(".is_enable", "change", function(){
            var isChecked = $(this).prop('checked');
            $.ajax({
                url: "{{URL::to('/admin/status')}}",
                data: {
                    id:$(this).data('id'),
                    table:'brands',
                    column:'is_enable',
                    value: $(this).prop('checked') ? 1: 0,
                },
                dataType: "json",
                success: function (response) {

                },
                errror:function (response) {

                },
            });
            console.log(isChecked);
        });


        $(".mydatatable").delegate(".is_featured", "change", function(){
            var isChecked = $(this).prop('checked');
            $.ajax({
                url: "{{URL::to('/admin/status')}}",
                data: {
                    id:$(this).data('id'),
                    table:'categories',
                    column:'is_featured',
                    value: $(this).prop('checked') ? 1: 0,
                },
                dataType: "json",
                success: function (response) {

                },
                errror:function (response) {

                },
            });
            console.log(isChecked);
        });



      });
    </script>
@endsection
