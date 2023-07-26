<div class="col-lg-4 col-md-6">
	<div class="card" id="memory-pressure-widget">
		<div class="card-header" data-container="body" >
			><i class="fa fa-area-chart"></i>
		    <span data-i18n="memory.memorypressure"></span>
		    <a href="/show/listing/memory/memory" class="pull-right"><i class="fa fa-list"></i></a>
		</div>
		<div class="list-group scroll-box"></div>
	</div><!-- /card -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {
	
	var box = $('#memory-pressure-widget div.scroll-box');
	
	$.getJSON( appUrl + '/module/memory/memory_pressure_widget', function( data ) {
		
		box.empty();
		if(data.length){
			$.each(data, function(i,d){
                if (d.memorypressure >= 80){
                    var badge = '<span class="badge badge-secondary badge pull-right alert-danger">'+d.memorypressure+'%</span>';
                } else{
                    var badge = '<span class="badge badge-secondary badge pull-right">'+d.memorypressure+'%</span>';
                }
                box.append('<a href="'+appUrl+'/show/listing/memory/memory/#'+d.computer_name+'" class="list-group-item list-group-item-action">'+d.computer_name+badge+'</a>')
			});
		}
		else{
			box.append('<span class="list-group-item">'+i18n.t('no_data')+'</span>');
		}
	});
});	
</script>
