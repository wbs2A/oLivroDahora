@extends('master')
@section('content')

<!--================ Start banner Area =================-->
<section class="home-banner-area relative">
    <div class="container-fluid">
        <div class="row">
            <div class="owl-carousel home-banner-owl">
                <div class="banner-img">
                    <img class="img-fluid" src="{{asset("storage/img/banner/b1.jpg")}}" alt="" />
                    <div class="text-wrapper">
                        <a href="#" class="d-flex">
                            <h1>
                                Make the world a better place <br />
                                with camera
                            </h1>
                        </a>
                    </div>
                </div>
                <div class="banner-img">
                    <img class="img-fluid" src="{{asset("storage/img/banner/b2.jpg")}}" alt="" />
                    <div class="text-wrapper">
                        <a href="#" class="d-flex">
                            <h1>
                                Make the world a better place <br />
                                with camera
                            </h1>
                        </a>
                    </div>
                </div>
                <div class="banner-img">
                    <img class="img-fluid" src="{{asset("storage/img/banner/b1.jpg")}}" alt="" />
                    <div class="text-wrapper">
                        <a href="#" class="d-flex">
                            <h1>
                                Make the world a better place <br />
                                with camera
                            </h1>
                        </a>
                    </div>
                </div>
                <div class="banner-img">
                    <img class="img-fluid" src="{{asset("storage/img/banner/b2.jpg")}}" alt="" />
                    <div class="text-wrapper">
                        <a href="#" class="d-flex">
                            <h1>
                                Make the world a better place <br />
                                with camera
                            </h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="social-icons">
        <ul>
            <li>
                <a href="index.html"><i class="fa fa-facebook"></i></a>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-pinterest"></i></a>
            </li>
            <li class="diffrent">sharre now</li>
        </ul>
    </div>
</section>
<!--================ End banner Area =================-->

<!--================ Start Blog Post Area =================-->
<section class="blog-post-area relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                    @foreach ($post as $p)
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="single-amenities">
                                    <div class="amenities-thumb">
                                        <img
                                                class="img-fluid w-100"
                                                src="{{asset("storage/img/blog-post/blog-post1.jpg")}}"
                                                alt=""
                                        />
                                    </div>
                                    <div class="amenities-details">
                                        <h5>
                                            <a href="#"
                                            >{{ $p->titulo }}
                                            </a>
                                        </h5>
                                        <div class="amenities-meta mb-10">
                                            <a href="#" class=""
                                            ><span class="ti-calendar"></span>{{ $p->datapostagem }}</a
                                            >
                                            <a href="#" class="ml-20"
                                            ><span class="ti-comment"></span>{{ $p->comentario }}</a
                                            >
                                        </div>
                                        <p>
                                            {{ $p->descricao }}
                                        </p>

                                        <div class="d-flex justify-content-between mt-20">
                                            <div>
                                                <a href="#" class="blog-post-btn">
                                                    Leia mais <span class="ti-arrow-right"></span>
                                                </a>
                                            </div>
                                            <div class="category">
                                                <a href="#">
                                                    <span class="ti-folder mr-1"></span> {{ $p->categoria }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach

                <!-- <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post1.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >There's goting to be a musical about meghan
                                    </a>
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class=""
                                    ><span class="ti-calendar"></span>20th Nov, 2018</a
                                    >
                                    <a href="#" class="ml-20"
                                    ><span class="ti-comment"></span>05</a
                                    >
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post3.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >Forest responds to consultation smoking in al
                                        fresco.</a
                                    >
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class="">
                                        <span class="ti-calendar"></span>20th Nov, 2018
                                    </a>
                                    <a href="#" class="ml-20">
                                        <span class="ti-comment"></span>05
                                    </a>
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post5.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >There's goting to be a musical about meghan
                                    </a>
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class=""
                                    ><span class="ti-calendar"></span>20th Nov, 2018</a
                                    >
                                    <a href="#" class="ml-20"
                                    ><span class="ti-comment"></span>05</a
                                    >
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post7.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >Forest responds to consultation smoking in al
                                        fresco.</a
                                    >
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class="">
                                        <span class="ti-calendar"></span>20th Nov, 2018
                                    </a>
                                    <a href="#" class="ml-20">
                                        <span class="ti-comment"></span>05
                                    </a>
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post2.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >There's goting to be a musical about meghan
                                    </a>
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class=""
                                    ><span class="ti-calendar"></span>20th Nov, 2018</a
                                    >
                                    <a href="#" class="ml-20"
                                    ><span class="ti-comment"></span>05</a
                                    >
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post4.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >Forest responds to consultation smoking in al
                                        fresco.</a
                                    >
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class="">
                                        <span class="ti-calendar"></span>20th Nov, 2018
                                    </a>
                                    <a href="#" class="ml-20">
                                        <span class="ti-comment"></span>05
                                    </a>
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post6.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >There's goting to be a musical about meghan
                                    </a>
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class=""
                                    ><span class="ti-calendar"></span>20th Nov, 2018</a
                                    >
                                    <a href="#" class="ml-20"
                                    ><span class="ti-comment"></span>05</a
                                    >
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-amenities">
                            <div class="amenities-thumb">
                                <img
                                        class="img-fluid w-100"
                                        src="{{asset("storage/img/blog-post/blog-post8.jpg")}}"
                                        alt=""
                                />
                            </div>
                            <div class="amenities-details">
                                <h5>
                                    <a href="#"
                                    >Forest responds to consultation smoking in al
                                        fresco.</a
                                    >
                                </h5>
                                <div class="amenities-meta mb-10">
                                    <a href="#" class="">
                                        <span class="ti-calendar"></span>20th Nov, 2018
                                    </a>
                                    <a href="#" class="ml-20">
                                        <span class="ti-comment"></span>05
                                    </a>
                                </div>
                                <p>
                                    Creepeth green light appear let rule only you're divide
                                    and lights moving and isn't given creeping deep.
                                </p>

                                <div class="d-flex justify-content-between mt-20">
                                    <div>
                                        <a href="#" class="blog-post-btn">
                                            Read More <span class="ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="category">
                                        <a href="#">
                                            <span class="ti-folder mr-1"></span> Travel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                  <span aria-hidden="true">
                                      <span class="ti-arrow-left"></span>
                                  </span>
                                    </a>
                                </li>
                                <li class="page-item"><a href="#" class="page-link">01</a></li>
                                <li class="page-item active"><a href="#" class="page-link">02</a></li>
                                <li class="page-item"><a href="#" class="page-link">03</a></li>
                                <li class="page-item"><a href="#" class="page-link">04</a></li>
                                <li class="page-item"><a href="#" class="page-link">09</a></li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                  <span aria-hidden="true">
                                      <span class="ti-arrow-right"></span>
                                  </span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> -->
            </div>

            @include("static.postSidebar")

        </div>
    </div>
</section>
<!--================ End Blog Post Area =================-->
<script src='js/botwidget.js'></script>
@stop