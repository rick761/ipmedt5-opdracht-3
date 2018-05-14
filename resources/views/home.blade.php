@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mijn Producten</div>

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
                    <ul>
                        @foreach( $user_producten as $user_producten_item )
                            <li><a href="{{route('product',['id'=> $user_producten_item->id])}}">{{$user_producten_item->naam}}</a> || {{$user_producten_item->share_status}}
                            @if($user_producten_item->share_status == 'uitgeleend' OR $user_producten_item->share_status == 'pending_terug')
                                || uitgeleend om: {{$user_producten_item->updated_at}}
                            @endif
                            </li>
                        @endforeach
                    </ul>

                    <form action="AddProduct" method="POST">

                        @csrf

                        <input name="productnaam" placeholder="nieuw product?" type="text" >
                        <input type="submit" value="Voeg toe">

                    </form>

                    <br>
                    @if($geleend_aan_mij->count() > 0)
                    <h3>Geleend aan mij:</h3>

                            <ul>
                                    @foreach($geleend_aan_mij as $item)
                                        <li>
                                            {{$item->naam}} van {{$item->Owner->name}}   ||  status: {{$item->share_status }} ||
                                                @switch($item->share_status)
                                                    @case ('pending_uitgeleend')
                                                        <a href="{{route('accepteerLening',['item_id'=>$item->id])}}">accepteer</a>
                                                        <a href="{{route('stopLening',['item_id'=>$item->id])}}">stop</a>
                                                    @break
                                                    @case ('uitgeleend')
                                                        <a href="{{route('geefTerug',['item_id'=>$item->id])}}">geefTerug</a>
                                                        || geleend vanaf: {{$item->updated_at}}
                                                    @break
                                                    @case ('pending_terug')
                                                        || geleend vanaf: {{$item->updated_at}}
                                                    @break
                                                @endswitch

                                        </li>
                                    @endforeach
                            </ul>
                    @endif

                    @if($teruggeven_accepteren->count() > 0)
                       <h3>Requests om terug te krijgen:</h3>
                            <ul>
                                @foreach($teruggeven_accepteren as $item)
                                    <li>{{$item->naam}} van {{$item->Shared_too->name}} || <a href="{{route('accepteerRetour',['item_id'=>$item->id])}}">accepteer</a></li>
                                    @endforeach
                            </ul>

                        @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
