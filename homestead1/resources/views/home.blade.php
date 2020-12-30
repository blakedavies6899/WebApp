@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __("Welcome to Blake's Blogs!") }}
                    
                </div>
                <button type="button" onclick="location.href='http://homestead1.test/posts'">Go to Posts</button>
            </div>
        </div>
    </div>
</div>
@endsection
