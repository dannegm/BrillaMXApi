<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# brillamx: http://ogp.me/ns/fb/brillamx#">
	<title>Foto de </title>

	<meta property="fb:app_id" content="605895716209070" />

	<meta property="og:type" content="brillamx:selfie" />
	<meta property="og:site_name" content="Brilla México" />

	<meta property="og:image" content="{{URL::asset('pictures/'.$selfie[0]->picture)}}" />
	<meta property="og:url" content="http://{{$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]}}" />

	<meta property="og:title" content="#Selfie de {{$selfie[0]->user->name}}" />
	<meta property="og:description" content="{{$selfie[0]->description}}" /> 

	<!-- JAVASCRIPT -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<!-- CSS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,700' rel='stylesheet' type='text/css'>

	<style>
		body{
			background-color: #fafafa;
			margin: 0;
			padding: 0 0 30px;
			font-family: Roboto;
		}
		.container{
			max-width:512px;
			margin:0 auto;
			padding:0 15px;
		}
		nav{
			background: #5b026b;
			height: 56px;
			color: #fff;
			overflow: hidden;
		}
		nav h2{
			float:left;
			margin-top: 15px;
		}
		nav h1{
			float: right;
			margin-top: 7px;
		}
		h1, h2, h3{
			font-weight: normal;
			margin:0;
			padding: 0;
		}
		figure{
			margin: 0;
			padding-top: 0;
		}
		.selfie{
			margin-top: 20px;
		}
		.perfil{
			width: 50px;
			height: 50px;
			border-radius: 100%;
			overflow: hidden;
			display: inline-block;
			margin: 5px 10px;
		}
		img{
			max-width: 100%;
		}
		.text{
			margin-top: 10px;
			padding: 10px;
			box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);
		}
		.text h3{
			margin:0 auto;
			padding: 10px;
			padding-bottom: 3px;
		}
		.text p{
			margin:0 auto;
			padding: 10px;
			padding-top: 0;
			color: #5b026b;
		}
		.text div{
			display: inline-block;
			vertical-align: top;
		}
	</style>
</head>
<body>
	<!-- NAV -->
	<nav>
		<div class="container">
			<h2>#Selfie</h2>
			<h1>
				<img src="{{URL::asset('img/actionbar_logo.png')}}" alt="Brilla México" title="">
			</h1>
		</div>
	</nav>

	<!-- IMAGEN -->
	<div class="container">
		<figure class="selfie">
			<img src="{{URL::asset('pictures/'.$selfie[0]->picture)}}" tiyle="" alt="">
		</figure>
	</div>

	<!-- TEXTO -->
	<div class="container">
		<div class="text">
			<figure class="perfil">
				<img src="http://graph.facebook.com/{{$selfie[0]->user->fbid}}/picture" alt="" title="">
			</figure>
			<div>
				<h3>{{$selfie[0]->user->name}}</h3>
				<p>{{$selfie[0]->description}}</p>
			</div>
		</div>
	</div>
</body>
</html>