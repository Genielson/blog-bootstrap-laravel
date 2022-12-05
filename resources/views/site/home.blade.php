
@extends('template.basic')
@section('content')
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>

                <div class="row">

                    @if(count($postPrincipal) >= 1)

                            <div class="col-lg-8">
                                <!-- Trending Top -->
                                <div class="trending-top mb-30">

                                        <div class="trend-top-img">
                                            <img src="{{asset('public/image/'.$postPrincipal[0]->url_image)}}" alt="">
                                            <div class="trend-top-cap">
                                                <span>Appetizers</span>
                                                <h2><a href="details.html">{{$postPrincipal[0]->title}}</a></h2>
                                            </div>
                                        </div>

                                </div>
                                <!-- Trending Bottom -->
                                <div class="trending-bottom">
                                    <h3> Recentes </h3> <br><br>
                                    <div class="row">



                                        <div class="col-lg-4">
                                        <div class="single-bottom mb-35">
                                            <div class="trend-bottom-img mb-30">
                                                <img src="{{asset('public/image/'.$postsRecentes[0]['url_image'])}}" alt="">
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color1">Lifestyple</span>
                                                <h4><a href="details.html">{{$postsRecentes[0]['title']}}</a></h4>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="single-bottom mb-35">
                                                <div class="trend-bottom-img mb-30">
                                                    <img src="{{asset('public/image/'.$postsRecentes[1]['url_image'])}}" alt="">
                                                </div>
                                                <div class="trend-bottom-cap">
                                                    <span class="color2">Sports</span>
                                                    <h4><h4><a href="details.html">{{$postsRecentes[1]['title']}}</a></h4></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="single-bottom mb-35">
                                                <div class="trend-bottom-img mb-30">
                                                    <img src="{{asset('public/image/'.$postsRecentes[2]['url_image'])}}" alt="">
                                                </div>
                                                <div class="trend-bottom-cap">
                                                    <span class="color3">Travels</span>
                                                    <h4><a href="details.html"> {{$postsRecentes[2]['title']}}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    @else

                       <div class="mt-100">
                          <h3> Não existe posts suficientes  </h3>
                       </div>

                    @endif

                    <!-- Riht content -->
                    <div class="col-lg-4">

                        @foreach($categorias as $categoria)

                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img width="120px" height="100px" src="{{asset('public/image/'.$categoria['url_image'])}}" alt="">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1">Concert</span>
                                <h4><a href="details.html">{{$categoria['title']}}</a></h4>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
    <!--   Weekly-News start -->

    <!-- End Weekly-News -->
   <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Veja mais</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <!--Nav Button  -->

                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!-- card one -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="whats-news-caption">
                                    <div class="row ">

                                        @foreach($posts as $post)
                                            <div class="col-lg-6 col-md-6 post ">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="{{asset('public/image/'.$post->url_image)}}" alt="">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1">Night party</span>
                                                        <h4><a href="#">{{$post->title}}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                            <button id="buttonLoading" onclick="loadingPost()" class="btn btn-success"> Ver mais... </button>
                                            <input type="hidden" id="post" value="0">
                                            <input type="hidden" id="all" value="{{$somaPosts}}">

                                    </div>
                                </div>
                            </div>
                            <!-- Card two -->

                            <!-- Card three -->
                            <!-- card fure -->
                            <!-- card Five -->

                        </div>
                    <!-- End Nav Card -->
                    </div>
                </div>
            </div>



            <div class="col-lg-4">
                <!-- Section Tittle -->
                <div class="section-tittle mb-40">
                    <h3>Follow Us</h3>
                </div>
                <!-- Flow Socail -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('assets/img/news/icon-fb.png')}}" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('assets/img/news/icon-tw.png')}}" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                            <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('assets/img/news/icon-ins.png')}}" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="{{asset('assets/img/news/icon-yo.png')}}" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="{{asset('assets/img/news/news_card.jpg')}}" alt="">
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
    <!--   Weekly2-News start -->

    <!-- End Weekly-News -->
    <!-- Start Youtube -->

    <!-- End Start youtube -->
    <!--  Recent Articles start -->

    <!--Recent Articles End -->
    <!--Start pagination -->

    <!-- End pagination  -->
    </main>

@endsection
