@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <h1>All Categories</h1>
                 <ul>
                   @foreach ($categories as $category)
                    <li><a href="{{ route('welcome.companylist', $category->id) }}" class="btn btn-warning">{{ $category->category_name }}</a></li>
                  @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

