@extends('welcome')
@push('css')
<style>
    .error{color:red;}
</style>
@endpush
@section('content')
    <form action="{{ action('AuthController@register') }}" method="post">
        @csrf
    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" name="first_name" id="" placeholder="Enter first name">
        @if($errors->has('first_name'))
            <div class="error">{{ $errors->first('first_name') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" name="last_name" id="" placeholder="Enter last name">
        @if($errors->has('last_name'))
            <div class="error">{{ $errors->first('last_name') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Phone Number</label>
        <input type="text" name="mobile_number" id="" placeholder="Enter first name">
        @if($errors->has('mobile_number'))
            <div class="error">{{ $errors->first('mobile_number') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" id="" placeholder="Email" pattern="\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b">
        @if($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" id="" placeholder="Enter password">
        @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Confirm Password</label>
        <input type="password" name="password_confirmation" id="" placeholder="Confirm password">
        @if($errors->has('password_confirmation'))
            <div class="error">{{ $errors->first('password_confirmation') }}</div>
        @endif
    </div>
    <input type="submit" value="Submit" class="btn btn-success">
    </form>
@endsection