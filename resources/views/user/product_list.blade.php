@extends('layouts.user_layout')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Breadcrumb section start -->
    <section class="breadcrumb-section section-b-space">
        {{--PHAN HINH VUONG XOAY TRON--}}
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        {{--PHAN TIEU DE--}}
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Product List</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li>Shop Fashion</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section end -->


    {{--PHAN LIET KE SAN PHAM VA GIAO DIEN LOC SP--}}
    <!-- Shop Section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                {{--        PHAN GIAO DIEN LOC SAN PHAM--}}
                <div class="col-lg-3 col-md-4">
                    <div class="category-option">
                        {{--                NUT CHUA XAC DINH--}}
                        <div class="button-close mb-3">
                            <button class="btn p-0"><i data-feather="arrow-left"></i> Close</button>
                        </div>
                        <div class="accordion category-name" id="accordionExample">
                            {{--                GIAO DIEN FORM DE NHAP CAC TRUONG TIM KIEM, KHAI BAO ACTION TRO TOI LINK ROUTE SEACH PD--}}
                            <form method="get" action="">
                                <div class="accordion-item category-rating">
                                    {{--                        TIEU DE CUA O CHON--}}
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                            Brand
                                        </button>
                                    </h2>
                                    {{--                        LIET KE CAC LUA CHON CUA BRAND--}}
                                    <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body category-scroll">
                                            <ul class="category-list">
                                                @foreach($brands as $brand)
                                                    <li>
                                                        <div class="form-check ps-0 custome-form-check">
                                                            <input class="checkbox_animated check-it" type="radio" name="brand_id" id="flexCheckDefault1" value="{{$brand->id}}">
                                                            <label class="form-check-label" for="flexCheckDefault1">{{$brand->name}}</label>
                                                            {{--                                                <p class="font-light">(25)</p>--}}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div  class="accordion-item category-price ">
                                    {{--                        TIEU DE CUA O CHON--}}
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                            Price
                                        </button>
                                    </h2>
                                    {{--                        LIET KE CAC LUA CHON CUA PRICE--}}
                                    <div data-role="rangeslider">
                                        <div data-role="rangeslider" class="ui-rangeslider">
                                            </br>
                                            <label for="price-min" id="price-min-label">From:</label>
                                            <input type="number" data-type="range" name="price_min" id="price-min" value="20" min="0" max="50000" class="ui-shadow-inset ui-corner-all ui-slider-input ui-rangeslider-first ui-body-inherit">
                                            <br>
                                            <label for="price-max" id="price-max-label">To:  </label>
                                            <input type="number" data-type="range" name="price_max" id="price-max" value="10000" min="5001" max="10000" class="ui-shadow-inset ui-corner-all ui-slider-input ui-rangeslider-last ui-body-inherit">
                                            <div class="ui-rangeslider-sliders"><div role="application" class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all" aria-disabled="false"><div class="ui-slider-bg ui-btn-active" style="width: 60%; margin-left: 20%;"></div></div><div role="application" class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all" aria-disabled="false"><div class="ui-slider-bg ui-btn-active" style="width: 60%; margin-left: 20%;"></div><a href="#" class="ui-slider-handle ui-btn ui-shadow ui-btn-null" role="slider" aria-valuemin="0" aria-valuemax="1000" aria-valuenow="200" aria-valuetext="200" title="200" aria-labelledby="price-min-label" style="left: 20%;"></a><a href="#" class="ui-slider-handle ui-btn ui-shadow ui-btn-null" role="slider" aria-valuemin="0" aria-valuemax="1000" aria-valuenow="800" aria-valuetext="800" title="800" aria-labelledby="price-max-label" style="left: 80%;"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item category-rating">
                                    {{--                        TIEU DE CUA O CHON--}}
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            Category
                                        </button>
                                    </h2>
                                    {{--                        CAC LUA CHON CUA CATEGORY--}}
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                         aria-labelledby="headingOne">
                                        <div class="accordion-body category-scroll">
                                            <ul class="category-list">
                                                @foreach($categories as $category)
                                                    <li>
                                                        <div class="form-check ps-0 custome-form-check">
                                                            <input class="checkbox_animated check-it" type="radio" name="category_id" id="flexCheckDefault10" value="{{$category->id}}" >
                                                            <label class="form-check-label" for="flexCheckDefault10">{{$category->name}}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                {{--                    PHIM GUI TOI ROUTE--}}
                                <button class="btn btn-solid-default btn-block" type="submit" >
                                    Filter
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                {{--        PHAN GIAO DIEN LIET KE SP--}}
                <div class="col-lg-9 col-12 ratio_30">
                    <div class="banner-deatils">
                        {{--                ANH QUANG CAO KEM LOI QUANG CAO--}}
                        <div class="banner-image">
                            <img src="{{asset('voxo_front/assets/images/fashion/banner.jpg')}}" class="img-fluid bg-img blur-up lazyload"
                                 alt="">
                            <div class="banner-content">
                                <div>
                                    <h3>Shop The Latest Trends</h3>
                                    <p>Shop the latest clothing trends with our weekly edit of what's new in online at
                                        Voxo. From out latest woman collection.</p>
                                </div>
                            </div>
                        </div>
                        {{--                LOI TUA DE O DUOI ANH QUANG CAO--}}
                        <div class="banner-contain mt-3 mb-5">
                            <p class="font-light">
                                A general development or change in a situation or in the way that people are behaving.
                                The latest fashion news, beauty coverage, celebrity style,
                                fashion week updates, culture reviews, and videos on VOXO.com.
                            </p>
                        </div>
                    </div>
                    {{--            PHAN LUA CHON CHE DO HIEN THI--}}
                    <div class="row g-4">
                        <!-- filter button -->
                        <div class="filter-button">
                            <button class="btn filter-btn p-0"><i data-feather="align-left"></i> Filter</button>
                        </div>
                        <!-- filter button -->

                        <!-- label and featured section -->
                        <div class="col-md-12">
                            <ul class="short-name">
                            </ul>
                        </div>

                        <div class="col-12">
                            <div class="filter-options">
                                <div class="select-options">
                                </div>
                                {{--                        DANH SACH LUA CHON KIEU HIEN THI--}}
                                <div class="grid-options d-sm-inline-block d-none">
                                    <ul class="d-flex">
                                        <li class="two-grid">
                                            <a href="javascript:void(0)">
                                                <img src="{{asset('voxo_front/assets/svg/grid-2.svg')}}" class="img-fluid blur-up lazyload"
                                                     alt="">
                                            </a>
                                        </li>
                                        <li class="three-grid d-md-inline-block d-none">
                                            <a href="javascript:void(0)">
                                                <img src="{{asset('voxo_front/assets/svg/grid-3.svg')}}" class="img-fluid blur-up lazyload"
                                                     alt="">
                                            </a>
                                        </li>
                                        <li class="grid-btn active d-lg-inline-block d-none">
                                            <a href="javascript:void(0)">
                                                <img src="{{asset('voxo_front/assets/svg/grid.svg')}}" class="img-fluid blur-up lazyload"
                                                     alt="">
                                            </a>
                                        </li>
                                        <li class="list-btn">
                                            <a href="javascript:void(0)">
                                                <img src="{{asset('voxo_front/assets/svg/list.svg')}}" class="img-fluid blur-up lazyload"
                                                     alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- label and featured section -->

                    <!-- Prodcut setion -->
                    {{--            PHAN HIEN THI DANH SACH SAN PHAM--}}
                    <div class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
                        @foreach($products as $product)
                            <div>
                                <div class="product-box">
                                    {{--                        ANH SAN PHAM--}}
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="{{route('productdetail', ['id' => $product->id])}}">
                                                <img src="{{asset('images/'.$product->image)}}"
                                                     class="bg-img blur-up lazyload" alt="">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="product-details">
                                        {{--                            TEN NHAN HANG--}}
                                        <div class="rating-details">
                                            <span class="font-light grid-content">{{$product->brand->name}}</span>
                                        </div>
                                        {{--                            TEN SAN PHAM + GIA TIEN--}}
                                        <div class="main-price">
                                            <a href="{{route('productdetail', ['id' => $product->id])}}" class="font-default">
                                                <h5 class="ms-0">{{$product->name}}</h5>
                                            </a>
                                            <h3 class="theme-color">${{number_format($product->price)}}</h3>
                                            {{--                                    <button onclick="location.href = 'cart.html';)" class="btn listing-content">Add To Cart</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav class="page-section">
                        <ul class="pagination">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section end -->


@endsection
