@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{url('css/shop/style.css')}}">
@endpush
@section('content')
@include('components.validationErrorMessage')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">

        <!--
        Feature start
        ==================== -->
        <section class="feature section">
            <div class="container">
                <div class="heading">
                    <h2>Our Core Features</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="tf-ion-ios-alarm-outline"></i>
                            <h4>Smooth Touch</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, inventore?</p>
                        </div>
                        <div class="feature-box">
                            <i class="tf-ion-ios-bell-outline"></i>
                            <h4>Elegant Design</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, inventore?</p>
                        </div>
                        <div class="feature-box">
                            <i class="tf-ion-ios-cart-outline"></i>
                            <h4>Easy Pricing</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, inventore?</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="{{url('images/shop/watch-2.png')}}" alt="">
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="tf-ion-ios-alarm-outline"></i>
                            <h4>Smooth Touch</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, inventore?</p>
                        </div>
                        <div class="feature-box">
                            <i class="tf-ion-ios-bell-outline"></i>
                            <h4>Elegant Design</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, inventore?</p>
                        </div>
                        <div class="feature-box">
                            <i class="tf-ion-ios-cart-outline"></i>
                            <h4>Easy Pricing</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, inventore?</p>
                        </div>
                    </div>
                </div>
            </div><!-- .container close -->
        </section><!-- #service close -->

        <section class="promo-details section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="{{url('images/shop/watch.png')}}" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="content mt-100">
                            <h2 class="subheading">Designed by professional , the benefit for creative gigs</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia vel labore, deleniti minima nisi, velit atque quaerat impedit ea maxime sunt accusamus at obcaecati dolor iure iusto omnis quis eum.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis commodi odit, illo, qui aliquam dol</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="feature-list section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>Why Choose Apple Watch</h2>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img class="" src="{{url('images/shop/showcase-4.png')}}" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="content mt-100">
                            <h4 class="subheading">Lorem ipsum dolor sit amet.</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, sed, assumenda. Tenetur sed esse, voluptas voluptate est veniam numquam, quis magni. Architecto minus suscipit quas, quo harum deserunt consequatur cumque!</p>
                            <a href="" class="btn btn-main btn-main-sm">Check Features</a>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="content mt-100">
                            <h4 class="subheading">Lorem ipsum dolor sit amet.</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, sed, assumenda. Tenetur sed esse, voluptas voluptate est veniam numquam, quis magni. Architecto minus suscipit quas, quo harum deserunt consequatur cumque!</p>
                            <a href="" class="btn btn-main btn-main-sm">Check Features</a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img class="img-responsive" src="{{url('images/shop/showcase-3.png')}}" alt="">
                    </div>
                </div>
            </div>
        </section>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugins')
    <script src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript">

</script>
@endpush
