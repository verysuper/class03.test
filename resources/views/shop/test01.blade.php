@extends('layouts.master')
@push('styles')
<style type="text/css">
* {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
html {
	-ms-touch-action: none;
}
body, ul, li {
	padding: 0;
	margin: 0;
	border: 0;
}
body {
	font-size: 12px;
	font-family: ubuntu, helvetica, arial;
	overflow: hidden; /* this is important to prevent the whole page to bounce */
}
.viewport {
	position: relative;
    width: 320px;
    /* width: 100%; */
	height: 1000px;
	margin: 0 auto;
	/* background: #444; */
	overflow: hidden;
}
.wrapper {
	width: 100%;
	height: 240px;
	margin: 0 auto;
}
.scroller {
	position: absolute;
	z-index: 1;
	-webkit-tap-highlight-color: rgba(0,0,0,0);
	width: 800px;
	height: 240px;
	-webkit-transform: translateZ(0);
	-moz-transform: translateZ(0);
	-ms-transform: translateZ(0);
	-o-transform: translateZ(0);
	transform: translateZ(0);
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-text-size-adjust: none;
	-moz-text-size-adjust: none;
	-ms-text-size-adjust: none;
	-o-text-size-adjust: none;
	text-size-adjust: none;
	/* background-color: #444; */
}
.slide {
	width: 200px;
	height: 240px;
    float: left;
    padding: 0;
}
.painting {
	width: 140px;
	height: 200px;
	border-radius: 10px;
	margin: 20px auto;
	border: 1px solid #000;
	box-shadow:
		inset 2px 2px 6px rgba(255,255,255,0.6),
		inset -2px -2px 6px rgba(0,0,0,0.6),
		0 1px 8px rgba(0,0,0,0.8);
}
.giotto {
	background: url("{{asset('js/slide/giotto.jpg')}}");
}
.leonardo {
	background: url("{{asset('js/slide/leonardo.jpg')}}");
}
.gaugin {
	background: url("{{asset('js/slide/gaugin.jpg')}}");
}
.warhol {
	background: url("{{asset('js/slide/warhol.jpg')}}");
}
#indicator {
	position: relative;
	width: 110px;
	height: 20px;
	margin: 10px auto;
	background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAUBAMAAABohZD3AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QUGCDYztyDUJgAAAB1pVFh0Q29tbWVudAAAAAAAQ3JlYXRlZCB3aXRoIEdJTVBkLmUHAAAAGFBMVEUAAADNzc3Nzc3Nzc3Nzc3Nzc3Nzc3///8aWwwLAAAABnRSTlMAX5Ks3/nRD0HIAAAAAWJLR0QHFmGI6wAAAFtJREFUGFdjYGBgEHYNMWRAAJE0IHCEc5nSwEABxleD8JOgXMY0KBCA8FlgfAcIXwzGT4TwzWD8ZAjfDcZPgfDDYPxU7Hx09ejmoduH7h5096L7B8O/6OGBGl4APYg8TQ0XAScAAAAASUVORK5CYII=);
}
#dotty {
	position: absolute;
	width: 20px;
	height: 20px;
	border-radius: 10px;
	background: #777;
}
</style>
@endpush
@section('content')
<div class="viewport">
	<div class="iscroller wrapper" >
		<ul class="scroller">
			<li class="slide"><img class="painting giotto"></li>
			<li class="slide"><img class="painting leonardo"></li>
			<li class="slide"><img class="painting gaugin"></li>
			<li class="slide"><img class="painting warhol"></li>
        </ul>
    </div>

	<div class="iscroller wrapper" >
		<ul class="scroller">
			<li class="slide"><img class="painting giotto"></li>
			<li class="slide"><img class="painting leonardo"></li>
			<li class="slide"><img class="painting gaugin"></li>
			<li class="slide"><img class="painting warhol"></li>
        </ul>
    </div>

	<div class="iscroller wrapper" >
		<ul class="scroller">
			<li class="slide"><img class="painting giotto"></li>
			<li class="slide"><img class="painting leonardo"></li>
			<li class="slide"><img class="painting gaugin"></li>
			<li class="slide"><img class="painting warhol"></li>
        </ul>
    </div>

	<div class="iscroller wrapper" >
		<ul class="scroller">
			<li class="slide"><img class="painting giotto"></li>
			<li class="slide"><img class="painting leonardo"></li>
			<li class="slide"><img class="painting gaugin"></li>
			<li class="slide"><img class="painting warhol"></li>
        </ul>
    </div>
</div>
@endsection
@push('plugins')
<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slide/iscroll/iscroll.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/slide/iscroll/demoUtils.js') }}"></script> -->

<script type="text/javascript">
function iscroller_init () {
    var iscroller = $('.iscroller');
    iscroller.each(function(index){
        $(this).addClass('iscroller'+index).attr('iscroller_id','iscroller'+index);
        var tmpfnc = new Function('var myScroll'+index);
        tmpfnc();
        var tmpfnc = new Function('myScroll'+index+' = new IScroll(\'.iscroller'+index
                +'\', {scrollX: true,scrollY: false,momentum: false,snap: true,snapSpeed: 400,keyBindings: true,'
                // +'hScroll: true,'
                // +'onBeforeScrollStart: function ( e ) {'
                //     +'if ( this.absDistX > (this.absDistY + 5 ) ) {'
                //         +'e.preventDefault();'
                //     +'}'
                // +'},'
                // +'onTouchEnd: function () {'
                //     +'var self = this;'
                //     +'if (self.touchEndTimeId) {'
                //             +'clearTimeout(self.touchEndTimeId);'
                //     +'}'

                //     +'self.touchEndTimeId = setTimeout(function () {'
                //             +'self.absDistX = 0;'
                //             +'self.absDistY = 0;'
                //     +'}, 600);'
                // +'}'
            +'});'
        );
        tmpfnc();
    });
}
function iscroller_reinit (el) {
    var el = $(el);
    var iscroller = $('.iscroller');
    var i = iscroller.index(el);
    var tmpfnc = new Function('var myScroll'+i+' = new IScroll(\'.iscroller'+i+'\', { mouseWheel: true });');
    tmpfnc();
}
// document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
$(document).ready(function(){
    if ($('.iscroller').length > 0) iscroller_init ();
});
</script>
@endpush
