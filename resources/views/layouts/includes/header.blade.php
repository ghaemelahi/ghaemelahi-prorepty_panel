<header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
    <div class="row align-items-center">
        <div class="col-lg-4 col-sm-6 col-md-4">
            <div class="left-header-content">
                <ul
                    class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                    <li>
                        <button class="header-burger-menu bg-transparent p-0 border-0" id="header-burger-menu">
                            <i data-feather="menu"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 col-sm-6 col-md-8">
            <div class="right-header-content mt-2 mt-sm-0">
                <ul
                    class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                    <li class="header-right-item d-none d-md-block">
                        <div class="today-date">
                            <span id="digitalDate"></span>
                            <i data-feather="calendar"></i>
                        </div>
                    </li>
                    <li class="header-right-item">
                        <div class="dropdown admin-profile">
                            <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor"
                                data-bs-toggle="dropdown">
                                <div class="flex-shrink-0">
                                    <img class="rounded-circle wh-54" src="{{ asset('assets/images/admin.jpg') }}"
                                        alt="admin">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-none d-xxl-block">
                                            @if (auth()->user())
                                                <span class="degeneration">مدیر</span>
                                            @endif
                                            <div class="d-flex align-content-center">
                                                <h3>{{ auth()->user()->name ?? session()->get('agent_name') }}</h3>
                                                <div class="down">
                                                    <i data-feather="chevron-down"></i>
                                                </div>
                                            </div>
                                            @if (auth()->user() || session()->get('agent_name'))
                                                <span class="text-success">🟢 آنلاین</span>
                                            @else
                                                <span class="text-danger">🔴 آفلاین</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="dropdown-menu border-0 bg-white w-100 admin-link">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-body" href="profile.html">
                                        <i data-feather="user"></i>
                                        <span class="ms-2">پروفایل</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-body" href="account.html">
                                        <i data-feather="settings"></i>
                                        <span class="ms-2">تنظیمات</span>
                                    </a>
                                </li>
                                <li>
                                    @if (Auth::check())
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center text-body"
                                                href="logout.html">
                                                <i data-feather="log-out"></i>
                                                <span class="ms-2">خروج</span>
                                            </button>
                                        </form>
                                    @elseif(session()->get('agent_name'))
                                        <form action="{{ route('logoute_agent') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center text-body"
                                                href="logout.html">
                                                <i data-feather="log-out"></i>
                                                <span class="ms-2">خروج</span>
                                            </button>
                                        </form>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
