<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        @auth
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{asset('assets/images/users/1.jpg')}}" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ auth()->user()->name }} <span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    @includeWhen( auth()->user()->hasRole('shopkeeper') , 'role.shopkeeper.partials.SidebarDropdown', ['user' => auth()->user()])
                    <div class="dropdown-divider"></div>
                    <a href="logout" class=" logoutButton dropdown-item" data-toggle="tooltip" title="Logout"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        @endauth
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav my-2">
            <ul id="sidebarnav">
                {{-- <li class="nav-small-cap">Categories</li> --}}
                <li>
                    <a  href="{{ route('product.index') }}" aria-expanded="false"><i class="mdi mdi-pig"></i><span class="hide-menu">Products </span></a>
                </li>
                <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-folder-multiple"></i><span class="hide-menu">Categories <span class="label label-rounded label-success">{{ $categories->count()}}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="has-arrow" href="#" aria-expanded="false"> <i class="mdi mdi-folder-star"></i> Most Used</a>
                            <ul aria-expanded="false" class="collapse">
                                @foreach ($categories->getMostUsed() as $category)
                                <li><a href="#"><span class="label label-rounded label-inverse"> {{ $category->products_count}}</span> {{ $category->name}} </a></li>                                    
                                @endforeach
                            </ul>
                        </li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"> <i class="mdi mdi-folder-upload"></i> Most Recently Used</a>
                            <ul aria-expanded="false" class="collapse">
                                @foreach ($categories->getMostRecent() as $category)
                                <li><a href="#"> <span class="label label-rounded label-inverse"> {{ $category->products_count}}</span> {{ $category->name}}</a></li>                                    
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="#">All tags (?)</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-tag-multiple"></i><span class="hide-menu">Tags <span class="label label-rounded label-success">{{ $tags->count()}}</span> </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="has-arrow" href="#" aria-expanded="false"> <i class="mdi mdi-tag-faces"></i> Most Used</a>
                            <ul aria-expanded="false" class="collapse">
                                @foreach ($tags->getMostUsed() as $tag)
                                <li><a href="#"> <span class="label label-rounded label-inverse"> {{ $tag->products_count}}</span> {{ $tag->name}} </a></li>                                    
                                @endforeach
                            </ul>
                        </li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"> <i class="mdi mdi-tag-plus"></i> Most Recently Used</a>
                            <ul aria-expanded="false" class="collapse">
                                @foreach ($tags->getMostRecent() as $tag)
                                <li><a href="#"> <span class="label label-rounded label-inverse"> {{ $tag->products_count}}</span> {{ $tag->name}} </a></li>                                    
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="#">All tags (?)</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Ui Elements</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="ui-cards.html">Cards</a></li>
                    </ul>
                </li>
                {{-- <li class="nav-devider"></li>
                <li class="nav-small-cap">FORMS, TABLE &amp; WIDGETS</li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Forms</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="form-basic.html">Basic Forms</a></li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer linear-transition">
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item-->
        @auth
        <a  href="logout" class="link logoutButton" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
        @endauth
    </div>
    <!-- End Bottom points-->
</aside>