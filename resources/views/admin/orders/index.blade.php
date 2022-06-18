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
                <!-- task, page, download counter  start -->
                <div class="col-xl-12">
                    <div class="page-body">
                        @include('admin.includes.messages')
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('orders.create')}}" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Tạo mới đơn hàng</a>
                                {{--                            <button href="{{route('coupons.create')}}" type="button" class="btn btn-success btn-md m-b-10"><i class="fa fa-plus-circle"></i> Create coupon</button>--}}
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Danh sách đơn hàng</h5>
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
                                                    <th>Mã đơn hàng</th>
                                                    <th>Tên người nhận</th>
                                                    <th>SĐT người nhận</th>
                                                    <th>Địa chỉ người nhận</th>
                                                    <th>Giá ($)</th>
                                                    <th>Trạng thái đơn hàng</th>
                                                    <th>Thạng thái thanh toán</th>
                                                    <th>Tạo ngày</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($data as $item)
                                                    <tr>
                                                        <td style="vertical-align: middle" class="text-center">{{$i = $i+1}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->order_code}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->recipient_name}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->recipient_phone}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{$item->recipient_address}}</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{number_format($item->total_price,0)}}</td>
                                                        <td style="vertical-align: middle" class="text-center"> @foreach(\App\Models\OrdersModel::STATUS_ALL as $key => $status)
                                                                @if($item->order_status == $status['key'])
                                                                    <span class="label" style="background: {{$status['color']}}">{{$status['status_name']}}</span>
                                                                @endif
                                                            @endforeach</td>
                                                        <td style="vertical-align: middle" class="text-center">
                                                                @foreach(\App\Models\OrdersModel::PAYMENT_STATUS as $key => $status)
                                                                    @if($item->payment_status == $status['key'])
                                                                       <span class="label" style="background: {{$status['color']}}">{{$status['status_name']}}</span>
                                                                    @endif
                                                                @endforeach</td>
                                                        <td style="vertical-align: middle; white-space: break-spaces;">{{date_format($item->created_at,'d-m-Y H:i:s')}}</td>
                                                        <td>
                                                            <a href="{{route('orders.edit', ['id'=>$item->id])}}" class="btn btn-inverse btn-sm">Chi tiết</a>
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
    </script>
    <script src="{{asset('template_admin\files\bower_components\datatables.net\js\jquery.dataTables.min.js')}} "></script>
    <script src="{{asset('template_admin\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template_admin\files\bower_components\sweetalert\js\sweetalert.min.js')}}"></script>
@endsection
