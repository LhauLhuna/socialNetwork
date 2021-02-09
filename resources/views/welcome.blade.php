@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-8 mx-auto">
				<div class="card" style="background-color: #FFF8FF;">
					<form action="{{ route('statuses.store') }}" method="POST">
						@csrf
						<div class="card-body border-0">
							<textarea class="form-control border-0" style="background-color: #FFF8FF;" name="body">¿Qué estas pensando?</textarea>
						</div>
				        <div class="card-footer">
				        	<button class="btn" style="background-color:#5e6e9e;" id="created-status">Publicar</button>
				        </div>
				    </form>
				</div>
			</div>
		</div>
	</div>
@endsection
