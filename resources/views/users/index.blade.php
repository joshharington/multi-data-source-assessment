@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            Users
                        </div>
                        <div class="float-right">
                            <a href="{{ route('users.store') }}" class="btn btn-sm btn-primary">+ Add</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <list-users></list-users>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
