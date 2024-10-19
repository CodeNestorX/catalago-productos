<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom-login.css') }}"> 
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="{{ asset('imagenes/logo.svg') }}" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required autofocus>
							@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass @error('password') is-invalid @enderror" placeholder="Contraseña" required>
							@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" name="remember" class="custom-control-input" id="customControlInline" {{ old('remember') ? 'checked' : '' }}>
								<label class="custom-control-label" for="customControlInline">Recuérdame</label>
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
							<button type="submit" class="btn login_btn">Iniciar sesión</button>
						</div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						¿No tienes una cuenta? <a href="{{ route('register') }}" class="ml-2">Regístrate</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
