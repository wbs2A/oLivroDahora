<!-- Start Blog Post Siddebar -->
<div id="sideBar" class="col-lg-4 sidebar-widgets">

    <div class="widget-wrap">
        <div class="single-sidebar-widget search-widget">
            <h3 class="text-center">Anuncie aqui!</h3>
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset("storage/img/ads/bkad.jpg")}}">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset("storage/img/ads/chickad.jpg")}}">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset("storage/img/ads/outad.jpg")}}">
                    </div>
                </div>
            </div>
            <!--             {{--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
            {{--<script>--}}
                {{--(adsbygoogle = window.adsbygoogle || []).push({--}}
                    {{--google_ad_client: "ca-pub-5126773966914838",--}}
                    {{--enable_page_level_ads: true--}}
                {{--});--}}
            {{--</script>--}} -->
        </div>

        <div class="single-sidebar-widget instafeed-widget">
            <h4 class="instafeed-title">Instagram</h4>
            <ul class="instafeed d-flex flex-wrap">
                <li><img src="{{asset("storage/img/blog/instagram/i1.jpg")}}" alt=""></li>
                <li><img src="{{asset("storage/img/blog/instagram/i2.jpg")}}" alt=""></li>
                <li><img src="{{asset("storage/img/blog/instagram/i3.jpg")}}" alt=""></li>
                <li><img src="{{asset("storage/img/blog/instagram/i4.jpg")}}" alt=""></li>
                <li><img src="{{asset("storage/img/blog/instagram/i5.jpg")}}" alt=""></li>
                <li><img src="{{asset("storage/img/blog/instagram/i6.jpg")}}" alt=""></li>
            </ul>
        </div>
        <div class="single-sidebar-widget search-widget">
            <div class="container single-sidebar-widget post-category-widget">
               <h4 class="category-title">Categorias</h4>
                    <categoria v-on:click="setCategoria" :post_count="1" :cate='@json($categoria)'></categoria>
            </div>
        </div>
        <div class="single-sidebar-widget popular-post-widget">
            <h4 class="popular-title">Posts Populares</h4>
            <div class="popular-post-list">
                @foreach ($postsL as $post)
                    <div class="single-post-list">
                        <div class="thumb">
                            @if($post->imagens)
                                <img class="img-fluid" src="" alt="">
                                <!-- {{asset("storage/img/blog/pp1.jpg")}} -->
                            @endif
                        </div>
                        <div class="details mt-20">
                            <a href="/viewpost/{{$post->idpost}}">
                                <h6>{{$post->titulo}}</h6>
                            </a>
                            <p>{{$post->categoria->nome}} | {{$post->datapostagem}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- 
            {{--<div class="single-sidebar-widget newsletter-widget">--}}
                {{--<h4 class="newsletter-title">Newsletter</h4>--}}
                {{--<div class="form-group mt-30">--}}
                    {{--<div class="col-autos">--}}
                        {{--<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"--}}
                               {{--onblur="this.placeholder = 'Enter email'">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<button class="bbtns d-block mt-20 w-100">Inscreva-se</button>--}}
            {{--</div>--}}

            {{--<div class="single-sidebar-widget share-widget">--}}
                {{--<h4 class="share-title">Compartilhe nosso site</h4>--}}
                {{--<div class="social-icons mt-20">--}}
                    {{--<a href="#">--}}
                        {{--<span class="ti-facebook"></span>--}}
                    {{--</a>--}}
                    {{--<a href="#">--}}
                        {{--<span class="ti-twitter"></span>--}}
                    {{--</a>--}}
                    {{--<a href="#">--}}
                        {{--<span class="ti-pinterest"></span>--}}
                    {{--</a>--}}
                    {{--<a href="#">--}}
                        {{--<span class="ti-instagram"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}} 
        -->

    </div>
</div>
<script src='{{asset("js/staticSideBar.js")}}'></script>
<!-- End Blog Post Siddebar