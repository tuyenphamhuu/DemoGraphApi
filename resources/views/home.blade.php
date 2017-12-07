@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>You are logged in!</p>
                    <div class="container">
                        <form action="{{ Route('gettoken') }}" method="POST">
                          {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Enter your token :</label>
                                <div class="col-sm-10">
                                    <input type="text" name="token" placeholder="Input Your Token">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                    <h3>choose Your cat :</h3>
                    <ul class="list-group">
                      <li class="list-group-item"><a href="{{ Route('listfriends') }}">Show list friend</a></li>
                      <li class="list-group-item list-group-item-success"><a href="{{ Route('addnewfeed') }}">Add a Newfeed</a></li>
                      {{-- <li class="list-group-item list-group-item-info">Cras sit amet nibh libero</li>
                      <li class="list-group-item list-group-item-warning">Porta ac consectetur ac</li>
                      <li class="list-group-item list-group-item-danger">Vestibulum at eros</li> --}}
                    </ul>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
