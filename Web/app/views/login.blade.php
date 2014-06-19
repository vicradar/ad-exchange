@extends('base')

@section('htmlHeader')
	<style>
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
	</style>
@stop

@section('body')
<div class="welcome">
	<div id="logo"></div>
	<div class="errorMessage">{{ isset($errorMessage) ? $errorMessage : "" }}</div>
	{{ Form::open(['method' => 'post']) }}
    {{ Form::token() }}
	<div>{{ Form::text('username', Input::old('username'),  ['placeholder'=>'Email Address']) }} </div>
	
	<div>{{ Form::password('password', ['placeholder'=>'Password']) }}</div>
	
	<div>{{ Form::submit('Login') }}</div>
	
	{{ Form::close() }}
</div>
@stop
