@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order Detail') }}</div>

                <div class="card-body">
                    <h5 class="card-title">Order ID: {{ $order->id }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">User: {{ $order->user->name }}</h6>

                    <p class="card-text">Status: {{ $order->is_paid ? 'Paid' : 'Unpaid' }}</p>
                    
                    <hr>
                    @foreach ($order->transactions as $transaction)
                        <p class="mb-2">{{ $transaction->product->name }} x {{ $transaction->amount }}</p>
                    @endforeach
                    <hr>

                    @if (!$order->is_paid && !$order->payment_receipt)
                        <form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="payment_receipt">Payment Receipt</label>
                                <input type="file" class="form-control" id="payment_receipt" name="payment_receipt">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
