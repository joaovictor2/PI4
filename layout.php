<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title><?php echo $titulo; ?></title>

  <!-- CSS  -->
  <link href="/projinteg/css/fonts.css" rel="stylesheet">
  <link href="/projinteg/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/projinteg/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!--  Scripts-->
  <script src="/projinteg/js/jquery-3.2.1.min.js"></script>
  <script src="/projinteg/js/materialize.js"></script>
  <script src="/projinteg/js/init.js"></script>
 

</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">O que eu tenho?</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/projinteg/index.php">Home</a></li>
        <li><a href="/projinteg/sintoma/index.php">Formulário</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="/projinteg/index.php">Home</a></li>
        <li><a href="/projinteg/sintoma/index.php">Formulário</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      
        <?php echo $conteudo; ?>

	
    </div>
  </div>

  </body>
</html>
