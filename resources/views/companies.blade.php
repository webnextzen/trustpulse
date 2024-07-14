@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             <div class="card-body">
                <ul>
                   @foreach ($companies as $company)
                        <li><a href="{{ route('welcome.reviws', $company->id) }}" class="btn btn-warning">{{ $company->company_name }}</a></li>
                   @endforeach
                </ul>
             </div>
            </div>
        </div>
    </div>
</div>
@endsection
