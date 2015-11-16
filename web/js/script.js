function Enable(tab, id) {
	name = "enable" + id;
	$('#' + name).html('<img src="/img/ajax-loader.gif" />');  
	var url = 'module/admin/models/action.php?tab='+tab+'&id='+id;
	$.get(url, function(data) {
	$('#' + name).html(data);  
	});
	
}
