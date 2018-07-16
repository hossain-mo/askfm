@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <div class="card-body">
                            <form method="POST" action="{{ URL::to('setting') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">setting</button>
                            </form>
                            <form method="POST" action="{{ URL::to('notification') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">notification</button>
                            </form>
                            <form method="POST" action="{{ URL::to('showFriends') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">friends</button>
                            </form>
                            <form method="POST" action="{{ URL::to('profile') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">profile</button>
                            </form>
                            <form method="POST" action="{{ URL::to('addFriends') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">add friend</button>

                            </form>
                            <form method="POST" action="{{ URL::to('google') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">google Map</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
