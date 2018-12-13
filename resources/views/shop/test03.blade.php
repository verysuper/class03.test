@extends('layouts.master')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('js/slide/slick/slick.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('js/slide/slick/slick-theme.css')}}"/>
<style type="text/css">
    iframe,img {border:0;}
    img{display:block;width:100%;height:113.5px}
    .slider {
        width: 100%;
        margin: 0px;
        padding: 0px;
        height:164px;
    }
    .slick-slider .slick-track, .slick-slider .slick-list {
        margin-left:0;
    }
</style>
@endpush
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
            @for($i=0;$i<count($grouped[$parent_id]);$i++)
            @if(isset($grouped[$grouped[$parent_id][$i]['id']]))
			<div class="card border-0 mb-1" style="overflow: hidden;">
                <div class="card-header border-0 p-0">
                    {{ __($a=$grouped[$parent_id][$i]['id']) }}:{{ __($grouped[$parent_id][$i]['name']) }}
                </div>
				<div class="card-body p-0">
                    <div class="slider slick" id="">
                        @for($j=0;$j<count($grouped[$grouped[$parent_id][$i]['id']]);$j++)
                        <div class="item">
                            <a href="{{ url('shop/'.$grouped[$grouped[$parent_id][$i]['id']][$j]['id']) }}">
                                <img src="{{ is_null($grouped[$grouped[$parent_id][$i]['id']][$j]['image'])?url('/images/default-merchandise.png'):url('/images/category/'.$grouped[$grouped[$parent_id][$i]['id']][$j]['image']) }}" alt="">
                            </a>
                            <div style="height:50px;overflow:hidden;padding:2px;">
                                <a href="{{ url('shop/'.$grouped[$grouped[$parent_id][$i]['id']][$j]['id']) }}">
                                    {{ substr($grouped[$grouped[$parent_id][$i]['id']][$j]['name'],0,20).'...' }}
                                </a>
                            </div>
                        </div>
                        @endfor
                    </div>
				</div>
            </div>
            @endif
            @endfor
		</div>
	</div>
</div>
@endsection

@push('plugins')
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/slide/slick/slick.js')}}"  charset="utf-8"></script>
<script type="text/javascript">
    var $j=$.noConflict();
    $j(document).ready(function(){
        $j(".slick").slick({
            slidesToShow: 8,
            slidesToScroll: 8,
            infinite:false,
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
            ]
        });
    });
</script>
@endpush
