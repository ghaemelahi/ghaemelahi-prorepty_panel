<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="{{ route('dashbord') }}" class="d-block text-decoration-none">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">RAGEH</span>
        </a>
        <button
            class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>
    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            @if (auth()->user())
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">مدیریت</span>
                </li>


                {{-- <li class="menu-item">
                <a href="{{ route('admin_agent_list') }}" class="menu-link">
                    <i data-feather="users" class="menu-icon tf-icons"></i>
                    <div data-i18n="لیست نمایندگان">لیست نمایندگان</div>
                </a>
            </li> --}}

                @role('admin')
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle active">
                            <i class="menu-icon flaticon-user"></i>
                            {{-- <i data-feather="users" class="menu-icon tf-icons"></i> --}}
                            <span class="title">کاربران سیستم</span>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('user_system') }}" class="menu-link">
                                    لیست کاربران سیستم
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle active">
                        <i class="menu-icon tf-icons flaticon-shopping-cart"></i>
                        {{-- <i data-feather="shopping-cart" class="menu-icon tf-icons flaticon-shopping-cart"></i> --}}
                        <span class="title">خریداران</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('buyers') }}" class="menu-link">
                                لیست خریداران
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle active">
                        <i class="menu-icon tf-icons flaticon-price-tag"></i>
                        {{-- <i data-feather="shopping-cart" class="menu-icon tf-icons flaticon-shopping-cart"></i> --}}
                        <span class="title">املاک برای خرید</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('list_buyers_requests') }}" class="menu-link">
                                لیست املاک برای خرید
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('rent_list_requests') }}" class="menu-link">
                                لیست املاک برای اجاره
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle active">
                        <i class="menu-icon tf-icons flaticon-price-tag-1"></i>
                        {{-- <i data-feather="shopping-cart" class="menu-icon tf-icons flaticon-shopping-cart"></i> --}}
                        <span class="title">فروشندگان</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('sellers') }}" class="menu-link">
                                لیست فروشندگان
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle active">
                        <i class="menu-icon tf-icons flaticon-price-tag"></i>
                        {{-- <i data-feather="shopping-cart" class="menu-icon tf-icons flaticon-shopping-cart"></i> --}}
                        <span class="title">املاک برای فروش</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('list_sells_requests') }}" class="menu-link">
                                لیست املاک برای فروش
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('rent_list_sells_requests') }}" class="menu-link">
                                لیست املاک برای اجاره
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle active">
                        {{-- <i class="menu-icon tf-icons flaticon-price-tag"></i> --}}
                        <i data-feather="archive" class="menu-icon tf-icons flaticon-archive"></i>
                        <span class="title">آرشیو</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('archives') }}" class="menu-link">
                                لیست آرشیو
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle active">
                        {{-- <i class="menu-icon tf-icons flaticon-price-tag"></i> --}}
                        <i class="menu-icon tf-icons flaticon-lock"></i>
                        <span class="title">حذف شده‌ها</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('delete_buyers_list') }}" class="menu-link">
                                خریداران
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('delete_buyer_request_list') }}" class="menu-link">
                                درخواست‌های خرید
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('delete_sellers_list') }}" class="menu-link">
                                فروشندگان
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('delete_request_seller_list') }}" class="menu-link">
                                درخواست‌های فروش
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </aside>
    <div class="bg-white z-1 admin">
        <div class="d-flex align-items-center admin-info border-top">
            <div class="flex-shrink-0">
                <a href="profile.html" class="d-block">
                    <img src="{{ asset('assets/images/admin.jpg') }}" class="rounded-circle wh-54" alt="admin">
                </a>
            </div>
            <div class="flex-grow-1 ms-3 info">
                <a href="profile.html"
                    class="d-block name">{{ Auth::user()->name }}</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn" type="submit">خروج</button>
                    </form>
            </div>
        </div>
    </div>
</div>
