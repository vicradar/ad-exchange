@extends('base')

@section('css')
		.welcome {
			width: 300px;
			height: 220px;
			margin-left: -150px;
			margin-top: -110px;			
			position: absolute;
			left: 50%;
			top: 50%;

			border: 1px solid black;
			border-radius: 5px;
			background: linear-gradient(#eee , #ccc);
			box-shadow: 10px 10px 5px #888888;

			text-align: center;
		}

		.welcome input {
			text-align: center;
		}

		#logo {
			margin-top: 10px;
			margin-bottom: 10px;
			height: 75px;
			width: 75px;
			background: red;
			display: inline-block;
		}
@stop

@section('body');
	<div class="welcome">
		<div id="logo"></div>
		<div class="errorMessage"><?php if (isset($errorMessage)) {echo $errorMessage; } ?></div>
		<form method="post" action="<?php echo Request::url(); ?>">
			<div><input type="text" placeholder="Email Address" name="username" id="username"/></div>
			<div><input type="password" placeholder="Password" name="password" id="password" /></div>
			<div><input type="submit" value="Go" /></div>
		</form>
	</div>
@stop
