(function($){

	$('#delete').on('show.bs.modal', function (e) {
	   $("#deleteForm").attr("action", '/post/'+$(e.relatedTarget).attr('data-id'));
	});

	$('#noteConfirm').on('show.bs.modal', function (e) {

		$('.noteInfo').show();
		$('.confirmInfo').hide();

		
	   $('#noteForm input[name="post_id"]').val($(e.relatedTarget).attr('data-id'));
	   $('#noteForm input[name="note"]').val($(e.relatedTarget).attr('data-note'));
	   $('.userNote').html($(e.relatedTarget).attr('data-note'));

	   $('#confirmVoteBtn').on('click',function(e){
	   		e.preventDefault();

	   		datas = { 
			    	post_id:  $('#noteForm input[name="post_id"]').val(), 
			    	note:  $('#noteForm input[name="note"]').val(), 
			    };
			  
	   		$.ajax({
			    method: "POST",
			    url: '/rate', 
			    data: datas
			}).success(function(response) {

				if(response == "OK"){
				    console.log("success",response );
				    $('.noteInfo').hide();
			    	$('.confirmInfo').show();
			    	$('#confirmVoteBtn').attr('disabled',true);

			    	setTimeout(function(){ 
			    		$('#noteConfirm').modal('hide');
			    		$('.rateBlock').hide();

			    	}, 1700);
				}
			    
			});

	   });
	});


	$('#published_at').datetimepicker({
	    dateFormat: 'yy-mm-dd',
	    timeFormat: 'HH:mm:ss',
	    timeOnlyTitle: 'Choisir date',
	    timeText: '',
	    hourText: 'Heure',
	    minuteText: 'Minute',
	    secondText: 'Seconde',
	    currentText: 'Maintenant',
	    closeText: 'Valider',
	    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin', 'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
	    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
	    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
	    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
	    dayNamesMin: ['D','L','M','M','J','V','S'],
	    weekHeader: 'Sem',
	    firstDay: 1,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''
	});
		

	$('#noteConfirm').on('hidden.bs.modal', function(e)
    { 
        $('.noteInfo').show();
		$('.confirmInfo').hide();
    }) ;



})(jQuery);