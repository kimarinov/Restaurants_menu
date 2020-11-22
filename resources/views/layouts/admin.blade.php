<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<script type="text/javascript" src="../resources/js/changeTheme.js"></script>
	<style media="screen">
	.light-theme {
			color: black;
			background-color: white;
	}
	.dark-theme {
			color: white;
			background-color: black;
	}
	</style>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body class="admin-content {{ $theme . '-theme' }}">
	<div class="container">
		@include('includes.menu')
		@yield('content')
	</div>
</body>
</html>
