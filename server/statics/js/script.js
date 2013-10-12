$(document).ready(function()
{
	$(".yzu_nav_controller").click(function() {
		attr = $(".yzu_nav").css('display');
		$(".yzu_nav").toggle(200);
	
		if (attr == 'none')		
			$(".yzu_nav_controller").html('<span class="glyphicon glyphicon-arrow-up"></span>Menu');
		else
			$(".yzu_nav_controller").html('<span class="glyphicon glyphicon-arrow-down"></span>Menu');
	});

	$('#product_type').change(function(){
		$this = $('#product_type');
		value = $this.val();

		if (value == '二手書籍')
			$("#form_course").show("fast");
		else
			$("#form_course").hide("fast");
	})

	$(".fancybox-effects-a").fancybox({
		helpers: {
			title : {
				type : 'outside'
			},
			overlay : {
				speedOut : 0
			}
		}
	});

	$(".search_product_by_name").keypress(function(e) {
		if (e.which == 13)
			window.location = "https://yzu.revo.so/index.php/market/filter/name/" + $(this).val() ;
	}) ;

	function isInt()
	{
		var x = $('#input_price').val();
		var y = parseInt(x);
		if (isNaN(y))
			return false;
		return true
	}

	$('.btn_post').click(function(){
		if ( $('#product_type').val() == '二手書籍')
		{
			if (!isInt())
			{
				alert('請照實輸入金額！');
				return false;
			}
		}
	});
});