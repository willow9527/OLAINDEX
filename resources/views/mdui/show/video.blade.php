@extends('mdui.layouts.main')
@section('css')
    <link href="https://cdn.bootcss.com/plyr/3.4.7/plyr.css" rel="stylesheet">
@stop
@section('js')
    <script>
        (function (d, p) {
            var a = new XMLHttpRequest(),
                b = d.body;
            a.open("GET", p, true);
            a.send();
            a.onload = function () {
                var c = d.createElement("div");
                c.style.display = "none";
                c.innerHTML = a.responseText;
                b.insertBefore(c, b.childNodes[0]);
            }
        })(document, "https://cdn.bootcss.com/plyr/3.4.7/plyr.svg");
    </script>
    <script src="https://cdn.bootcss.com/plyr/3.4.7/plyr.min.js"></script>
    <script>const player = new Plyr('#player');</script>
@stop
@section('breadcrumb')
    @include('mdui.breadcrumb',['switch' => false])
@stop
@section('content')

    <div class="mdui-container-fluid">
        {{--<br>--}}
        <div class="mdui-chip mdui-m-t-2 mdui-m-b-2">
            <span class="mdui-chip-icon">A</span>
            <span class="mdui-chip-title">{{ $file['name'] }}</span>
        </div>
        <div class="mudi-center" id="video-player">
            <video crossorigin playsinline controls poster="{!! $file['thumb'] !!}" id="player">
                <source src="{!! $file['download'] !!}" type="video/mp4">
            </video>
        </div>
        <div class="mdui-typo">
            <hr/>
        </div>
        <div class="mdui-textfield">
            <label class="mdui-textfield-label" for="downloadUrl">下载地址</label>
            <input class="mdui-textfield-input" type="text" id="downloadUrl"
                   value="{{ route('download',\App\Helpers\Tool::getEncodeUrl($origin_path)) }}"/>
        </div>
    </div>
    <a href="{{ $file['download'] }}" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i
            class="mdui-icon material-icons">file_download</i></a>
@stop
