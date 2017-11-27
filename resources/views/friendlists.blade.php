@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List friend</div>
                <table class="table table-hover">
                	<thead class="thead-dark">
	                	<tr>
	                		<th scope="col">#</th>
	                		<th scope="col">Name</th>
	                		<th scope="col">Images</th>
	                	</tr>
                	</thead>
                	<tbody>
                		@foreach ($output->data as $key => $items)
                		<tr>
                			<td scope="row">
                				{{ ++$key}}
                			</td>
                			<td>
                				{{ $items->name }}
                			</td>
                			<td>
                				<img src="{{ $items->picture->data->url }}" alt="">
                			</td>
                		</tr>
                		
                		 @endforeach
                	</tbody>
                </table>
                
	             {{-- {{ dd($output)  }} --}}
            </div>
        </div>
    </div>
</div>
@endsection