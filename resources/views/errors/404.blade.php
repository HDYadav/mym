@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
					<h2> </h2>
			</div>		 
		</div>
	</div>

 
     <table class="table table-bordered">
        <tr>
            <th>Page Not Found</th>
             
        </tr>
            
            <tr>
                 <td><h2>{{ $exception->getMessage() }}</h2></td>
            </tr>
            
    </table>
	@endsection
