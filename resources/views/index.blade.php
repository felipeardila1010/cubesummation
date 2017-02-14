@extends('app')

@section('body')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Ejercicio 1 (CODING CHALLENGE)</div>

				<div class="panel-body">

					<form method="POST" action="{{ $routePost }}" accept-charset="UTF-8">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="container">
						<p >Solución de ejercicio Hackerrank (Cube Summation)</p>
						     <h3>Campos</h3>
						    <hr>
						    <div class="row">
						        <div class="col-lg-5">
						            <div class="form-group">
						                <label>Valor T (Número de casos de prueba):</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						                    <input type="number" class="form-control" name="T" id="T" value="2" required readonly>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Valor N y M:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
						                    <input type="text" class="form-control" name="NyM[]" id="NyM1" value="4 5" required readonly>
						                </div>
						            </div>
						            <hr>
						            <h4>Consultas</h4>
						            <hr>
						            <div class="form-group">
						                <label>Consulta 1:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query1[]" id="query1" value="UPDATE 2 2 2 4" required>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Consulta 2:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query1[]" id="query2" value="QUERY 1 1 1 3 3 3" required>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Consulta 3:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query1[]" id="query3" value="UPDATE 1 1 1 23" required>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Consulta 4:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query1[]" id="query4" value="QUERY 2 2 2 4 4 4" required>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Consulta 5:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query1[]" id="query5" value="QUERY 1 1 1 3 3 3" required>
						                </div>
						            </div>
						            <hr>
						            <div class="form-group">
						                <label>Valor N y M:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
						                    <input type="text" class="form-control" name="NyM[]" id="NyM2" value="2 4" required readonly>
						                </div>
						            </div>
						            <hr>
						            <h4>Consultas</h4>
						            <hr>
						            <div class="form-group">
						                <label>Consulta 6:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query2[]" id="query6" value="UPDATE 2 2 2 1" required>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Consulta 7:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query2[]" id="query7" value="QUERY 1 1 1 1 1 1" required>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Consulta 8:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query2[]" id="query8" value="QUERY 1 1 1 2 2 2" required>
						                </div>
						            </div>
						            <div class="form-group">
						                <label>Consulta 9:</label>
						                <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						                    <input type="text" class="form-control" name="query2[]" id="query9" value="QUERY 2 2 2 2 2 2" required>
						                </div>
						            </div>
						            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary pull-right">
						        </div>
						    </div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
