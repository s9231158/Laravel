@extends('shop')
   
@section('content')
<div class="container">
    <h2>Shopping Cart</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>pic</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr rowId="{{ $id }}">
                        <td><img  width="10%" src ="{{ asset('images') }}/{{$details['image']}}" ></td>
                        <td>{{ $details['name'] }}</td>
                        <td>${{ $details['price'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>
    <input type="number" class="edit-cart-info" data-id="{{ $id }}" value="{{ $details['quantity'] }}" min="1">
</td>
                        <td>${{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">
                                <i class="fa fa-trash-o"></i> Remove
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td>${{ $total }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <a href="{{ url('/BookBuy') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
    <a href="{{ url('/checkout') }}" class="btn btn-success">Checkout <i class="fa fa-angle-right"></i></a>
</div>
@endsection
   
@section('scripts')
<script type="text/javascript">
   
   $(".edit-cart-info").change(function (e) {
    e.preventDefault();
    
    var ele = $(this);
    var newQuantity = ele.val();
    var productId = ele.data("id"); // 取得商品的唯一識別符（ID）

    $.ajax({
        url: '{{ route('update.sopping.cart') }}',
        method: "PATCH",
        data: {
            _token: '{{ csrf_token() }}',
            id: productId, // 傳送商品的唯一識別符（ID）
            quantity: newQuantity // 傳送新的數量
        },
        success: function (response) {
            if (response.success) {
                // 更新購物車成功，您可以選擇重新整理頁面或者更新總價等資訊
                window.location.reload();
            } else {
                // 處理更新失敗的情況
                window.location.reload();

                
            }
        },
        error: function (xhr, status, error) {
            // 處理 AJAX 請求錯誤的情況
            console.error(error);
        }
    });
});

   
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
   
</script>
@endsection