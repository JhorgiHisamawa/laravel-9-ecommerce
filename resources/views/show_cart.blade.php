<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    @foreach ($carts as $cart)
    <img src="{{url('storage/'.$cart->$product->image_url)}}" alt="" height="100px">
    <p>Name: {{$cart->product->name}}</p>
    <p>Amount: {{$cart->amount}}</p>
    @endforeach
</body>
</html>