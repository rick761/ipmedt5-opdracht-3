@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route('home')}}">Home</a> </a> > Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(isset($message))
                        <div class="alert alert-info">
                                <strong>{{$message}}</strong>
                            </div>
                    @endif

                    <h1>{{$product->naam}}</h1>
                    <a href="{{route('removeProduct', ['id'=> $product->id ]) }}">remove</a>
                        <br><br>
                        <p> status van het product: <b>{{$product->share_status}}</b></p>

                    @if($product->share_id != null)

                        <p>(Probeert) uitgeleend aan: {{$product->shared_too->name}} </p>

                    @endif

                    @if($product->share_status == 'pending_uitgeleend' OR $product->share_status == 'owner')
                    <form action="deelUit" method="POST">
                        @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">
                        <select name="leen_id">
                            @foreach($gebruikers as $gebruiker)
                                @if(!($gebruiker->name == $user->name ))
                                <option value="{{$gebruiker->id}}">{{$gebruiker->name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <input type="submit" value="Deel uit">

                    </form>
                    @endif










                </div>
            </div>
        </div>
    </div>
</div>
@endsection
