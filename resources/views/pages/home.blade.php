@extends('layouts.main')
@section('content')
    <div class="wrapper home-wrapper">
        <div class="goods">
            <div class="circle-list">
                @foreach($categories as $category)
                    <div class="circle-item">
                        <div class="good-container" data-type="{{ $category['type'] ?? ''}}" data-id="{{ $category['id'] ?? '' }}">
                            <div class="good-name">{{$category['name'] ?? ''}}</div>
                            <div class="good-logo"><img src="{{$category['image'] ?? ''}}" alt=""></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('_partials/modal', ['id' => "goodModal"])
        @include('_partials/modal', ['id' => 'paymentDetailsModal', 'content' => view('_partials/good_payment')])
    </div>
@stop
