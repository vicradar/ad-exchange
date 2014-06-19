<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		html {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align: center;
			height: 100%;
			background: linear-gradient(#96BFE8, #87ACD1);
		    background-repeat:no-repeat;
		    background-size: cover;
		}

		#mainContainer {
			width: 800px;
			border: 1px solid black;
			border-radius: 8px;
			margin: 5px auto 5px auto;
			background: linear-gradient(#eee , #ccc);
			box-shadow: 10px 10px 5px #888888;
			min-height: 500px;
		}

		.errorMessage {
			color: red;
			margin-top: 0;
			margin-bottom: 10px;
			margin-left: 10px;
			margin-right: 10px;
			text-align: center;
		}		
	</style>
	@yield('htmlHeader')
</head>
<body>
	@yield('body')
</body>
</html>
