@extends('layouts.template')

@section('content')
    <div class="detailProduct">
        <div style="display: flex; justify-content: space-between;">
            <div class="imageProduct">
                <img src="{{ asset($DetailProduct->ImageURL) }}" alt="{{ $DetailProduct->NameProduct }}" width="100%">
                <div class="typeProduct">{{ $DetailProduct->TypeProduct }}</div>
                <div class="discountProduct">
                    @if ($DetailProduct->OldPrice == 0)
                        New
                    @else
                        -{{ round(100 - ($DetailProduct->NewPrice / $DetailProduct->OldPrice * 100)) }}%
                    @endif
                </div>
            </div>
            <div class="infoProduct">
                <div class="nameProduct">{{ $DetailProduct->NameProduct }}</div>
                <div class="rateProduct"></div>
                <div style="display: flex;">
                    @if ($DetailProduct->OldPrice >0)
                        <div class="old-price">
                            ${{ $DetailProduct->OldPrice }}
                        </div>
                    @endif
                    <div class="new-price">
                        ${{ $DetailProduct->NewPrice }}
                    </div>
                </div>
                <div class="shortDescription">
                    @php
                        use Illuminate\Support\Str;
                        // Lấy đoạn đầu khoảng 200 ký tự (strip_tags để loại bỏ HTML khi cắt)
                        $shortDesc = Str::limit(strip_tags($DetailProduct->Description), 200);
                    @endphp
                    {!! $shortDesc !!}
                    <a href="#description" style="color:#3F5D45; text-decoration: none;">Read more</a>
                </div>
                <div class="categoryProduct">
                    @if ($DetailProduct->SubCategory==null)
                        @foreach ($getCategory as $row)
                            @if ($row->IdCategory == $DetailProduct->Category)
                                Category: <a href="" style="text-decoration: none; color: #3F5D45">{{ $row->NameCategory }}</a>
                            @endif
                        @endforeach
                    @else
                        @foreach ($getSubCategory as $row)
                            @if ($row->IdSub == $DetailProduct->SubCategory && $row->IdSubCategory == $DetailProduct->Category)
                                Category: <a href="" style="text-decoration: none; color: #3F5D45">{{ $row->NameCategory }} / {{ $row->Name }}</a>
                            @endif
                        @endforeach
                    @endif
                </div>
                <form style="margin-bottom: 2em">
                    @csrf
                    @if ($optionProduct != null)
                        <div class="optionProduct">
                            @php
                                $hasSize = $optionProduct->where('OptionProduct', 'SIZE')->isNotEmpty();
                                $hasType = $optionProduct->where('OptionProduct', 'TYPE')->isNotEmpty();
                            @endphp
                            @if ($hasSize)
                                <div class="size">
                                    <label>Size</label><br>
                                    <select name="optionSize" id="optionSize">
                                        @foreach ($optionProduct as $row)
                                            @if($row->OptionProduct == 'SIZE')
                                                <option value="{{ $row->IdOption }}" data-bonus-price="{{ $row->BonusPrice }}"
                                                    @if($row->Quantity == 0) disabled @endif>
                                                    {{ $row->SubOption }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if ($hasType)
                                <div class="option">
                                    <label>Type</label><br>
                                    <select name="optionType" id="optionType">
                                        @foreach ($optionProduct as $row)
                                            @if($row->OptionProduct == 'TYPE')
                                                <option value="{{ $row->IdOption }}" data-bonus-price="{{ $row->BonusPrice }}"
                                                    @if ($row->Quantity == 0) disabled @endif>
                                                    {{ $row->SubOption }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($hasSize==null)
                        <input type="hidden" name="optionSize" value="">
                    @elseif ($hasType==null)
                        <input type="hidden" name="optionType" value="">
                    @endif
                    <input type="hidden" name="idProduct" value="{{ $DetailProduct->IdProduct }}">
                    <input type="hidden" name="finalPrice" class="final-price-input" value="{{ $DetailProduct->NewPrice }}">

                    <input type="number" name="numberProduct" value="1" min="1" style="text-align: center;height: 3em;">
                    <button type="submit" name="action" value="add" style="width: 10em; height:3em;background-color: #3F5D45; color: white; border-color: white; border-radius: 5px;">
                        Add to Cart
                    </button>
                    <button type="submit" name="action" value="buy" style="width: 10em; height:3em;background-color: #3F5D45; color: white; border-color: white; border-radius: 5px;">
                        Buy Now
                    </button>
                </form>
                <form>
                    @csrf
                    <input type="hidden" name="idProduct" value="{{ $DetailProduct->IdProduct }}">
                    <button type="submit" name="action" value="wishlist" style="width: 10em; height:3em; background-color: #3F5D45; color: white; border-color: white; border-radius: 5px;">
                        WishList
                    </button>
                    <button type="submit" name="action" value="Compare" style="width: 10em; height:3em;background-color: #3F5D45; color: white; border-color: white; border-radius: 5px;">
                        Compare
                    </button>
                </form>
            </div>
        </div>
        <div>
            <div class="tab-buttons">
                <button class="tab-button active" onclick="showTab('description')">Description Product</button>
                <button class="tab-button" onclick="showTab('shipping')">Shipping</button>
            </div>
            <div id="description" class="tab-content active">
                {!! $DetailProduct->Description !!}
            </div>
            <div id="shipping" class="tab-content">
                456
            </div>
            <script>
                function showTab(tabId) {
                // Ẩn tất cả tab
                document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));

                // Hiển thị tab được chọn
                document.getElementById(tabId).classList.add('active');
                event.target.classList.add('active');
                }
            </script>
            <script>
                const basePrice = {{ $DetailProduct->NewPrice }};
                const newPriceEl = document.querySelector('.new-price');
                const priceInput = document.querySelector('.final-price-input');

                function updatePrice() {
                    let totalBonus = 0;

                    const selectedSize = document.querySelector('#optionSize');
                    const selectedType = document.querySelector('#optionType');

                    if (selectedSize && selectedSize.value !== "") {
                        const sizeBonus = parseInt(selectedSize.options[selectedSize.selectedIndex].dataset.bonusPrice || 0);
                        totalBonus += sizeBonus;
                    }

                    if (selectedType && selectedType.value !== "") {
                        const typeBonus = parseInt(selectedType.options[selectedType.selectedIndex].dataset.bonusPrice || 0);
                        totalBonus += typeBonus;
                    }

                    const finalPrice = basePrice + totalBonus;
                    newPriceEl.innerText = '$' + finalPrice.toLocaleString();
                    if (priceInput) {
                        priceInput.value = finalPrice;
                    }
                }

                // Gắn sự kiện thay đổi cho cả hai dropdown nếu tồn tại
                document.addEventListener('DOMContentLoaded', function () {
                    const sizeSelect = document.getElementById('optionSize');
                    const typeSelect = document.getElementById('optionType');

                    if (sizeSelect) sizeSelect.addEventListener('change', updatePrice);
                    if (typeSelect) typeSelect.addEventListener('change', updatePrice);

                    updatePrice(); // Cập nhật ban đầu nếu có giá trị chọn sẵn
                });
            </script>
        </div>
    </div>
@endsection
