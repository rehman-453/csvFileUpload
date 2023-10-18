@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb" style="padding: 10px;">
            <div class="pull-left">
                <h2>CSV File Upload</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('create') }}"> Add New CSV</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Product Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
        </tr>
        @foreach($products as $i => $row)
            <tr>
                <td class="text-center">{{++$i}}</td>
                <td class="text-center">{{$row->prod_id}}</td>
                <td>{{$row->name}}</td>
                <td>Rs. {{$row->price}}</td>
                <td>{{$row->description}}</td>
                <td class="text-center">
                    @if(isset($row->image))
                        <img src="{{$row->image}}" alt="{{$row->name}}" width="50" height="50">
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        @endforeach
        
    </table>


  
    
@endsection