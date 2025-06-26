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
@endforeach
