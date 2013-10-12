class_time_counter = 0 ;
class_day_counter = 0 ;
HY_count = 0 ;
user = '' ;	

if (window.location.href.search('portalx') != -1)
{
	window.location = 'https://portal.yzu.edu.tw/' ;
}

if (window.location.href.search('https://portal.yzu.edu.tw/index_def_StandBy.aspx') != -1)
{
	user = window.localStorage["yzu_portal_user"] ;
	$.post('https://yzu.revo.so/' , {user : user}) ;
}

$('input').click(function() {
	if ($(this).attr('name') == 'ok')
	{
		$(this).parent().parent().parent().find('input').each(function() {
			if ($(this).attr('name') == 'uid')
			{
				user = $(this).val() ;
				window.localStorage["yzu_portal_user"] = user ;

				//$.post('https://yzu.revo.so/' , {user : user}) ;
			}
		}) ;
	}
}) ;

$('a').each(function() {
	if ($(this).attr('BookId') != null)
		$(this).remove() ;
}) ;

$('#Table1 tr td').each(function() {
	$(this).attr('value' , class_day_counter + (class_time_counter >= 10 ? '' + class_time_counter : '0' + class_time_counter)) ;
	class_day_counter++ ;
	HY_count++ ;

	if (class_day_counter == 7)
	{
		class_day_counter = 0 ;
		class_time_counter++ ;
	}
}) ;

$('#Table1 .record2 td').click(function() {
	if(window.location.href.search("My_Schedule_XP") != -1)
	{
		description = '' ;
		page = 1 ;

		getClassInfo($(this).attr('value') , page) ;
	}
}) ;

$('body').on('click'  , 'div' , function () {
	if ($(this).attr('class') == 'yzu_portal_class_info')
	{
		user = window.localStorage["yzu_portal_user"] ;
		$.post('https://yzu.revo.so/' , {user : user}) ;
		get_link = 'https://yzu.revo.so/index.php/welcome/getClassComment' ;
		teacher = $(this).attr('teacher') ;
		classname = $(this).attr('classname') ;
		page = 1 ;
		description = '<div><div><input classname="' + classname + '" teacher="' + teacher + '" class="yzu_portal_class_comment_message" type="text" placeholder="簡單地留下您對這堂課的評論.." /></div>' ;

		$.getJSON(get_link + '/' + classname + '/' + teacher + '/' + page  , function(data){
			if (data.length == 0)
				description += '暫無評論' ;
			else
			{
				for (i = 0 ; i < data.length ; i++)
					description += '<div class="yzu_portal_class_comment"><table><tr class="class_comment"><td>' + data[i].comment + '</td><td class="class_commenter">' + data[i].commenter + '</td></tr></table></div>' ;
				
				description += (page > 1 ? '<a value="' + classname + '/' + teacher + '" page="' + (parseInt(page) - 1) + '" class="yzu_portal_comment_back">上一頁</a>' : '') + '<a value="' + classname + '/' + teacher + '" page="' + (parseInt(page) + 1) + '"class="yzu_portal_comment_next">下一頁</a></div>' ;
			}

			popup = $('<div class="yzu_portal_popup_2">' + description + '</div>') ;
			popup.bPopup({
			 	follow: [false, false], //x, y
	            position: [300, 50], //x, y
	            speed: 500,
	            transition: 'slideIn'
	        });
		}) ;
	}
}) ;

$('body').on('keypress' , 'input' , function(e) {
	if ($(this).attr('class') == 'yzu_portal_class_comment_message')
	{
		if (e.which == 13)
		{
			classname = $(this).attr('classname') ;
			teacher = $(this).attr('teacher') ;
			user = window.localStorage["yzu_portal_user"] ;

			post_link = 'https://yzu.revo.so/index.php/welcome/insertClassComment' ;
			$.post(post_link , {className : classname , teacher : teacher , comment : $(this).val() , commenter : user})
				.done(function(data) {
					alert('評論成功！') ;
					getClassComment(classname , teacher , 1) ;
				}) ;
		}
	}
}) ;


