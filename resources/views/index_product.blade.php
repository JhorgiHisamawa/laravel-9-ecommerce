<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Product</title>
</head>
<body>
    @foreach ($products as $product)
    <p>Name: {{$product->name}}</p>
    <p>Description: {{$product->description}}</p>
    <p>Rp{{$product->price}}</p>
    <p>Stock: {{$product->stock}}</p>
    <img src="{{url('storage/'.$product->image_url)}}" alt="" height="100px">
    @endforeach

</body>
</html>