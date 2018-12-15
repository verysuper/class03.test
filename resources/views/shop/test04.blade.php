@extends('layouts.test')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('js/slide/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('js/slide/slick/slick-theme.css')}}"/>
    <style type="text/css">
        iframe,img {border:0;}
        img{display:block;width:100%;height:100%}
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
    @include('components.validationErrorMessage')
    @if($parent_id>0)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($parents as $parent)
                        <div class="card border-0 mb-1 rounded-0" style="overflow: hidden;background-color: #f8fafc;">
                            <div class="card-header border-0 p-0  bg-transparent">
                                {{ __($parent->id) }}:{{ __($parent->name) }}
                            </div>
                            <div class="card-body border-0 p-0">
                                <div class="slider slick" id="">
                                    @foreach($childs as $child)
                                        @if($child->parent_id == $parent->id)
                                            <div class="item">
                                                <div style="height:138.5px;overflow:hidden;margin:1px;">
                                                    <!-- <a href=""> -->
                                                    <img src="{{ is_null($child->image)?url('/images/default-merchandise.png'):url('/images/merchandise/'.$child->image) }}" alt="">
                                                    <!-- </a> -->
                                                </div>
                                                <div class="text-justify pl-1" style="height:25px;overflow:hidden;">
                                                    <!-- <a href=""> -->
                                                {{ __(substr($child->name,0,12).'...') }}
                                                <!-- </a> -->
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($parents as $parent)
                        <div class="card border-0 mb-1 rounded-0" style="overflow: hidden;background-color: #f8fafc;">
                            <div class="card-header border-0 p-0  bg-transparent">
                                {{ __($parent->id) }}:{{ __($parent->name) }}
                            </div>
                            <div class="card-body border-0 p-0">
                                <div class="slider slick" id="">
                                    @foreach($childs as $child)
                                        @if($child->parent_id == $parent->id)
                                            <div class="item">
                                                <div style="height:138.5px;overflow:hidden;margin:1px;">
                                                    <a href="{{ url('shop/'.$child->id) }}">
                                                        <img src="{{ is_null($child->image)?url('/images/default-merchandise.png'):url('/images/category/'.$child->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="text-justify pl-1" style="height:25px;overflow:hidden;">
                                                    <a href="{{ url('shop/'.$child->id) }}">
                                                        {{ __(substr($child->name,0,12).'...') }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection

@push('plugins')
    <!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script> -->
    <script src="{{ url('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
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
