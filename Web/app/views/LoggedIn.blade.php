{{-- 
	background Blue: #87ACD1;
	Darker Blue: #3D6B99;
	Aqua: #00FFF8;
	Orange: #FF6840;
	Red: #CC2014;
--}}<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ isset($title) ? $title : 'Welcome' }}</title>
	<style>
		/*@import url(//fonts.googleapis.com/css?family=Lato:700);*/

		html {
			margin:0;
			/*font-family:'Lato', sans-serif;*/
			text-align: center;
			background: linear-gradient(#96BFE8, #87ACD1);
		    background-repeat:no-repeat;
		    background-size: cover;
		    min-height: 100%;
		}

		#mainContainer {
			width: 800px;
			border: 1px solid black;
			border-radius: 8px;
			margin: 0 auto 5px auto;
			background: linear-gradient(#eee , #ccc);
			box-shadow: 10px 10px 5px #888888;
			min-height: 500px;
		}

		#menuContainer {
			width: 200px;
			float: left;
		}

		#menuContainer ul {
			margin: 0;
			padding: 0;
			list-style: none;
			text-align: center;
		}

		#menuContainer a {
			text-decoration: none;			
		}

		#menuContainer li {
			margin: 3px;
		}

		#menuContainer ul:first-child {
			margin-top: 0;
		}


		#menuContainer div {
			background: #3D6B99;
			text-decoration: none;
			font-size:  1em;
			color: black;
			border: 1px solid black;
			padding: 3px;
		}

		#menuContainer div:hover {
			background-color: #00FFF8;
		}

		#menuContainer li {
			display: block;
		}

		#contentContainer {
			padding: 0 0 0 200px;
		}

		#headerContainer {
			min-height: 100px;
			clear: both;
		}

		#logout {
			font: .8em;
			float: right;
			margin-right: 10px;
		}

		#headerContainer h1 {
			margin-left: 5px;
			margin-right: 5px;
			margin-bottom: 0;
		}

		#footerContainer {
			clear: both;
		}

		.errorMessage {
			color: #CC2014;
			margin-top: 0;
			margin-bottom: 10px;
			margin-left: 10px;
			margin-right: 10px;
			text-align: center;
		}

		.clear {
			clear: both;
		}
	</style>
	@yield('htmlHeader')
</head>
<body>
	<div id="mainContainer">
		<div id="logout"><a href="{{ URL::action('LoginController@logout') }}">Log Out</a></div>
		<div id="headerContainer">
			<h1>{{ isset($title) ? $title : 'Welcome' }}</h1>
		</div>
		<div id="menuContainer">
			<ul>
				<li><a href="{{ URL::action('AdController@index') }}"><div>Ads</div></a></li>
				<li><a href="{{ URL::route('todo') }}"><div>Platforms</div></a></li>
				<li><a href="{{ URL::route('todo') }}"><div>Reports</div></a></li>
				<li><a href="{{ URL::route('todo') }}"><div>User Management</div></a></li>
				<li><a href="{{ URL::route('logout') }}"><div>Logout</div></a></li>
			</ul>
		</div>
		<div id="contentContainer">
			@yield('body')
		</div>
		<div id="footerContainer"></div>
	</div>
	<div class="clear"></div>
</body>
</html>
