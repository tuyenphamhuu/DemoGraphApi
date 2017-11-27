@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ Route('postnewfeed') }}">
            {{ csrf_field() }}
          <div class="form-group">
            <label for="Post">Detail Post:</label>
            <input type="text" name="message" class="form-control">
          </div>
          {{-- <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd">
          </div> --}}
          <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection