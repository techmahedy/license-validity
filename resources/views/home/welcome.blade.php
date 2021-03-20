@extends('welcome')
@push('css')
@endpush
@section('content')
   <h1>Welcome {{ Auth::user()->full_name }}</h1>
@endsection