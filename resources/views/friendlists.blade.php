@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>List Friend Facebook:</h1></div>
                <table id="example" class="table table-hover">
                	<thead class="thead-dark">
	                	<tr>
                            <th scope="col">#</th>
	                		<th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Link Face</th>
	                		<th scope="col">Like New feed of His/Her</th>
	                		<th scope="col">Images</th>
	                	</tr>
                	</thead>
                	<tbody>
                		@foreach ($output as $key => $items)
                		<tr>
                            <td scope="row">
                                {{ ++$key}}
                            </td>
                            <td scope="row">
                                {{ $items['id'] }}
                            </td>
                			<td>
                				{{ $items['name'] }}
                			</td>
                            <td>
                                <a href="https://facebook.com/{{ $items['id'] }}">Facebook of {{ $items['name'] }}</a>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ Route('likefirstnf', $items['id']) }}">Click if you Love ...
                                </a>
                            </td>
                			<td>
                				<img src="{{ $items['picture']['data']['url'] }}" alt="">
                			</td>
                		</tr>
                		 @endforeach
                	</tbody>
                    {{-- {{ $items->links() }} --}}
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#example').DataTable();
    });
 </script>
@endsection

