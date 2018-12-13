@extends('layouts.master')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('js/slide/slick/slick.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('js/slide/slick/slick-theme.css')}}"/>
  <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }
    * {
      box-sizing: border-box;
    }
    .slider {
        width: 100%;
        margin: 5px auto;
    }
    .slick-slide {
      margin: 0px 20px;
    }
    .slick-slide img {
      width: 100%;
    }
    .slick-prev:before,
    .slick-next:before {
      color: black;
    }
    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    .slick-active {
      opacity: .5;
    }
    .slick-current {
      opacity: 1;
    }
  </style>
@endpush
@section('content')

    <div class="center slider" id="slick-images">
        <div><img src="{{ asset('js/slide/giotto.jpg') }}" alt=""></div>
        <div><img src="{{ asset('js/slide/leonardo.jpg') }}" alt=""></div>
        <div><img src="{{ asset('js/slide/gaugin.jpg') }}" alt=""></div>
        <div><img src="{{ asset('js/slide/warhol.jpg') }}" alt=""></div>
        <div><img src="{{ asset('js/slide/giotto.jpg') }}" alt=""></div>
        <div><img src="{{ asset('js/slide/leonardo.jpg') }}" alt=""></div>
        <div><img src="{{ asset('js/slide/gaugin.jpg') }}" alt=""></div>
        <div><img src="{{ asset('js/slide/warhol.jpg') }}" alt=""></div>
    </div>
@endsection

@push('plugins')
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/slide/slick/slick.js')}}"  charset="utf-8"></script>
<script type="text/javascript">
    var $j=$.noConflict();
    $j(document).ready(function(){
        $j("#slick-images").slick({
            // swipeToSlide:true,
            dots: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    });
</script>
@endpush
