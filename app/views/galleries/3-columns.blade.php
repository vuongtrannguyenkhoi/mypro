@extends('master')

@section('content')
    <section class="section-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section-title">{{ $category->name }}</h2>
                    <div id="portfolio-isotope">
                        <div class="portfolio-container popup-gallery">
                            <div class="row">
                                <div class="portfolio">
                                    @foreach ($gallery->photos as $photo)
                                        <div class="col-sm-6 col-md-4 el" style="position: absolute; left: 0px; top: 0px;">
                                            <div class="portfolio-inner-item view">
                                                <img src="{{ url($photo->thumb) }}" alt="{{ $photo->name }}">
                                                <div class="mask">
                                                    <a href="{{ url($photo->photo) }}" title="{{ $photo->caption }}" class="init-popup info middle"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div> <!-- END portfolio Item -->
                                    @endforeach
                                </div> <!-- END portfolio -->
                            </div>
                        </div> <!-- END portfolio Container -->
                    </div> <!-- END Portfolio Isotope -->
                </div>
            </div>
        </div>
    </section>
    {{ HTML::script('assets/_demo/isotope.js') }}
    {{ HTML::script('assets/inc/magnific-popup/jquery.magnific-popup.min.js') }}
@stop