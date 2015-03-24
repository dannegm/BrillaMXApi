<!DOCTYPE html>
<html>
<head>
	<title>Brilla México</title>

	<meta name="viewport" content="initial-scale=1, maximum-scale=1">

	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<!-- STYLES -->
	<link href='http://fonts.googleapis.com/css?family=Raleway:400' rel='stylesheet' type='text/css'>
	<link href='{{URL::asset('css/style.css')}}' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="menu">
		<div class="container">
			<div class="row">
				<div class="title">
					<img src="{{URL::asset('img/logo.png')}}">
				</div>
				<div class="supcontent">
					<nav>
						<ul>
							<li>
								<a href="#app">
									App
								</a>
							</li>
							<li>
								<a href="#download">
									Descarga
								</a>
							</li>
							<li>
								<a href="#concurso">
									Concurso
								</a>
							</li>
						</ul>
					</nav>
					<h2>¿Ya hiciste el compromiso?</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div id="steps" class="steps">
			<ul>
				<div class="line"></div>
				<li>
					<span>
						<img src="{{URL::asset('img/descarga.png')}}" alt="" title="">
					</span>
					<p>Descarga <br>la app</p>
				</li>
				<li>
					<span>
						<img src="{{URL::asset('img/registrate.png')}}" alt="" title="">
					</span>
					<p>Registrate <br>en el concurso</p>
				</li>
				<li>
					<span>
						<img src="{{URL::asset('img/toma.png')}}" alt="" title="">
					</span>
					<p>Toma tu <br>#selfie</p>
				</li>
				<li>
					<span>
						<img src="{{URL::asset('img/comparte.png')}}" alt="" title="">
					</span>
					<p>Comparte en <br>redes sociales</p>
				</li>
				<li>
					<span>
						<img src="{{URL::asset('img/gana.png')}}" alt="" title="">
					</span>
					<p>Participa<br> y gana</p>
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div id="app" class="video-container">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/t1UPLPS419E" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="download">
				<h3 id="download" class="title-download">DESCARGA GRATIS</h3>
				<div class="stores">
					<a style="cursor: not-allowed;" id="disabled" href="#">
						<img style="opacity:0.3" src="{{URL::asset('img/app-store.png')}}" alt="" title="">
					</a>
					<a href="https://play.google.com/store/apps/details?id=mx.ambmultimedia.brillamexico">
						<img src="{{URL::asset('img/play-store.png')}}" alt="" title="">
					</a>
				</div>
				<p>
					
				</p>
			</div>
		</div>
	</div>
	<div class="container" id="concurso">
		<div class="row">
			<h3 class="title-bases">Bases del concurso (Proximamente)</h3>
		</div>
	</div>
	<div class="container">
		<div class="green">
			
		</div>
		<div class="row">
			<p class="concurso">

			</p>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<ul class="sociales">
				<li>
					<a href="https://twitter.com/brillamexico">
						<img src="{{URL::asset('img/ic_twit.jpg')}}" alt="" title="">
						<span>@BrillaMexico</span>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/BrillaMexico">
						<img src="{{URL::asset('img/ic_face.jpg')}}" alt="" title="">
						<span>/BrillaMexico</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</body>
<script>
	$(document).ready(function(){
		$(window).load(function(){
			line();
		});

		$(window).resize(function(){
			line();
		});

		$('nav a').click(function(e){
			e.preventDefault();
			id = $(this).attr('href');
			$('html, body').animate({
				scrollTop: $(id).offset().top - $('.menu').outerHeight()
			}, 1000);
		});

		$('#disabled').click(function(e){
			return false;
		});
		function line(){
			width = $('.line').width();
			$('.line').css({
				'margin-left':-(width/2),
			});
			if($(window).width() < 868){
				$('body').css({
					'padding-top':$('.menu').outerHeight(),
				});
			}else{
				console.log($(window).width());
				$('body').css({
					'padding-top':$('.menu').height() + 30,
				});
				$(document).scroll(function() {
					var y = $(this).scrollTop();
					if (y > $('.menu').height()) {
						$('.menu').css({
							height: 68,
							paddingTop: 10,
						});
						$('.menu h2').hide();
						$('.title img').css({
							height: 58,
							width: 'auto',
							display: 'inline-block',
						});
					} else {
						$('.menu').css({
							height: 170,
							paddingTop: 30,
						});
						$('.menu h2').show();
						$('.title img').css({
							height: 'auto',
							width: 'auto',
							display: 'inline-block',
						});
					}
				});
			}
		}
	});
</script>
</html>