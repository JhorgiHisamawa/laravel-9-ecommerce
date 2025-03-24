<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <!-- show error message -->
    @if ($errors->any()) 
        @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    @endif

    @foreach ($carts as $cart)
    <img src="{{ url('storage/' . $cart->product->image_url) }}" alt="" height="100px">
    <p>Name: {{$cart->product->name}}</p>
    <br>
    <form action="{{ route('update_cart', $cart) }}" method="post">
        @method('patch')
        @csrf 
        <input type="number" name="amount" value="{{$cart->amount}}">
        <button type="submit">Update</button>
        </form>
    @endforeach
</body>
</html>