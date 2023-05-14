<div class="modal" id="{{$id}}">
    <div class="modal-wrapper">
        <div class="modal-header" data-modal-header>
            <div class="close-btn" easy-toggle="#{{$id}}" easy-rcoe-self>X</div>
            <div class="header-content">
                {!! $headerContent ?? '' !!}
            </div>
        </div>
        <div class="modal-content" data-modal-body>
            {!! ($content ?? '') !!}
        </div>
        <div class="modal-footer" data-modal-footer>
            {!! $footerContent ?? '' !!}
        </div>
    </div>
    <div class="overlay" easy-toggle="#{{$id}}" easy-class="show" easy-rcoe></div>
</div>
