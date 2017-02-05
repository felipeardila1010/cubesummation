<!DOCTYPE html>
<html lang="es" @yield('class_html')>
	<head>
		<meta charset="utf-8"/>
		<title> @yield('title', 'Bienvenido al Ejercicio Cube Summation') </title>
		@include('includes.index')
		@yield('css')
		@yield('meta')
	</head>
	<body @yield('class_body')>
		@yield('body')
		@yield('js')
	</body>
</html>

