$(document).ready(function(){
    $('.increment-btn').click(function(e){
        e.preventDefault();
        var qtyInput = $(this).closest('.product_data').find('.input-qty');
        var qty = parseInt(qtyInput.val(), 10);
        qty = isNaN(qty) ? 0 : qty;
        if (qty < 10) {
            qty++;
            qtyInput.val(qty);
        }
    });

    $('.decrement-btn').click(function(e){
        e.preventDefault();
        var qtyInput = $(this).closest('.product_data').find('.input-qty');
        var qty = parseInt(qtyInput.val(), 10);
        qty = isNaN(qty) ? 0 : qty;
        if (qty > 1) {
            qty--;
            qtyInput.val(qty);
        }
    });
       
    $('.addToCartBtn').click(function(e){
        e.preventDefault();
        var qty=$(this).closest('.product_data').find('.input-qty').val();
        var prod_id=$(this).val();

        $.ajax({
            method: "POST",
            url:'classes/cart.php',
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function(response){
                if(response == 201){
                    setTimeout(function(){
                    location.reload(); 
                }, 500);
                alertify.success("Sản phẩm đã được thêm vào giỏ hàng");

                }
                else if(response == 200){
                    setTimeout(function(){
                    location.reload(); 
                }, 500);
                alertify.success("Đã cập nhật số lượng sản phẩm vào giỏ hàng");

                } else if(response == 401){
                    alertify.error("Đăng nhập để tiếp tục");
                } else if(response == 500){
                    alertify.error("Đã xảy ra lỗi");
                }
            }
        });
    });
    $(document).on('click','.updateQty',function(){
        var qty=$(this).closest('.product_data').find('.input-qty').val();
        var prod_id=$(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url:'classes/cart.php',
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function(response){
                if(response == 200){
                    setTimeout(function(){
                    location.reload(); 
                }, 500);
                alertify.success("Cập nhật số lượng sản phẩm thành công");

                }else if(response == 500){
                    alertify.error("Đã xảy ra lỗi");
                }
            }
        });
    });
    $('.deleteItem').click(function(e){
        e.preventDefault();
        var cart_id = $(this).val();
    
        var result = confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?");
    
        if (result) {
            $.ajax({
                method: "POST",
                url:'classes/cart.php',
                data: {
                    "cart_id": cart_id,
                    "scope": "delete"
                },
                success: function(response){
                    if(response == 200){
                        setTimeout(function(){
                            location.reload(); 

                        }, 500);
                        alertify.success("Xoá sản phẩm thành công");

                    } else if(response == 500){
                        alertify.error("Đã xảy ra lỗi");
                    }
                }
            });
        } else {

        }
    });
    $('.deleteWishlist').click(function(e){
        e.preventDefault();
        var id = $(this).val();
        var result = confirm("Bạn có chắc chắn muốn xóa khỏi trang yêu thích?");
    
        if (result) {
            $.ajax({
                method: "POST",
                url:'classes/product.php',
                data: {
                    "id": id,
                    "scope": "delete"
                },
                success: function(response){
                    if(response == 200){
                        setTimeout(function(){
                            location.reload(); 

                        }, 500);
                        alertify.success("Xoá thành công");

                    } else if(response == 500){
                        alertify.error("Đã xảy ra lỗi");
                    }
                }
            });
        } else {

        }
    });

});