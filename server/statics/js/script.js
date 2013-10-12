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

	function is_int()
	{
		var x = $('#input_price').val();
		var y = parseInt(x);
		if (isNaN(y))
			return false;
		return true
	}

	function check_in_database_or_not()
	{
		var x = $('#input_course').val();
		var y = '';
		$.get('/yzu/index.php/welcome/check_class_name/' + x, function(response){
			if (response == 'not found')
			{
				alert('請輸入正確課程名稱！');
				return false;
			}
		});
	}

	$('.btn_post').click(function(){
		if (!is_int())
		{
			alert('請照實輸入金額！');
			return false;
		}

		if ( $('#product_type').val() == '二手書籍')
		{
			check_in_database_or_not();
		}
	});

	$('.sold_out').click(function() {
		$.get('https://yzu.revo.so/index.php/market/update_product_data/' + $(this).attr('val') , function() {
			location.reload() ;
		}) ;
	}) ;

	$('.delete_item').click(function() {
		$.get('https://yzu.revo.so/index.php/market/delete_product_data/' + $(this).attr('val') , function() {
			location.reload() ;
		}) ;
	}) ;

	$('#input_course').focus(function(){
		$('.autocomplete-suggestions').show();
	});

	$('#input_course').blur(function(){
		$('.autocomplete-suggestions').hide();
	});


	$('#input_course').autocomplete({
	    serviceUrl: '/index.php/market/get_class_name'
	});
});