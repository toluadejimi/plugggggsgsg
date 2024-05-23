@extends($activeTemplate . 'layouts.main')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger my-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger mt-2">
            {{ session()->get('error') }}
        </div>
    @endif

    <!-- Recent -->
    <div class="m-b1">
        <div class="swiper-btn-center-lr">
            <div class="swiper-container tag-group mt-4 demo-swiper">
                <div class="swiper-wrapper">


                    <div class="swiper-slide">
                        <a href="https://Wa.me/+2347049631912">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slider6.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>


                    <div class="swiper-slide">
                        <a href="/user/refer">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slider8.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>


                    <div class="swiper-slide">
                        <a href="https://smslord.com/">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slider9.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>


                    <div class="swiper-slide">
                        <a href="/user/refer">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slider7.jpg"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>







                    <div class="swiper-slide">
                        <a href="https://chat.whatsapp.com/LaT8j2YC9KG8RH0iKAZlEj">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slide1.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>


                    <div class="swiper-slide">
                        <a href="https://t.me/Dmloggsplugdotcomdotcom">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slide2.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>

                    <div class="swiper-slide ">
                        <a href="https://t.me/Dmloggsplugdotcom">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slide3.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slide4.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>

                    <div class="swiper-slide">
                        <a href="/user/send-gift">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slider5.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent -->
    <div class="dashboard-body__content">

        <!-- welcome balance Content Start -->
        <div class="welcome-balance mt-2 mb-5">

            <div class="row">

                <div class="col-9 d-flex justify-content-start">

                    <h4 class="mb-0"
                        style=" background: linear-gradient(270deg, #D0CCA1 9.16%, #DD553E 42.99%, #3219E3 87.83%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-fill-color: transparent;">
                        HI {{Auth::user()->username ?? ""}},</h4>

                </div>

                <div class="col-3 d-flex justify-content-end">
                    <select id="urlSelect" onchange="redirectToUrl()" class="btn btn-sm btn-dark">
                        <option value="">Categories</option>
                        @foreach($categories as $data)
                            <option value="{{url('')}}/category-products/{{$data->name}}/{{$data->id}}">{{$data->name}}
                            </option>
                        @endforeach
                    </select>

                    <script>
                        function redirectToUrl() {
                            var selectElement = document.getElementById("urlSelect");
                            var selectedUrl = selectElement.options[selectElement.selectedIndex].value;
                            if (selectedUrl !== "") {
                                window.location.href = selectedUrl;
                            }
                        }
                    </script>

                </div>

            </div>


        </div>
        <!-- welcome balance Content End -->

        <div class="dashboard-body__item-wrapper">

            <div class="">
                <div>
                    <h5 class="d-flex justify-content-start">Explore Product 👌</h5>
                </div>

                <div class="col-12">
                    @forelse($categories as $category)
                        @php
                            $products = $category->products;
                        @endphp
                        <div class="catalog-item-wrapper mb-2">
                            <div class="d-grid gap-2 mb-2">
                                <strong>
                                    <p style="font-size: 11px; background: linear-gradient(90deg, #020c49 0%, #4855a6 100%); border-radius:10px; color: white"
                                       class="p-2">{{ __($category->name) }}</p>
                                </strong>
                            </div>

                            <div
                                style="font-size: 11px; border-radius: 10px; padding: 4px; background: #020000;color: #ffffff;">

                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-5">Product</div>
                                    <div class="col-3">Price</div>
                                    <div class="col-2">Stock</div>
                                </div>
                            </div>


                        </div>
                </div>


                <div class="col-12">

                    @foreach ($products->take(5) as $product)
                        @include($activeTemplate . 'partials/products')
                    @endforeach

                </div>


                <div class="col-12 d-flex justify-content-end mb-4">
                    <a style="background: linear-gradient(90deg, #020c49 0%, #4855a6 100%); border-radius:10px; color: white"
                       href="{{ route('category.products', ['search' => request()->search, 'slug' => slug($category->name), 'id' => $category->id]) }}"
                       class="btn btn-main btn-lg w-100 pill">
                        @lang('View All')
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                    </a>
                </div>


                @empty

                    <div class="empty-data text-center">
                        <div class="thumb">
                            <img src="{{ asset($activeTemplateTrue . 'images/not-found.png') }}">
                        </div>

                        <h4 class="title">@lang('No result found for "' . request()->search . '"')</h4>
                    </div>
                @endforelse
                {{ paginateLinks($categories) }}
            </div>


        </div>


    </div>























    {{--    @auth--}}

    {{--        <div class="author-notification">--}}

    {{--            <div class="p-2">--}}

    {{--                @if ($errors->any())--}}
    {{--                    <div class="alert alert-danger my-4">--}}
    {{--                        <ul>--}}
    {{--                            @foreach ($errors->all() as $error)--}}
    {{--                                <li>{{ $error }}</li>--}}
    {{--                            @endforeach--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if (session()->has('message'))--}}
    {{--                    <div class="alert alert-success">--}}
    {{--                        {{ session()->get('message') }}--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if (session()->has('error'))--}}
    {{--                    <div class="alert alert-danger mt-2">--}}
    {{--                        {{ session()->get('error') }}--}}
    {{--                    </div>--}}
    {{--                @endif--}}




    {{--            </div>--}}


    {{--            <div class="container inner-wrapper">--}}


    {{--                <div class="dz-info">--}}
    {{--                    <span class="text-dark">{{$greetings}}</span>--}}
    {{--                    <h3 class="name mb-0">{{ Auth::user()->username }} 👋</h3>--}}
    {{--                </div>--}}

    {{--                <div class="dz-info">--}}
    {{--                    <img src="{{ url('') }}/assets/assets/images/wallet.svg" alt="wallet-image" width="30"--}}
    {{--                        height="30">--}}
    {{--                    <strong class="text-dark">NGN{{number_format(Auth::user()->balance)}}</strong><br>--}}
    {{--                    <a href="/user/deposit/new" class="position-relative me-2 btn btn-block btn-dark">--}}
    {{--                        Fund Wallet--}}
    {{--                    </a>--}}

    {{--                </div>--}}


    {{--                <div class="offcanvas offcanvas-bottom rounded-0" tabindex="-1" id="offcanvasBottom2">--}}
    {{--                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">--}}
    {{--                        <i class="fa-solid fa-xmark"></i>--}}
    {{--                    </button>--}}
    {{--                    <div class="offcanvas-body container fixed">--}}

    {{--                        <div class="text-center mt-5">--}}

    {{--                            <img src="{{ url('') }}/assets/assets/images/wall.svg" alt="wallet-image" width="70"--}}
    {{--                                height="70">--}}



    {{--                            <div class="my-3">--}}
    {{--                                <h6>Fund Wallet</h6>--}}
    {{--                                <p>Top up your funds in your wallet</p>--}}
    {{--                            </div>--}}

    {{--                        </div>--}}

    {{--                        <form class="mt-3" action="/user/deposit/insert" method="POST">--}}
    {{--                            @csrf--}}

    {{--                            <div class="form-group col-md-12">--}}

    {{--                                <div class="mb-3 input-group">--}}
    {{--                                    <span class="input-group-text"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>--}}
    {{--                                    <input type="text" class="form-control" placeholder="Enter Amount to fund">--}}
    {{--                                </div>--}}

    {{--                            </div>--}}


    {{--                            <div class="form-group col-md-12">--}}
    {{--                                <label class="form--label">@lang('Select Gateway')</label>--}}
    {{--                                <select class="form-control form-select" name="gateway" required>--}}
    {{--                                    <option value="">@lang('Select One')</option>--}}
    {{--                                    @foreach ($gateway_currency as $data)--}}
    {{--                                        <option value="{{ $data->method_code }}" data-gateway="{{ $data }}">--}}
    {{--                                            {{ $data->name }}</option>--}}
    {{--                                    @endforeach--}}
    {{--                                </select>--}}
    {{--                            </div>--}}


    {{--                            <div class="view-title">--}}
    {{--                                <div class="container">--}}
    {{--                                    <button type="submit"--}}
    {{--                                        class="btn btn-primary btn-rounded btn-block flex-1 ms-2">CONFIRM</button>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                        </form>--}}



    {{--                    </div>--}}
    {{--                </div>--}}



    {{--            </div>--}}
    {{--        </div>--}}
    {{--    @else--}}
    {{--        <div class="my-5">--}}


    {{--        </div>--}}


    {{--    @endauth--}}


    {{--    <!-- Banner End -->--}}

    {{--    <!-- Page Content -->--}}
    {{--    <div class="page-content">--}}

    {{--        <div class="content-inner pt-0">--}}
    {{--            <div class="container fb">--}}
    {{--                <!-- Search -->--}}
    {{--                <form action="search" class="search-form">--}}
    {{--                    <div class="mb-3 input-group input-radius">--}}
    {{--                        <span class="input-group-text">--}}
    {{--                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
    {{--                                <path--}}
    {{--                                    d="M20.5605 18.4395L16.7528 14.6318C17.5395 13.446 18 12.0262 18 10.5C18 6.3645 14.6355 3 10.5 3C6.3645 3 3 6.3645 3 10.5C3 14.6355 6.3645 18 10.5 18C12.0262 18 13.446 17.5395 14.6318 16.7528L18.4395 20.5605C19.0245 21.1462 19.9755 21.1462 20.5605 20.5605C21.1462 19.9748 21.1462 19.0252 20.5605 18.4395ZM5.25 10.5C5.25 7.605 7.605 5.25 10.5 5.25C13.395 5.25 15.75 7.605 15.75 10.5C15.75 13.395 13.395 15.75 10.5 15.75C7.605 15.75 5.25 13.395 5.25 10.5Z"--}}
    {{--                                    fill="#B9B9B9" />--}}
    {{--                            </svg>--}}
    {{--                        </span>--}}
    {{--                        <input type="text" name="keyword" placeholder="Search product" class="form-control main-in ps-0 bs-0"--}}
    {{--                            @if (request()->routeIs('products') || request()->routeIs('category.products')) value="{{ request()->search }}" @endif>--}}
    {{--                    </div>--}}
    {{--                </form>--}}

    {{--                <!-- Dashboard Area -->--}}
    {{--                <div class="dashboard-area">--}}

    {{--                    <!-- Categorie -->--}}
    {{--                    <div class="swiper-btn-center-lr">--}}
    {{--                        <div class="swiper-container mt-4 categorie-swiper">--}}
    {{--                            <div class="swiper-wrapper">--}}
    {{--                                @foreach ($categories as $data)--}}
    {{--                                    <div class="swiper-slide">--}}
    {{--                                        <a href="/category-products/{{$data->name}}/{{$data->id}}" class="categore-box style-1">--}}
    {{--                                            @if($data->image == null)--}}
    {{--                                                <div class="icon-bx" style="background-color: #ededed">--}}
    {{--                                                    <img src="{{ url('') }}/assets/assets/images/fav.svg"--}}
    {{--                                                         alt="wallet-image" width="30" height="30">--}}
    {{--                                                </div>--}}
    {{--                                                <span class="title text-dark text-small">{{ Str::upper($data->name) }}</span>--}}
    {{--                                            @else--}}
    {{--                                                <div class="icon-bx" style="background-color: #ededed">--}}
    {{--                                                    <img src="{{ url('') }}/assets/assets/images/{{ $data->image }}"--}}
    {{--                                                         alt="wallet-image" width="30" height="30">--}}
    {{--                                                </div>--}}
    {{--                                                <span class="title text-dark text-small">{{ Str::upper($data->name) }}</span>--}}
    {{--                                            @endif--}}

    {{--                                        </a>--}}
    {{--                                    </div>--}}
    {{--                                @endforeach--}}

    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <!-- Categorie End -->--}}

    {{--                    <!-- Recent -->--}}
    {{--                    <div class="m-b1">--}}
    {{--                        <div class="swiper-btn-center-lr">--}}
    {{--                            <div class="swiper-container tag-group mt-4 demo-swiper">--}}
    {{--                                <div class="swiper-wrapper">--}}
    {{--                                    <div class="swiper-slide">--}}
    {{--                                        <a href="#">--}}
    {{--                                        <div class="card">--}}
    {{--                                            <img src="{{ url('') }}/assets/assets/images/slider/slide_1.png"--}}
    {{--                                                alt="wallet-image">--}}
    {{--                                        </div>--}}
    {{--                                        </a>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="swiper-slide active">--}}
    {{--                                        <a href="https://chat.whatsapp.com/CQtiNorfsys3irydIog6ON">--}}
    {{--                                        <div class="card">--}}
    {{--                                            <img src="{{ url('') }}/assets/assets/images/slider/slide_2.png"--}}
    {{--                                                alt="wallet-image">--}}
    {{--                                        </div>--}}
    {{--                                        </a>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="swiper-slide ">--}}
    {{--                                        <a href="https://t.me/LOGGPLUG STORE01">--}}
    {{--                                        <div class="card">--}}
    {{--                                            <img src="{{ url('') }}/assets/assets/images/slider/slide_3.png"--}}
    {{--                                                alt="wallet-image">--}}
    {{--                                        </div>--}}
    {{--                                        </a>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="swiper-slide">--}}
    {{--                                        <a href="https://t.me/LOGGPLUG STOREteam">--}}
    {{--                                        <div class="card">--}}
    {{--                                            <img src="{{ url('') }}/assets/assets/images/slider/slide_4.png"--}}
    {{--                                                alt="wallet-image">--}}
    {{--                                        </div>--}}
    {{--                                        </a>--}}
    {{--                                    </div>--}}
    {{--                                    --}}{{-- <div class="swiper-slide">--}}
    {{--                                        <div class="card">--}}
    {{--                                            <img src="{{ url('') }}/assets/assets/images/slider/slide_5.png"--}}
    {{--                                                alt="wallet-image">--}}
    {{--                                        </div>--}}
    {{--                                    </div> --}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <!-- Recent -->--}}

    {{--                    <!-- Recomended Start -->--}}
    {{--                    <div class="title-bar">--}}
    {{--                        <h5 class="title">Explore Product 👌</h5>--}}
    {{--                    </div>--}}

    {{--                    <div class="row mt-2">--}}

    {{--                        <div class="col-xxl-10 col-xl-11">--}}
    {{--                            @forelse($categories as $category)--}}
    {{--                                @php--}}
    {{--                                    $products = $category->products;--}}
    {{--                                @endphp--}}



    {{--                                <div class="catalog-item-wrapper mb-2">--}}

    {{--                                    <div class="d-grid gap-2 mb-2">--}}
    {{--                                        <strong>--}}
    {{--                                            <p style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); border-radius:10px; color: white"--}}
    {{--                                                class="p-2">{{ __($category->name) }}</p>--}}
    {{--                                        </strong>--}}
    {{--                                    </div>--}}

    {{--                                    <div style="font-size: 11px; border-radius: 100px; background: #10113D;color: #ffffff;">--}}
    {{--                                        <div class="row">--}}
    {{--                                            <div class="col-2"></div>--}}
    {{--                                            <div class="col-3">Product</div>--}}
    {{--                                            <div class="col-5">Price</div>--}}
    {{--                                            <div class="col-2">Stock</div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}


    {{--                                            @foreach ($products->take(5) as $product)--}}
    {{--                                                @include($activeTemplate . 'partials/products')--}}
    {{--                                            @endforeach--}}



    {{--                                        </tbody>--}}


    {{--                                    </table>--}}


    {{--                                    <div class="col-12 d-flex justify-content-end mb-4" >--}}
    {{--                                        <a style="background: linear-gradient(90deg, #0F0673 0%, #B00BD9 100%); color: #ffffff" href="{{ route('category.products', ['search' => request()->search, 'slug' => slug($category->name), 'id' => $category->id]) }}"--}}
    {{--                                            class="btn  btn-sm">--}}
    {{--                                            @lang('View All')--}}
    {{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">--}}
    {{--                                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>--}}
    {{--                                            </svg>--}}


    {{--                                        </a>--}}
    {{--                                    </div>--}}




    {{--                                </div>--}}


    {{--                            @empty--}}

    {{--                                <div class="empty-data text-center">--}}
    {{--                                    <div class="thumb">--}}
    {{--                                        <img src="{{ asset($activeTemplateTrue . 'images/not-found.png') }}">--}}
    {{--                                    </div>--}}

    {{--                                    <h4 class="title">@lang('No result found for "' . request()->search . '"')</h4>--}}
    {{--                                </div>--}}
    {{--                            @endforelse--}}
    {{--                            {{ paginateLinks($categories) }}--}}
    {{--                        </div>--}}
    {{--                    </div>--}}







    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--    </div>--}}




    <!-- Page Content End-->

@endsection
