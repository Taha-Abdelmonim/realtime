@extends('layouts.app')
@section('content')
  <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$responseData->id}}"></script>
  <form action="{{ route('callbackCheckout') }}" class="paymentWidgets" data-brands="VISA MASTER AMEX MADA"></form>
@endsection
@section("script")
@endsection
{{--http://127.0.0.1:8001/payment/callbackCheckout?id=0D55AAB15CB2D92AFD591270364A5471.uat01-vm-tx03&resourcePath=%2Fv1%2Fcheckouts%2F0D55AAB15CB2D92AFD591270364A5471.uat01-vm-tx03%2Fpayment--}}
