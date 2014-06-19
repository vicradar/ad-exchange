@extends('LoggedIn')

@section('htmlHeader')
<style>
	#adItem {
		text-align: left;
		margin: 0 20px 0 20px;
	}

	#adItem input[type="text"], #adItem select {
		float: right;
		text-align: left;
		width: 200px;
	}

	#adItem input[type="submit"] {
		float: right;
	}

	.formItem {
		clear: right;
	}

	#platformContainer {
		float: right;
		border: 1px solid black;
		margin: 5px;
		width: 200px;
	}

</style>
@stop

@section('body')
<div id="adItem">
	{{ Form::open() }}
	<div class="formItem">
		{{ Form::label('title', 'Item Title') }}
		{{ Form::text('title', isset($item) ? $item->title : '') }}
	</div>
	<div class="formItem">
		<span>Available Platforms</span>
		<div id="platformContainer">
			@foreach ($platforms as $platform) 
				<div>
					<label>
						{{ Form::checkbox('platform[]', $platform->identifier, in_array($platform->identifier, isset($item) ? $item->supportedPlatforms : [])) }}
						{{ $platform->title }}
					</label>
				</div>
			@endforeach
		</div>
	</div>
	<div class="formItem">
		{{ Form::label('appurl', 'Application URL') }}
		{{ Form::text('appurl', isset($item) ? $item->appUrl : '') }}
	</div>
	<div class="formItem">
		{{ Form::label('storeurl', 'Store URL') }}
		{{ Form::text('storeurl', isset($item) ? $item->storeUrl : '') }}
	</div>
	<div class="formItem">
		{{ Form::label('rootFile', 'Root File') }}
		<?php 
			$list = ['' => '(none)'];
			foreach ($files as $file) {
				$list[$file->identifier] = $file->title;
			}
			echo Form::select('rootFile', $list, isset($item) ? $item->rootFileIdentifier : null);
		?>
	</div>
	<div class="formItem">
		{{ Form::submit('Save Changes') }}
	</div>
	{{ Form::close() }}
</div>
@stop