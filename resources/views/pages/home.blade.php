@extends('layouts.main')
@section('content')
    <div class="wrapper home-wrapper">
        <div class="goods">
            <div class="circle-list">
                @foreach($goods as $good)
                    <div class="circle-item">
                        <div class="good-container" data-type="{{ $good['type'] ?? ''}}" data-id="{{ $good['id'] ?? '' }}">
                            <div class="good-name">{{$good['name'] ?? ''}}</div>
                            <div class="good-logo"><img src="{{$good['image'] ?? ''}}" alt=""></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('_partials/modal', ['id' => "goodModal"])
        @include('_partials/modal', ['id' => 'paymentDetailsModal', 'content' => view('_partials/good_payment')])
    </div>
@stop
