@extends('layouts.template')

@section('content')
<div>
    <div class="filterProduct">

    </div>

    <div class="chooseProduct">
        <div class="menuProduct">
            <!-- Hiển thị danh mục-->
            <form method="GET" action="{{ route('products') }}">
                <button type="submit">Filter</button>
                @foreach ($getCategory as $category)
                    <div>
                        <label style="font-size: 18px, font-weight:500">{{ $category->NameCategory }}</label><br>
                        <div>
                            <input type="checkbox" name="filter[]" value="{{ $category->IdCategory }}"
                            {{ in_array($category->IdCategory, array_map(fn($f) => explode(',', $f)[0], request('filter', []))) && !collect(request('filter'))->contains(',') ? 'checked' : '' }}>
                            <label>All</label>
                        </div>
                        @foreach ($getSubCategory as $subCategory)
                            @if ($category->IdCategory==$subCategory->IdSubCategory)
                                <div>
                                    <input type="checkbox" name="filter[]" value="{{ $category->IdCategory }},{{ $subCategory->IdSub }}"
                                    {{ in_array($category->IdCategory.','.$subCategory->IdSub, request('filter', [])) ? 'checked' : '' }}>
                                    <label>{{ $subCategory->Name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </form>
        </div>
        <div>
            <!-- Hiển thị sản phẩm -->
            <div class="listProduct">
                @foreach ($getProduct as $product)
                    <div class="product-item">
                        @include('components.product_box', ['product' => $product])
                    </div>
                @endforeach
            </div>
            <!-- Thêm phân trang -->
            <div style="margin-top: 20px">
                <div class="d-flex justify-content-center mt-4">
                    {{ $getProduct->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection