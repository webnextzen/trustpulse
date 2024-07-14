@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                  <h1>Company Details</h1>
                 <p>Company Name : {{ $companydetails->company_name }}</p>
                 <p>Company Industry : {{ $companydetails->industry }}</p>
                 <p>Company Category : {{ $categorydetails->category_name }}</p>
                  <h2>Customer Feedbacks:</h2>
                   @foreach($feedbacks as $feedback)
                   <a href="{{ route('employee_profile.index', $feedback->employee->employee_id) }}" class="">{{ $feedback->employee->first_name }}</a>
                   <p>{{ $feedback->feedback }}</p>
                   @endforeach
                   <a href="/register" class="btn btn-success">Register as customer to give feedback</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

