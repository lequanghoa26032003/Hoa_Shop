<!-- Partner Logo Section Begin -->
<div class="partner-logo">
	<div class="container">
		<div class="logo-carousel owl-carousel">
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-1.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-2.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-3.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-4.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-5.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Partner Logo Section End -->
<!-- Footer Section Begin -->
<footer class="footer-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="footer-left">
					<div class="footer-logo">
						<a href="index.php">
							<img src="img/_footer-logo.png" height="25" alt="">
						</a>
					</div>
					<ul>
						<li>Dai hoc Vinh </li>
						<li>Dai hoc Vinh </li>
						<li>Dai hoc Vinh </li>
					</ul>
					<div class="footer-social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-2 offset-lg-1">
				<div class="footer-widget">
					<h5>Information</h5>
					<ul>
						<li><a href="">About Us</a></li>
						<li><a href="">Checkout</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">Serivius</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="footer-widget">
					<h5>Information</h5>
					<ul>
						<li><a href="">My Account</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">Shopping Cart</a></li>
						<li><a href="">Shop</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="newslatter-item">
					<h5>Join Our Newsletter Now</h5>
					<p>Get E-mail update about our</p>
					<form action="#" class="subscribe-form">
						<input type="text" placeholder="Enter Your Mail">
						<button type="button">Subscribe</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright-reserved">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="coppyright-Text">
						Coppyright @ Hoa_Shop
					</div>
					<div class="payment-pic">
						<img src="img/payment-method.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/jquery.dd.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script src="js/cart.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
$(document).ready(function(){
        $(".toggle").click(function(){
            $(".nav-item .nav-menu ul").toggleClass('show');
        });
    });
</script>
<script>

function toggleReplyForm(id) {
    var replyForm = document.getElementById('reply-form-' + id);
    if (replyForm.style.display === 'none' || replyForm.style.display === '') {
        replyForm.style.display = 'block';
    } else {
        replyForm.style.display = 'none'; 
    }
}
$('.reply-cmt').click(function (event) {
		alert('Vui lòng đăng nhập để thực hiện');
	});
function tonggleEdit(id){
	var editForm= document.getElementById('edit-form-'+id);
	if(editForm.style.display=='none'||editForm.style.display===''){
		editForm.style.display='block';
	}else{
		editForm.style.display='none';
	}
}
</script>

<script>
	alertify.set('notifier', 'position', 'top-right');

	<?php if (isset($_SESSION['alert'])) { ?>
		alertify.success('<?= $_SESSION['alert']; ?>');
		<?php unset($_SESSION['alert']); ?>
	<?php } ?>

	<?php if (isset($_SESSION['error'])) { ?>
		alertify.error('<?= $_SESSION['error']; ?>');
		<?php unset($_SESSION['error']); ?>
	<?php } ?>
</script>
<script>
	function remove_background(product_id) {
		for (var count = 1; count <= 5; count++) {
			$('#' + product_id + '-' + count).css('color', '#999591');
		}
	}
	$(document).on('click', '.rating', function () {
		var index = $(this).data("index"); 
		var product_id = $(this).data('product_id'); 

		remove_background(product_id);
		for (var count = 1; count <= index; count++) {
			$('#' + product_id + '-' + count).css('color', '#F39C12');
		}
	});


</script>
<script>
	$('.rating').on('mouseover', function () {
		var index = $(this).data("index");
		var product_id = $(this).data('product_id');
		var customer_id = $(this).data('customer_id');
		var cmt = $('textarea[name="cmt"]').val();


		$.ajax({
			url: 'classes/product.php',
			data: { index: index, product_id: product_id, customer_id: customer_id, cmt: cmt },
			type: 'POST',
		});
	});

	$('.rating_login').click(function (event) {
		alert('Vui lòng đăng nhập để đánh giá');
	});

</script>
<script>


	$(function () {
		$(".rateyo").rateYo();
	});


</script>

<style>
#loading
{
 text-align:center; 
 background: url('loader.gif') no-repeat center; 
 height: 150px;
}
</style>
<script>
	var begin = <?php echo $begin; ?>;
$(document).ready(function(){

filter_data();

function filter_data()
{
	$('.filter_data').html('<div id="loading" style="" ></div>');
	var action = 'fetch_data';
	var minimum_price = $('#hidden_minimum_price').val();
	var maximum_price = $('#hidden_maximum_price').val();

	var brand = get_filter('brand');
	$.ajax({
		url:"classes/filter.php",
		method:"POST",
		data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand,begin:begin},
		success:function(data){
			$('.filter_data').html(data);
		}
	});
}

function get_filter(class_name)
{
	var filter = [];
	$('.'+class_name+':checked').each(function(){
		filter.push($(this).val());
	});
	return filter;
}

$('.common_selector').click(function(){
	filter_data();
});

$('#price_range').slider({
	range:true,
	min:1000,
	max:650000,
	values:[1000, 650000],
	step:100000,
	stop:function(event, ui)
	{
		$('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
		$('#hidden_minimum_price').val(ui.values[0]);
		$('#hidden_maximum_price').val(ui.values[1]);
		filter_data();
	}
});

});
</script>
<script>
$(document).ready(function() {
    var begin = <?php echo $begin; ?>;
	filter();
    
    function filter() {
		var input = $('#live_search').val();
        var types = get_filter('type');

        $.ajax({
            url: "classes/filter_blog.php",
            method: "POST",
            data: {
                types: types,
                input: input,
                begin: begin
            },
            success: function(data) {
                $('.filter_blog').html(data);
            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    $('#live_search').keyup(function() {
        filter();
    });

    $('.blog_selector').click(function() {
        filter();
    });

});
</script>
</body>

</html>