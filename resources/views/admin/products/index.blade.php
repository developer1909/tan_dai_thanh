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
                            <div class="col-sm-12">
                                {{--                            <a href="{{route('coupons.create')}}" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</a>--}}
                                {{--                            <button href="{{route('coupons.create')}}" type="button" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</button>--}}
                                <div class="card">
                                    <div class="card-header">
                                        <h5 id="action-status">Thêm Sản Phẩm</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <form method="POST" action="{{route('products.save')}}">
                                            <div class="row">
                                                @csrf
                                                <input type="hidden" id="id-product" name="id" value="">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Tên dản phẩm: <span class="text-danger">(*)</span></label>
                                                        <br>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                                                        @if($errors->first('name'))
                                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="name">Mô tả dản phẩm: <span class="text-danger">(*)</span></label>
                                                        <br>
                                                        <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
                                                        @if($errors->first('description'))
                                                            <p class="text-danger">{{ $errors->first('description') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="code">Loại sản phẩm:</label>
                                                        <br>
                                                        <select name="category_id" id="category_id" class="form-control" required>
                                                            @foreach(\Illuminate\Support\Facades\DB::table('categories')->orderBy('name', 'asc')->get() as $cat)
                                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->first('category_id'))
                                                            <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="unit">Đơn vị:</label>
                                                        <br>
                                                        <select name="unit" id="unit" class="form-control" required>
                                                            @foreach(\Illuminate\Support\Facades\DB::table('units')->orderBy('name', 'asc')->get() as $unit)
                                                            <option value="{{$unit->name}}">{{$unit->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->first('unit'))
                                                            <p class="text-danger">{{ $errors->first('unit') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="unit">Giá:</label>
                                                        <br>
                                                        <input type="number" min="0" required name="price" id="price" class="form-control" value="0">
                                                        @if($errors->first('price'))
                                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="unit">Số lượng:</label>
                                                        <br>
                                                        <input type="number" min="0" required name="qty" id="qty" class="form-control" value="0">
                                                        @if($errors->first('qty'))
                                                            <p class="text-danger">{{ $errors->first('qty') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="form-group text-right">
                                                        <button type="submit" class="btn btn-primary m-b-0"><i class="icofont icofont-diskette"></i> Lưu</button>
                                                        <a href="javascript:void(0)" class="btn btn-secondary m-b-0" onclick="functionCancel(this)"><i class="icofont icofont-refresh"></i> Reset form</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                {{--                            <a href="{{route('coupons.create')}}" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</a>--}}
                                {{--                            <button href="{{route('coupons.create')}}" type="button" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</button>--}}
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Danh sách sản phẩm</h5>
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
                                                    <th>Tên sản phẩm</th>
                                                    <th>Loại sản phẩm</th>
                                                    <th>Mô tả SP</th>
                                                    <th>Giá (VNĐ)</th>
                                                    <th>Số lượng</th>
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
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->category}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->description}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{number_format($item->price,0) }}/{{$item->unit}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->qty}}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-inverse btn-sm" data-id="{{$item->id}}" product-name="{{$item->name}}"
                                                               product-description="{{$item->description}}" product-category-id="{{$item->category_id}}"
                                                               product-qty="{{$item->qty}}" product-price="{{$item->price}}" product-unit="{{$item->unit}}"
                                                               onclick="functionEdit(this)"><i class="icofont icofont-ui-edit"></i> Edit</a>
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
            let id = $(e).attr('data-id');
            let name = $(e).attr('product-name');
            let description = $(e).attr('product-description');
            let category_id = $(e).attr('product-category-id');
            let qty = $(e).attr('product-qty');
            let price = $(e).attr('product-price');
            let unit = $(e).attr('product-unit');

            $('#id-product').val(id);
            $('#name').val(name);
            $('#description').val(description);
            $('#category_id').val(category_id);
            $('#qty').val(qty);
            $('#price').val(price);
            $('#unit').val(unit);
            $('#action-status').text('Cập nhật sản phẩm');
        }
        function functionCancel(e){
            $('#id-product').val(null);
            $('#name').val(null);
            $('#code').text('');
            $('#action-status').text('Thêm sản phẩm');
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
                        url: '{{ route('products.delete') }}',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            if(typeof data === 'string'){
                                data = JSON.parse(data);
                            }
                            if (data.code === 200) {
                                var row = '#product'+id;
                                $(row).remove();
                                swal("Đã xóa!", "Sản phẩm của bạn đã được xóa.", "success");
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
                    swal("Đã hủy", "Sản phẩm của bạn an toàn", "error");
                }
            });
        });
    </script>
    <script src="{{asset('template_admin\files\bower_components\datatables.net\js\jquery.dataTables.min.js')}} "></script>
    <script src="{{asset('template_admin\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template_admin\files\bower_components\sweetalert\js\sweetalert.min.js')}}"></script>
@endsection
