@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('template_admin\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('template_admin\files\assets\pages\data-table\css\buttons.dataTables.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('template_admin\files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('template_admin\files\bower_components\sweetalert\css\sweetalert.css')}}"/>
@endsection
@section('content')
    <div class="page-wrapper">

        <div class="page-body">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-body">
                        @include('admin.includes.messages')
                        <div class="row">
                            <div class="col-sm-8">
                                {{--                            <a href="{{route('coupons.create')}}" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</a>--}}
                                {{--                            <button href="{{route('coupons.create')}}" type="button" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</button>--}}
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Danh sách loại sản phẩm</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Tên loại sản phẩm</th>
                                                    <th>Mã loại sản phẩm</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($data as $item)
                                                    <tr id="product{{$item->id}}">
                                                        <td style="vertical-align: middle" class="text-center">{{$i = $i+1}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->name}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->code}}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-inverse btn-sm" data-id="{{$item->id}}" product-name="{{$item->name}}"
                                                               product-note="{{$item->code}}" onclick="functionEdit(this)"><i class="icofont icofont-ui-edit"></i> Edit</a>
                                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-product" data-id="{{$item->id}}" data-product="{{$item->name}}"><i class="icofont icofont-ui-delete"></i> Remove</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                {{--                            <a href="{{route('coupons.create')}}" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</a>--}}
                                {{--                            <button href="{{route('coupons.create')}}" type="button" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</button>--}}
                                <div class="card">
                                    <div class="card-header">
                                        <h5 id="action-status">Thêm hàng hóa</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <form method="POST" action="{{route('categories.save')}}">
                                            <div class="row">
                                                @csrf
                                                <input type="hidden" id="id-product" name="id" value="">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Loại sản phẩm: <span class="text-danger">(*)</span></label>
                                                        <br>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                                                        @if($errors->first('name'))
                                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="code">Mã loại:</label>
                                                        <br>
                                                        <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}">
                                                        @if($errors->first('code'))
                                                            <p class="text-danger">{{ $errors->first('code') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="form-group text-right">
                                                        <button type="submit" class="btn btn-primary m-b-0"><i class="icofont icofont-diskette"></i> Save</button>
                                                        <a href="javascript:void(0)" class="btn btn-secondary m-b-0" onclick="functionCancel(this)"><i class="icofont icofont-refresh"></i> Reset form</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- task, page, download counter  end -->
            </div>
        </div>
    </div>
    <form id="delete-form">
        @csrf
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#simpletable').DataTable({
                language: {
                    "sProcessing": "Đang xử lý..."
                    , "sLengthMenu": "Xem _MENU_ mục"
                    , "sZeroRecords": "Nội dung trống."
                    , "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục"
                    , "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục"
                    , "sInfoFiltered": "(được lọc từ _MAX_ mục)"
                    , "sInfoPostFix": ""
                    , "sSearch": "Tìm:"
                    , "sUrl": ""
                    , "oPaginate": {
                        "sFirst": "Đầu"
                        , "sPrevious": "Trước"
                        , "sNext": "Tiếp"
                        , "sLast": "Cuối"
                    }
                }
            });
        });
        function functionEdit(e){
            id = $(e).attr('data-id');
            name = $(e).attr('product-name');
            note = $(e).attr('product-note');
            $('#id-product').val(id);
            $('#name').val(name);
            $('#code').val(note);
            $('#action-status').text('Cập nhật loại sản phẩm');
        }
        function functionCancel(e){
            $('#id-product').val(null);
            $('#name').val(null);
            $('#code').text('');
            $('#action-status').text('Thêm loại sản phẩm');
        }

        $('.delete-product').click(function(event){
            var button = $(event.currentTarget);
            var product = button.data('product');
            var id = button.data('id');
            swal({
                title: "Bạn có chắc không?",
                text: "Bạn sẽ không thể phục hồi loại hàng: "+product+"!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Có, xóa nó!",
                cancelButtonText: "Không, hủy!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    var data = document.getElementById('delete-form');
                    var formData = new FormData(data);
                    formData.append('id', id);
                    $.ajax({
                        url: '{{ route('categories.delete') }}',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            if(typeof data === 'string'){
                                data = JSON.parse(data);
                            }
                            if (data.code === 200) {
                                var row = '#product'+id;
                                $(row).remove();
                                swal("Đã xóa!", "Loại hàng của bạn đã được xóa.", "success");
                                // location.reload();
                            } else {
                                swal("Error", data.message, "error");
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                } else {
                    swal("Đã hủy", "Loại hàng của bạn an toàn", "error");
                }
            });
        });
    </script>
    <script src="{{asset('template_admin\files\bower_components\datatables.net\js\jquery.dataTables.min.js')}} "></script>
    <script src="{{asset('template_admin\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template_admin\files\bower_components\sweetalert\js\sweetalert.min.js')}}"></script>
@endsection