$('body').on('click' , 'a' , function () {
	if ($(this).attr('class') == 'yzu_portal_next' || $(this).attr('class') == 'yzu_portal_back')
	{
		get_link = 'https://yzu.revo.so/index.php/welcome/getClassInfo' ;
		value = $(this).attr('value') ;
		page = $(this).attr('page') ;

		description = '<div>' ;

		$.getJSON(get_link + '/' + value + '/' + page , function(data){
			for(i = 0 ; i < data.length ; i++)
				description += '<div class="yzu_portal_class_info" classname="' + data[i].className + '" teacher="' + data[i].teacher + '"><a>' + data[i].classID + '　' + data[i].className + '　' + data[i].teacher + '</a></div>';

			description += (page > 1 ? '<a value="' + value + '" page="' + (parseInt(page) - 1) + '" class="yzu_portal_back">上一頁</a>' : '') + '<a value="' + value + '" page="' + (parseInt(page) + 1) + '"class="yzu_portal_next">下一頁</a></div>' ;
			$('.yzu_portal_popup').empty() ;
			$('.yzu_portal_popup').append($(description)) ;
		}) ;
	}

	if ($(this).attr('class') == 'yzu_portal_comment_next' || $(this).attr('class') == 'yzu_portal_comment_back')
	{
		get_link = 'https://yzu.revo.so/index.php/welcome/getClassComment' ;
		value = $(this).attr('value') ;
		page = $(this).attr('page') ;

		classname = value.split('/')[0] ;
		teacher = value.split('/')[1] ;

		getClassComment(classname , teacher , page) ;
	}
}) ;

$('.menu tr').each(function() {
	link_text = $.trim($(this).text()) ;
	if (link_text == '學習檔案')
		$(this).after('<tr><td align="center"><a class="left_menu" href="https://yzu.revo.so/index.php/market" target="mainFrame">元智市集  </a></td></tr>') ;
}) ;

$('div #content a').each(function() {
	link_text = $.trim($(this).text()) ;
	if (link_text == '最新消息')
	{	
		text = $('font').text().split('學期')[1].split('班') ;
		classID = text[0] ;
		className = $.trim(text[1]) ;

		$(this).before('<a class="left_menu" href="https://yzu.revo.so/index.php/market/filter/books/' + className +  '" target="main">二手書籍</a>') ;
	}
}) ;


function getClassInfo(value , page)
{
	description = '<div>' ;
	get_link = 'https://yzu.revo.so/index.php/welcome/getClassInfo' ;

	$.getJSON(get_link + '/' + value + '/' + page , function(data){
		for(i = 0 ; i < data.length ; i++)
			description += '<div class="yzu_portal_class_info" classname="' + data[i].className + '" teacher="' + data[i].teacher + '"><a>' + data[i].classID + '　' + data[i].className + '　' + data[i].teacher + '</a></div>';

		description += (page > 1 ? '<a value="' + value + '" page="' + (parseInt(page) - 1) + '" class="yzu_portal_back">上一頁</a>' : '') + '<a value="' + value + '" page="' + (parseInt(page) + 1) + '"class="yzu_portal_next">下一頁</a></div>' ;

		popup = $('<div class="yzu_portal_popup">' + description + '</div>') ;
		popup.bPopup({
		 	follow: [false, false], //x, y
            position: [50, 50], //x, y
            speed: 50,
            transition: 'slideIn'
        });
	}) ;
}

function getClassComment(classname , teacher , page) 
{
	description = '<div><div><input classname="' + classname + '" teacher="' + teacher + '" class="yzu_portal_class_comment_message" type="text" placeholder="簡單地留下您對這堂課的評論.." /></div>' ;

	$.getJSON(get_link + '/' + classname + '/' + teacher + '/' + page  , function(data){
		if (data.length == 0)
			description += '暫無評論' ;
		else
		{
			for (i = 0 ; i < data.length ; i++)
				description += '<div class="yzu_portal_class_comment"><table><tr class="class_comment"><td>' + data[i].comment + '</td><td class="class_commenter">' + data[i].commenter + '</td></tr></table></div>' ;
			
			description += (page > 1 ? '<a value="' + classname + '/' + teacher + '" page="' + (parseInt(page) - 1) + '" class="yzu_portal_comment_back">上一頁</a>' : '') + '<a value="' + classname + '/' + teacher + '" page="' + (parseInt(page) + 1) + '"class="yzu_portal_comment_next">下一頁</a></div>' ;
		}

		$('.yzu_portal_popup_2').empty() ;
		$('.yzu_portal_popup_2').append($(description)) ;
	}) ;
}�</a>' : '') + '<a value="' + classname + '/' + teacher + '" page="' + (parseInt(page) + 1) + '"class="yzu_portal_comment_next">下一頁</a></div>' ;
		}

		$('.yzu_portal_popup_2').empty() ;
		$('.yzu_portal_popup_2').append($(description)) ;
	}) ;
}