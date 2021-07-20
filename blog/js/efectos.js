function efectos(){

	$('#contacto').on('click', function(evento) {
		evento.preventDefault();
		$('#contenido').load('html/contacto.html', function(){
			$(this).css({display : 'none'})
				   .fadeIn(1000);
		});
	});

	$('#expresate').on('click', function(evento) {
		evento.preventDefault();
			$('#contenido').hide(500, function(){
				$(this).load('html/expresate.html', function(){
					$(this).show(1000);
				});
			});
	});

	$('#ayuda').on('click', function(evento) {
		evento.preventDefault();
			$('#contenido').slideUp(500, function(){
				$(this).load('html/ayuda.html', function(){
					$(this).slideDown(1000);
				});
			});
	});

	$('nav').find('a').on('click', function(){
		$('nav').find('a')
		.removeClass('actual');

		$(this).addClass('actual');
	});
};

