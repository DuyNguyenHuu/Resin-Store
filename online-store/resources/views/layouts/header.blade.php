<div>
    <div class="orderTracking">
        <div>
            <a href="" target="_blank" style="display:flex; text-decoration: none;">
                <i class="fa-solid fa-location-dot"></i>
                <p>Track Order</p>
            </a>
        </div>
        <div>
            <a href="" target="_blank" style="text-decoration: none;">Sign in / Sign up</a>
        </div>
    </div>
    <div class="header">
        <div class="logo">
            <a href="" target="_blank">
                <img style="height: 4em" src="https://phuongnamvina.com/img_data/images/design-logo-ban-hang-online.jpg">
            </a>
        </div>
        <div class="search">
            <form>
                <input placeholder="Search Product">
                <i class="fa-solid fa-magnifying-glass" type="submit"></i>
            </form>
        </div>
        <div class="check">
            <div style="text-align:center">
                <i class="fa-solid fa-code-compare"></i>
                <p>Compare</p>
            </div>
            <div style="text-align:center">
                <i class="fa-regular fa-heart"></i>
                <p>WishList</p>
            </div>
            <div style="text-align:center">
                <i class="fa-solid fa-cart-shopping"></i>
                <p>Cart</p>
            </div>
        </div>
    </div>
</div>
<div class="menu">
    <div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
            </button>
            <ul class="dropdown-menu">
                @foreach ( $getCategory as $row)
                    <li ><button class="dropdown-item" type="button">{{ $row->NameCategory }}</button></li>
                @endforeach
            </ul>
          </div>
    </div>
    <div class="menuDetail"><a href="{{ route('home') }}">Home</a></div>
    <div class="menuDetail"><a href="{{ route('products') }}">Products</a></div>
    <div class="menuDetail"><a href="" >Deals</a></div>
    <div class="menuDetail"><a href="" >Collections</a></div>
    <div class="menuDetail"><a href="{{ route('blogs') }}" >Blogs</a></div>
    <div class="menuDetail"><a href="" >Contact</a></div>
</div>