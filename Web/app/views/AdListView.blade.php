@extends('LoggedIn')

@section('htmlHeader')
	<style>
		.adList {
			margin: 10px;
			padding: 5px;
		}

		.tableWrapper {
			border: 1px solid black;
			min-height: 400px;
		}

		#itemTable {
			border-collapse: collapse;
			text-align: left;
		}

		#itemTable td {
			border: 1px solid black;
		}

		#itemTable td:first-child {
			border-left: 0;
		}

		#selectColumn {
			width: 25px;
		}

		#titleColumn {
			width: 375px;
		}

		#platformColumn {
			width: 200px;
		}

		.buttonHolder {
			text-align: left;
			margin-top: 5px;
		}

		.floatRight {
			float: right;
		}

	</style>

@stop

@section('body')
<div class="adList">
	{{ Form::open() }}
	<div class="tableWrapper">
		<table id="itemTable">
			<col id="selectColumn" />
			<col id="titleColumn" />
			<col id="platformColumn" />
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Title</th>
					<th>Platform</th>
				</tr>
			</thead>
			<tbody>
				@if (isset($adList) AND (count($adList) > 0))
					@foreach ($adList as $anAd)
						<tr>
							<td>
								{{ Form::checkbox('doomed[]', $anAd->identifier) }}
							</td>
							<td>
								<a href="{{ URL::action('AdController@edit', ['id' => $anAd->identifier]) }}">
									{{{ $anAd->title }}}
								</a>
							</td>
							<td>TODO</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="3">No Items to Display</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
	<div class="buttonHolder">
		{{ Form::submit('Delete Selected') }}
		<div class="floatRight">
			<a href="{{ URL::action('AdController@create') }}">Create New</a>
		</div>

	</div>
	{{ Form::close() }}
</div>
@stop