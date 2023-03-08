@extends('layouts.app')
@section('content')
  <form action="{{route('checkout')}}" method="post">
    @csrf
    <input name="price" placeholder="amount" />
    <button type="submit">pay</button>
  </form>
@endsection
@section("script")
@endsection
