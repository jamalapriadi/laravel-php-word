<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <a class="btn btn-primary" id="btn_convert1" href="#" onclick='screenshot();'>screenshot</a>
    </div>

    <div class="container" id="container">
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
    </div>
    <hr>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script>
        function screenshot(){
            html2canvas(document.getElementById('container')).then(function(canvas) {
                document.body.appendChild(canvas);
            });
        }
    </script>
</body>
</html>