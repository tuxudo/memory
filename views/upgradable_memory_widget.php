<div class="col-lg-4 col-md-6">
	<div class="card" id="upgradable-memory-widget">
		<div class="card-heading" data-container="body">
			<i class="fa fa-microchip"></i>
		    <span data-i18n="memory.is_memory_upgradeable"></span>
		    <a href="/show/listing/memory/memory" class="pull-right"><i class="fa fa-list"></i></a>
		</div>
		<div class="card-body text-center"></div>
	</div><!-- /card -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/memory/memory_upgradable_widget', function( data ) {

    	if(data.error){
    		return;
    	}

		var card = $('#upgradable-memory-widget div.card-body'),
			baseUrl = appUrl + '/show/listing/memory/memory';
		card.empty();

        var widupgradable = 0
        var widnotupgradable = 0
        
        if(data.length){
			$.each(data, function(i,d){
                // Check if upgradable and 1 to upgradable
                if (d.upgradable == "1"){
                    widupgradable = widupgradable+1;
                }
                // Check if not upgradable and 1 to widnotupgradable
                if (d.notupgradable == "1"){
                    widnotupgradable = widnotupgradable+1;
                }
			});
		}

        // Only display block if widupgradable is not zero
        if(widupgradable != "0"){
			card.append('<a href="'+baseUrl+'#is_memory_upgradeable" class="btn btn-info"><span class="bigger-150">'+widupgradable+'</span><br>'+i18n.t('memory.upgradable')+'</a>');
		}
        // Only display block if widnotupgradable is not zero
		if(widnotupgradable != "0"){
			card.append(' <a href="'+baseUrl+'" class="btn btn-info"><span class="bigger-150">'+widnotupgradable+'</span><br>'+i18n.t('memory.notupgradable')+'</a>');
		}

    });
});


</script>
