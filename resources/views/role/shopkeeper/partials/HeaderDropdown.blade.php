<li role="separator" class="divider"></li>
<li><a href="{{ route('user.show', $user->id ) }}"><i class="ti-user"></i> My Profile</a></li>
<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
@if( $user->hasShop() ) 
<li><a href="{{ route('shop.show', $user->getShopId() ) }}"><i class="ti-home"></i> Go My Shop</a></li>
    <li><a href="{{ route('shop.edit', $user->getShopId() ) }}"><i class="ti-panel"></i> Edit My Shop</a></li>
    <li><a href="#"><i class="ti-dashboard"></i> Go To My Dashboard</a></li>
    <li><a href="{{ route('product.create') }}"><i class="ti-plus"></i> Add New Product</a></li>
@endif
<li role="separator" class="divider"></li>
<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li> 