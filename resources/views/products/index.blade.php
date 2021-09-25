@extends('layout')
@section('content')
    
    <div class="container pt-5">
        <table class="table overflow-auto">
            <thead>
                <tr>
                    <th>El usuario</th>
                    <th>Solicito el producto</th>
                    <th>El dia</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($products as $product )
            
                    <tr>
                        <td> {{ $product->name }} </td>
                        <td> {{ $product->product_name }} </td>
                        <td> {{ $product->created_at }} </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>

    @endsection