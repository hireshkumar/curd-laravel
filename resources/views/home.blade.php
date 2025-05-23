@extends('layouts.main')

@section('title', 'Home Page')

@section('banner')
    {{-- Your homepage banner content here --}}
    <div class="banner_section layout_padding">
        <div class="container">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Get Start <br>Your favriot shoping</h1>
                                <div class="buynow_bt"><a href="#">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
              
                </div>
                <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
 @include('partials.fashion_section')
 @include('partials.electronic_section')
 @include('partials.jewellery_section')
@endsection