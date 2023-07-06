@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-8 offset-2">
<div class="card">
    <div class="card-header">
        <h2 class="text-center text-dark"> Product Management </h2>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{config('base_url')}}/products/{{$data->id}}" method="post">
            @CSRF
            <div class="form-group">
                <label class="control-label col-sm-3">Product Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="name" value="{{$data->name}}" required>
                    @error('name')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Categery:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="categery" name="categery" required>
                        @foreach($categories as $k=>$arr)
                        @if($data->categery == $k)
                        <option value="{{$k}}" selected>{{$arr}}</option>
                        @else
                        <option value="{{$k}}">{{$arr}}</option>
                        @endif
                        @endforeach

                    </select>
                    @error('categery')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Price:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price" value="{{$data->price}}" required>
                </div>
                @error('price')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Quantity:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="qty" placeholder="Enter Quantity" value="{{$data->qty}}" name="qty">
                    @error('qty')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description">{{$data->description}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection