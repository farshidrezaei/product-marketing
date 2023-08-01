<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirecting...</title>

    <meta name="title" content="{{$link->product->title}}">
    <meta name="description" content="{{$link->product->description}}">

    {{--og--}}
    <meta property="og:title" content="{{$link->product->title}}"/>
    <meta property="og:type" content="product"/>
    <meta property="og:url" content="{{$link->url}}"/>
    <meta property="og:image" content="{{$link->product->images[0]??null}}"/>
    <meta property="og:description" content="{{$link->product->description}}">

    {{--twitter--}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{$link->url}}">
    <meta property="twitter:title" content="{{$link->product->title}}">
    <meta property="twitter:description" content="{{$link->product->description}}">
    <meta property="twitter:image" content="{{$link->product->images[0]??null}}">

    {{--schema--}}
    <meta itemprop="name" content="{{$link->product->title}}"/>
    <meta itemprop="description" content="{{$link->product->description}}"/>
    <meta itemprop="image" content="{{$link->product->images[0]??null}}"/>

</head>
<body>
<h3>Redirecting...</h3>
<script>
    window.location.href = '{{$link->product->url}}';
</script>
</body>
</html>