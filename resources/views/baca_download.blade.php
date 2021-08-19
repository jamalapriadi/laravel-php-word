@foreach($list as $val)
    <p>
            
        @foreach($val['text'] as $text)
            <!-- @if($text['style']['name'] != null)
                <span style="font-family:{{$text['style']['name']}}">
            @endif -->

            @if($text['source'] != null)
                <a href="{{$text['source']}}">
            @endif

            @if($text['style']['styleName'] != null && $text['style']['styleName']=="Strong")
                <b>
            @endif

            @if($text['style']['color'] != null)
                <span style="color:#{{$text['style']['color']}}">
            @endif

            {!! $text['text'] !!}        

            @if($text['style']['color'] != null)
                </span>
            @endif

            @if($text['style']['styleName'] != null && $text['style']['styleName']=="Strong")
                </b>
            @endif

            @if($text['source'] != null)
                </a>
            @endif

            <!-- @if($text['style']['name'] != null)
                </span>
            @endif -->
        @endforeach

        
    </p>
@endforeach