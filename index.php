<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>O que eu tenho?</title>
	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template -->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css'>
	<!-- Custom styles for this template -->
	<link href="css/grayscale.min.css" rel="stylesheet">
	<link type="text/css" href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>

<body id="page-top">

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="#page-top">O que eu tenho?</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fa fa-bars"></i></button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#about">Sobre nós</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#diagnostico">Faça seu diagnóstico</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#medico">Área médica</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#contact">Contato</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Intro Header -->
	<header class="masthead">
		<div class="intro-body">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<h1 class="brand-heading">O que eu tenho?</h1>
						<p class="intro-text">Frase de Efeito.<br>Created by Us.</p>
						<a href="#about" class="btn btn-circle js-scroll-trigger">
							<i class="fa fa-angle-double-down animated"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- About Section -->
	<section id="about" class="content-section text-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<h2>Sobre nosso produto</h2>
					<p>Nosso produto visa sanar as dúvidas da sociedade sobre sintomas e prováveis doenças, visto que buscas aleatórias nem sempre retornam resultados confiáveis.</p>
					<p>“O que eu tenho?” entra no mercado como uma plataforma que tem como principal objetivo apresentar um pré-diagnóstico e um médico responsável pelo tratamento.</p>
				</div>
			</div>
			<a href="#diagnostico" class="btn btn-circle js-scroll-trigger">
				<i class="fa fa-angle-double-down animated"></i>
			</a>
		</div>
	</section>

	<!-- Download Section --> 
	<section id="diagnostico" class="download-section content-section text-center">
		<div class="container">
			<div class="col-lg-12 mx-auto">
				<h2>Faça sua consulta</h2>

				<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/projinteg/model/PiModel.php";
				$piModel = new PiModel();
				$sintomas = $piModel->listarSintomas();?>

				<div class="card-panel">
					<h4 class="center-align">Selecione seu sintoma mais aparente</h4>
					<form method="post" id="formsintoma">
						<div class="container">
							<div class="row">
								<div class="col">
									<?php foreach($sintomas as $s):  
									$cont = 0;
									$cont = $cont + 1;?>
									<input class="filled-in" type="radio" id="sintoma<?=$cont?>" value="<?= $s["idSintoma"]?>" name="primario"?>
									<label for="sintoma<?=$cont?>"><?= $s["DescricaoSintoma"]?></label><br>
								<?php endforeach;?>
							</div>
						</div>
						<br>
						<ul class="list-inline banner-social-buttons">
							<li class="list-inline-item">
								<button class="btn btn-default btn-lg" type="button" name="finalizar" id="finalizar" onclick="enviar('/projinteg/controller/PiController.php?acao=finalizar')">
									<span class="network-name">Analisar</span>
								</button>
							</li>
							<li class="list-inline-item">
								<button class="btn btn-default btn-lg" type="button" name="continuar" id="continuar" onclick="enviar('/projinteg/controller/PiController.php?acao=continuar')">
									<span class="network-name">Continuar</span>
								</button>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>	
		<div id="mensagem"></div>
	</section>


	<!-- Medico Section -->
	<section id="medico" class="content-section text-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<h2>Cadastro de Médico</h2>
					<p>Cadastre-se para que nossos clientes saibam quem procurar após nosso pré diagnóstico.</p>
					<form method="post" id="formmed" action="/projinteg/controller/MedController.php?">   
						<div class="row">
							<div class="form-group col-12">
								<label for="Nome">Nome</label>
								<input id="nome" type="text" name="nome" class="form-control" > 
							</div>
						</div>
						<div class="row">  
							<div class="form-group col-6">                                  
								<label for="CRM">CRM</label>
								<input id="CRM" type="number" name="CRM" class="form-control" maxlength="10">
							</div>
							<div class="form-group col-6">
								<label for="especialidade">Especialidade</label>
								<select class="form-control" name="IdEspecialidade" id="especialidade">
									<option seleted disabled>Selecione sua especialidade</option>                    
								</select>
							</div>
						</div>
						<br>
						<button type="submit" class="btn btn-default" name="salvar">Salvar</button>
					</form>
					<a href="#diagnostico" class="btn btn-circle js-scroll-trigger">
						<i class="fa fa-angle-double-down animated"></i>
					</a>
				</div>
			</div>
		</div>
	</section>


	<!-- Contact Section -->
	<section id="contact" class="content-section text-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<h2>Contact Start Bootstrap</h2>
					<p>Feel free to leave us a comment on the
						<a href="http://startbootstrap.com/template-overviews/grayscale/">Grayscale template overview page</a>
					on Start Bootstrap to give some feedback about this theme!</p>
					<ul class="list-inline banner-social-buttons">
						<li class="list-inline-item">
							<a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg">
								<i class="fa fa-twitter fa-fw"></i>
								<span class="network-name">Twitter</span>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="https://github.com/BlackrockDigital/startbootstrap" class="btn btn-default btn-lg">
								<i class="fa fa-github fa-fw"></i>
								<span class="network-name">Github</span>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg">
								<i class="fa fa-google-plus fa-fw"></i>
								<span class="network-name">Google+</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer>
		<div class="container text-center">
			<p>Copyright &copy; Your Website 2017</p>
		</div>
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Plugin JavaScript -->
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
	<!-- Custom scripts for this template -->
	<script src="js/grayscale.min.js"></script>
	<script type="text/javascript">
		function enviar(url)
		{
			$.ajax({
				url: url,
				method: $("#formsintoma").attr("method"),
				data: $("#formsintoma").serialize(),
				success: function(data){
					$("#mensagem").html(data);
					$("#formsintoma").trigger('reset'); 
					$("#formsintoma").hide("slow");
				}
			})
		}	
	</script>
</body>
</html>