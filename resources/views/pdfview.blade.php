@extends('layouts.app')

@section('content')
<div class="container">
	
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
                <a href="{{ route('frontdesk.pdfTest',['download'=>'pdf']) }}">Download PDF</a>
                <table>

		<tr>

			<th>No</th>

		

		</tr>

		@foreach ($users as $u)

		<tr>

			<td>{{ $u->id }}</td>

		

		</tr>

		@endforeach

	</table>
            </div>
        </div>
    </div>
</div>
@endsection