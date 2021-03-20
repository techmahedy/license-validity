@extends('welcome')
@push('css')
<style>
    .error{color:red;}
</style>
@endpush
@section('content')
    @if (session()->has('message'))
        <div class="error">{{ session()->get('message') }}</div>
    @endif
    <form action="{{ action('AuthController@login') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="">Phone Number</label>
        <input type="text" name="mobile_number" id="" placeholder="Enter first name">
        @if($errors->has('mobile_number'))
            <div class="error">{{ $errors->first('mobile_number') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" id="" placeholder="Enter password">
        @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <input type="submit" value="Submit" class="btn btn-success">
    </form>
@endsection