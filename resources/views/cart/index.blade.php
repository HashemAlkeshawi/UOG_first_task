@extends('mainTemplate')
@section('title')
<title>Home</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 10;" class="container">
    <div class="page-header">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>

    <div class="row">
        <div class="col-auto">
            <h1 class="header">Cart Items:</h1>
        </div>
        <div class="col-auto">
            <form method="POST" action="{{URL('cart/empty')}}">
                @csrf
                @method("DELETE")
                <button class="btn btn-danger" name="Delete" type="submit">Empty Cart</button>
            </form>
        </div>
    </div>
    <div class="row">
        @if(isset($items))
        @foreach($items as $item)
        <div class="col-auto">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" width="100" height="220" src="{{asset('storage/'.$item->image)}}" alt="Card image cap">
                <div class="card-body">
                    <a href="{{URL('item/' . $item->id)}}" class="link-dark">
                        <h5 class="card-title">{{$item->name}}</h5>
                    </a>
                    <h6 class="card-text">{{$item->brand->name}}</h6>
                </div>
                <div class="row ">
                    <div class="col-auto">
                        <h6 class="form-check-label" style="margin-left: 10px;">Quantity: {{$item->quantity}}</label>

                    </div>
                    <div class="col-auto" style="margin-left: 10px;">
                        <form method="POST" action="{{URL('cart')}}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" value="{{$item->id}}" name="item_id">
                            <button class="btn btn-danger" name="Delete" type="submit">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
        </div>

        @endforeach
        @endif
    </div>

    <br>
    <br>

    <br>

</div>


@endsection