function change_status()
{
	chrome.storage.sync.get('jump', function(result){
		data = 	JSON.parse(result.jump);
		
		if (data.value == 1)
		{
			$('.yes').attr('checked', true);
			$('.no').attr('checked', false);
		}
		else
		{
			$('.yes').attr('checked', false);
			$('.no').attr('checked', true);
		}
	});
}


$('#save').click(function(){
	value = $('input:checked').val();
	
	chrome.storage.sync.set({'jump': JSON.stringify({'value': value, 'refresh': true})}, function(){
			//console.log('value: ' + value, 'refresh: ' + true);
			location.reload();

	});
});

document.addEventListener('DOMContentLoaded', function () {
	change_status();
});