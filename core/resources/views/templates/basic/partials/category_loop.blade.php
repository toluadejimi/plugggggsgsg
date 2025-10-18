@foreach($categories as $category)
    @php $products = $category->products; @endphp

    <div class="catalog-item-wrapper mb-2">
        <div class="d-grid gap-2 mb-2">
            <strong>
                <p style="font-size: 11px; background: linear-gradient(90deg, #020c49 0%, #4855a6 100%); border-radius:10px; color: white"
                   class="p-2">{{ __($category->name) }}</p>
            </strong>
        </div>
    </div>

    <div class="col-12">
        @foreach ($products->take(5) as $product)
            @include($activeTemplate . 'partials.products')
        @endforeach
    </div>



    <div class="col-12 d-flex justify-content-end mb-4">
        <a href="{{ route('category.products', ['search' => request()->search, 'slug' => slug($category->name), 'id' => $category->id]) }}"
           class="btn btn-main btn-lg w-100 pill">
            @lang('View All')
        </a>
    </div>

    <div class="col-lg-12 col-md-12 my-3">
        <div class="card" style="background: linear-gradient(135deg, #4652f6 0%, #010647 100%); border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div class="card-body text-center p-4">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-mobile-alt fa-2x text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="text-white mb-1" style="font-weight: bold;">📱 Get Virtual Numbers!</h5>
                        <p class="text-white-50 mb-0" style="font-size: 14px;">For all types of verification</p>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-8 text-md-start text-center">
                        <h6 class="text-white mb-2">Try SMSLORD.COM</h6>
                        <p class="text-white-50 mb-3" style="font-size: 13px;">
                            Virtual numbers for verification<br>
                            WhatsApp • Telegram • SMS • OTP
                        </p>
                        <div class="d-flex flex-wrap gap-2 justify-content-md-start justify-content-center">
                            <span class="badge bg-light text-dark">WhatsApp</span>
                            <span class="badge bg-light text-dark">Telegram</span>
                            <span class="badge bg-light text-dark">SMS</span>
                            <span class="badge bg-light text-dark">OTP</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mt-3 mt-md-0">
                        <a href="https://smslord.com" target="_blank" class="btn btn-light btn-lg px-4 py-2" style="font-weight: bold; border-radius: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                            <i class="fas fa-external-link-alt me-2"></i>
                            Visit Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endforeach



