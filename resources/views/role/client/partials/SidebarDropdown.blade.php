<a href="{{ route('user.show', $user->id) }}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
<a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
@if( $user->hasShop() )
    <a href="{{ route('shop.show', $user->getShopId() ) }}" class="dropdown-item"><i class="ti-home"></i> Go To My Shop</a>
    <a href="{{ route('shop.edit', $user->getShopId() ) }}" class="dropdown-item"><i class="ti-panel"></i> Edit My Shop</a>
    <a href="#" class="dropdown-item"><i class="ti-dashboard"></i> Go My Dashboard</a>
    <a href="{{ route('product.create') }}" class="dropdown-item"><i class="ti-plus"></i> Add Product</a>
@else
<a href="{{ route('shop.create') }}" class="dropdown-item"><i class="ti-world"></i> Create Shop</a>
@endif
<div class="dropdown-divider"></div> 
<a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>