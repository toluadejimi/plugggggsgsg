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


{{--                    <div class="swiper-slide">--}}
{{--                        <a href="https://Wa.me/+2347049631912">--}}
{{--                            <div class="card">--}}
{{--                                <img src="{{ url('') }}/assets/assets2/images/slider/slider6.png"--}}
{{--                                     alt="wallet-image">--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}


                    <div class="swiper-slide">
                        <a href="https://smslord.com/">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slider8.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>


{{--                    <div class="swiper-slide">--}}
{{--                        <a href="https://socialplugboost.com/">--}}
{{--                            <div class="card">--}}
{{--                                <img src="{{ url('') }}/assets/assets2/images/slider/slider9.png"--}}
{{--                                     alt="wallet-image">--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}


                    <div class="swiper-slide">
                        <a href="/user/refer">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slider7.jpg"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>







                    <div class="swiper-slide">
                        <a href="https://chat.whatsapp.com/FMHbUFjeZi9Jy3raLXB3ZG">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slide1.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>


                    <div class="swiper-slide">
                        <a href="T.me/custmoerlogsms">
                            <div class="card">
                                <img src="{{ url('') }}/assets/assets2/images/slider/slide2.png"
                                     alt="wallet-image">
                            </div>
                        </a>
                    </div>

                    <div class="swiper-slide ">
                        <a href="https://t.me/Loggsplugonline">
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

                <div class="col-xl-9 col-sm-12 d-flex justify-content-start ">

                    <h4 class="mb-0"
                        style=" background: linear-gradient(270deg, #D0CCA1 9.16%, #DD553E 42.99%, #3219E3 87.83%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-fill-color: transparent;">
                        HI {{Auth::user()->username ?? ""}},</h4>

                </div>

                <div class="col-xl-3 col-sm-12 d-flex justify-content-end">
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
                    <div id="category-wrapper">
                        @include($activeTemplate . 'partials.category_loop')
                    </div>

                    <div class="text-center my-3" id="loading" style="display: none;">
                        <p>Loading more...</p>
                    </div>
                </div>

                <div class="text-center my-3" id="loading" style="display: none;">
                    <p>Loading more...</p>
                </div>

            </div>


        </div>


        <div class="col-12 my-4">
            @auth

                <div class="card-title mt-3 text-center">
                    <h6 style="background: #565656; padding: 10px; border-radius: 10px; color: white"
                        class="text-left">RECENT ORDER</h6>
                </div>


                <div style="height:400px; width:100%; overflow-y: scroll;" class="card">
                    <div class="card-body">


                        <div class="dashboard-body__item">
                            <div class="table-responsive">
                                <table class="table style-two">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Time</th>

                                    </tr>

                                    @if($bought_qty == 0)
                                    @else
                                        @foreach($bought as $data)

                                            <tr>
                                                <td>{{\Illuminate\Support\Str::limit($data->user_name,4, '.')}}, <span style="color: #f10054">just purchase</span><br/> {{\Illuminate\Support\Str::limit($data->item,
                                    16, '...')}}<span style="color: #000000">₦{{number_format($data->amount)}}</span></td>
                                                <td>{{ diffForHumans($data->created_at) }}</td>
                                            </tr>

                                        @endforeach
                                    @endif



                                    </thead>
                                </table>
                            </div>
                        </div>





                    </div>
                </div>
            @else

            @endauth

        </div>



    </div>





    <script>
        let nextPage = "{{ $categories->nextPageUrl() }}";
        let loading = false;

        window.onscroll = function () {
            if (loading || !nextPage) return;

            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
                loading = true;
                document.getElementById('loading').style.display = 'block';

                fetch(nextPage, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        const wrapper = document.getElementById('category-wrapper');
                        wrapper.insertAdjacentHTML('beforeend', data.html);
                        nextPage = data.next_page;
                        loading = false;
                        document.getElementById('loading').style.display = 'none';
                    })
                    .catch(error => {
                        console.error('Error loading more:', error);
                        loading = false;
                        document.getElementById('loading').style.display = 'none';
                    });
            }
        };
    </script>



@endsection
