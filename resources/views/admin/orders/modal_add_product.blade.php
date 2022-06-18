<div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-modal">Thêm hàng hóa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="product_type">Loại hàng hóa: <span class="text-danger">(*)</span></label>
                        <br>
                        <input type="hidden" class="form-control" id="qty" name="qty" value="0" step="1" min="0">
                        <input type="hidden" class="form-control" id="id_temp" name="id_temp">
                        <select class="js-example-data-array" name="category" id="category">
                            <option value="0">-- Chọn loại hàng --</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}" data-name="{{$cat->name}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <p class="text-danger"></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="product_type">Sản phẩm: <span class="text-danger">(*)</span></label>
                        <br>
                        <select class="js-example-data-array" name="product_id" id="product_id">
                            <option value="0">-- Chọn Sản Phẩm --</option>
{{--                            @foreach($categories as $cat)--}}
{{--                                <option value="{{$cat->id}}" data-name="{{$cat->name}}">{{$cat->name}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        <p class="text-danger"></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="quantity">Số lượng: <span class="text-danger">(*)</span></label>
                        <br>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" onchange="changeQuantity(this)">
                        <p class="text-danger"></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="extra_charges">Đơn giá: <span class="text-danger">(*)</span></label>
                        <br>
                        <input type="number" class="form-control" id="price_product" name="price_product" value="0" step="1" min="0" readonly>
                        <p class="text-danger"></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="extra_charges">Thành tiền: <span class="text-danger">(*)</span></label>
                        <br>
                        <div class="input-group">
                            <input type="number" class="form-control" id="into_money" name="into_money" value="0" step="1" min="0">
                            <span class="input-group-addon" id="basic-addon1">$</span>
                        </div>
                        <p class="text-danger"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="note_modal">Ghi chú:</label>
                        <br>
                        <textarea name="note_modal" class="form-control" id="note_modal" cols="" rows="3"></textarea>
                        <p class="text-danger"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="addProduct()">Lưu</button>
            </div>
        </div>
    </div>
</div>
<form enctype="multipart/form-data" id="form-add-product">
    @csrf
</form>
<script>
    function changeQuantity(event){
        if ($('#price_product').val() !== '0'){
            var price = $('#price_product').val();
            price = parseInt(price) * parseInt($(event).val());
            $('#into_money').val(price);
        }
    }

    function addProduct(){
        let _token = $('input[name="_token"]').val();
        let category = $('[name=category]').val();
        let product_id = $('[name=product_id]').val();
        var id_temp = $('[name=id_temp]').val();
        let quantity = $('[name=quantity]').val();
        var price_product = $('[name=price_product]').val();
        var into_money = $('[name=into_money]').val();
        var note_modal = $('[name=note_modal]').val();
        var data = document.getElementById('form-add-product');
        var formData = new FormData(data);

        if(category === '' || product_id === '' || price_product === '' || into_money === '' || quantity === ''){
            alert('Vui lòng nhập đủ thông tin');
        } else {
            formData.append('category', category);
            formData.append('product_id', product_id);
            formData.append('price_product', price_product);
            formData.append('quantity', quantity);
            formData.append('into_money', into_money);
            formData.append('note', note_modal);
            formData.append('id_temp', id_temp);
            $.ajax({
                url: "{{ route('orders.add.product') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                // {_token: _token, product_name: product_name_modal, product_type: product_type,  price_product_type: price_product_type, quantity: quantity, extra_charges:extra_charges,
                // weight: weight, wide: wide, long: long, height: height, note: note_modal, id_temp: id_temp},
                success: function (data) {
                    if(typeof data === 'string'){
                        data = JSON.parse(data);
                    }
                    if (data.code === 200){
                        console.log(data.data)
                        $('#add-product-modal').modal('hide');
                        loadProduct(data.data)
                    } else {
                        alert(data.message)
                    }
                }
            });
            return;
        }
    }

    function loadProduct(data){
        $('#data-product-table').empty();
        var number = 0;
        var total_price = 0;
        var price_product = 0;
        if (Array.isArray(data)){
            var array = data;
        } else {
            var array = $.map(data, function(value, index) {
                return [value];
            });
        }
        if (array.length > 0){
            array.forEach(element => {
                number = number + 1;
                price_product = parseFloat(element.into_money) + price_product;
                console.log(element)
                let price_product1 = new Intl.NumberFormat().format(element.price_product);
                let into_money = new Intl.NumberFormat().format(element.into_money);
                $('#data-product-table').append('<tr id="product"><td style="vertical-align: middle" class="text-center">'+number +'</td>'+
                    '<td style="vertical-align: middle" class="">'+element.product_name+'</td>'+
                    '<td style="vertical-align: middle" class="text-center">'+element.unit+'</td>'+
                    '<td style="vertical-align: middle" class="text-center">'+element.quantity+'</td>'+
                    '<td style="vertical-align: middle" class="text-center">'+price_product1+'</td>'+
                    '<td style="vertical-align: middle" class="text-center">'+into_money+'</td>'+
                    '<td style="vertical-align: middle" class="text-center">' +
                    '<a href="javascript:void(0)" onclick="updateProduct(this)" category="'+element.category+'" product-id="'+element.product_id+'" product-name="'+element.product_name+'" ' +
                    'price_product="'+element.price_product+'" product-quantity="'+element.quantity+'" into_money="'+element.into_money+'" ' +
                    'id_temp="'+element.id_temp+'" note="'+element.note+'" class="btn btn-sm btn-inverse m-r-5">Sửa</a>' +
                    '<a href="javascript:void(0)" onclick="removeProduct('+element.id_temp+')" class="btn btn-sm btn-danger">Xóa</a></td>'+
                    '</tr>');
            });
        } else {
            $('#data-product-table').append('<tr class="odd"><td valign="top" colspan="10" class="dataTables_empty text-center">Không có dữ liệu để hiển thị</td></tr>');
        }
        // let new_total_price = new Intl.NumberFormat().format(price_product);
        $('#total_price').val(price_product);
    }
    function updateProduct(tag){
        $('#title-modal').text('Cập nhật Sản phẩm');
        // $("[name=product_type]").val( $(tag).attr('product-type'));

        $('[name=category]').val($(tag).attr('category')).change();

        $('[name=id_temp]').val($(tag).attr('id_temp'));
        // $('[name=product_name_modal]').val($(tag).attr('product-name'));
        $('[name=price_product]').val($(tag).attr('price_product'));
        $('[name=quantity]').val($(tag).attr('product-quantity'));
        $('[name=into_money]').val($(tag).attr('into_money'));
        $('[name=note_modal]').val($(tag).attr('note') ? 'null' : '');
        $('#add-product-modal').modal('show');
        setTimeout(() => {
            $('[name=product_id]').val($(tag).attr('product-id')).change();
        }, "1000")
    }
    function removeProduct(id){
        $.ajax({
            url: "{{ route('orders.remove.product') }}",
            method: "GET",
            data: {id: id},
            success: function (data) {
                if(typeof data === 'string'){
                    data = JSON.parse(data);
                }
                if (data.code === 200){
                    loadProduct(data.data)
                } else {
                    alert(data.message)
                }
            }
        });
        return;
    }
</script>
