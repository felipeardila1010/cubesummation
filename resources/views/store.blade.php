@extends('app')

@section('body')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">RESULTADO DEL Ejercicio 1 (CODING CHALLENGE)</div>

				<div class="panel-body">


					@foreach ($response as $result)
					    <p>{{ $result }}</p><br/>
					@endforeach

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
