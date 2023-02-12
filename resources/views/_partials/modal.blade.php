<div class="modal" id="{{$id}}">
    <div class="modal-wrapper">
        <div class="modal-header">
            {!! $headerContent ?? '' !!}
        </div>
        <div class="modal-content">
            {!! ($content ?? '') !!}
        </div>
        <div class="modal-footer">
            {!! $footerContent ?? '' !!}
        </div>
    </div>
    <div class="overlay" easy-toggle="#{{$id}}" easy-class="hide" easy-rcoe></div>
</div>
