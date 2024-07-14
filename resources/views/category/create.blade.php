@extends('layouts.master-user')
@push('styles')
    {{-- <style>
        .form-control {
            height: 45px;
            border: 1px solid #DCDFE8;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        /* Add more custom styles here */
    </style> --}}
@endpush
@section('content')
    <div class="container">
        <h1>Add Category</h1>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="category">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" required>
            </div>
        <button type="submit" class="btn btn-primary">Save Category</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".js-example-responsive").select2({
                width: 'resolve'

            });
            var defaultValue = 'your_default_value'; // set your default value here
            $(".js-example-responsive").val(defaultValue).trigger('change');
        });
    </script>
@endpush
