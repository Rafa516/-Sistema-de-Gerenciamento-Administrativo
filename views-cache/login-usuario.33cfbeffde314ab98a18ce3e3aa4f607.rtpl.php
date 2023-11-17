<?php if(!class_exists('Rain\Tpl')){exit;}?> <!DOCTYPE html>
<html lang="pt-br">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sistema  </title>
		<link href="/res/user/img/icon.png" rel="icon">
		<link rel="stylesheet" href="/res/user/css/login_style.css">
		<link rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
		<!-- CSS only -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
			crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
			crossorigin="anonymous"></script>
		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
			charset="utf-8"></script>
	</head>

	<body>

		<!--form area start-->

		<center><img src="res/user/img/logo.png" class="logo" ></center>

		<div class="form">
			<form class="login-form" action="/login" method="post">

				<?php if( $profileMsg != '' ){ ?>

				<div class="alert alert-success">
					<?php echo $profileMsg; ?>

				</div>
				<?php } ?>

				<?php if( $error != '' ){ ?>

				<div class="alert alert-danger">
					<?php echo $error; ?>

				</div>
				<?php } ?>


				<?php if( $errorRegister != '' ){ ?>

				<div class="alert alert-danger">
					<?php echo $errorRegister; ?>

				</div>
				<?php } ?>



				<input class="user-login" type="text" name="login" placeholder="login"
					required>
				<input class="user-login" type="password" name="senha" placeholder="Senha"
					required>


				<input class="btn" type="submit" name="" value="Acessar"><br><br>
				<div class="options-01">
				<label class="remember-me"><input type="checkbox" name="">Lembrar</label>
				<a href="/recuperar-senha">Recuperar senha</a>
			</div>

				
				<div class="options-02">
					<p>Não é registrado? <a href="#">Crie uma conta</a></p>
					<p>&copy; Sistema <span id="ano"></span> </p>
				</div>
			</form>


			<!--login form end-->
			<!--signup form start-->
			
			<form class="signup-form" action="/registro" method="post"><br>
			
			Nome
			<input class="user-input" id="nome_user"type="text" name="nome_user" placeholder="Digite seu nome" required>
			Email
			<input class="user-input" id="email"type="email" name="email" placeholder="Digite seu e-mail " required>
			login
			<input class="user-input" id="login"type="text" name="login" placeholder="Digite seu login">
			Senha
			<input class="user-input"  id="senha"type="password" name="senha" placeholder="Digite sua senha" required>
		   
			<input class="btn" type="submit" name="" value="Registrar">

			<div class="options-02">
				<p> <a href="#">Voltar</a></p>
			</div>
		</form>
		<!--signup form end-->
	</div>
	<!--form area end-->


			<!--signup form end-->
		</div>
		<!--form area end-->

		<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

		<script src="/res/user/js/functions.js"></script>

		<script type="text/javascript">
		$('.options-02 a').click(function () {
			$('form').animate({
				height: "toggle", opacity: "toggle"
			}, "slow");
		});
	</script>
	</body>

</html>

<script >
	let dataAtual = new Date();
	let anoAtual = dataAtual.getFullYear();
	document.getElementById('ano').innerText = anoAtual;
  </script>