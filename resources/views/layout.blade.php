<!DOCTYPE html>
<html>
<head>
	<title>Terremoti</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		.validation-error{
			color: red;
		}
	</style>
</head>
<body>
	@include('menu')
	@yield('body')
	@yield('extrascripts')
</body>
</html>