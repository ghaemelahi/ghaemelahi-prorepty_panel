@extends('layouts.app')
@section('title','خانه')
@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-8">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="stats-box card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-1">
                                <div class="flex-grow-1 me-3">
                                    <h3 class="body-font fw-bold fs-3 mb-2">1100 تومان</h3>
                                    <span>کل فروش</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="icon transition">
                                        <i class="flaticon-donut-chart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="svg-success me-2">
                                    <i data-feather="trending-up"></i>
                                </div>
                                <p class="fw-semibold"><span class="text-success">%1.3</span> بالاتر از هفته
                                    گذشته</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="stats-box card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-1">
                                <div class="flex-grow-1 me-3">
                                    <h3 class="body-font fw-bold fs-3 mb-2">1100 تومان</h3>
                                    <span>کل سفارش</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="icon transition">
                                        <i class="flaticon-goal"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="svg-danger me-2">
                                    <i data-feather="trending-down"></i>
                                </div>
                                <p class="fw-semibold"><span class="text-danger">%1.3</span> پایین تر از هفته
                                    گذشته</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="stats-box card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-1">
                                <div class="flex-grow-1 me-3">
                                    <h3 class="body-font fw-bold fs-3 mb-2">183.35 عضو</h3>
                                    <span>کل مشتریان</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="icon transition">
                                        <i class="flaticon-award"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="svg-success me-2">
                                    <i data-feather="trending-up"></i>
                                </div>
                                <p class="fw-semibold"><span class="text-success">%1.3</span> بالاتر از هفته
                                    گذشته</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">نمای کلی مخاطب</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="clock"></i>
                                        امروز
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="pie-chart"></i>
                                        7 روز گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="rotate-cw"></i>
                                        ماه گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="calendar"></i>
                                        1 سال گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="bar-chart"></i>
                                        همیشه
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="eye"></i>
                                        مشاهده
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="trash"></i>
                                        حذف
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="audience_overview"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                                <h4 class="fw-semibold fs-18 mb-0">بازدید در روز</h4>
                                <span>مجموع 248.5 هزار بازدید</span>
                            </div>
                            <div id="visits_by_day"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stats-box card bg-primary-div border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <p class="fw-semibold text-white mb-1">برداشت ها</p>
                            <h3 class="body-font fw-bold fs-3 mb-1 text-white">1100 تومان <sub class="fw-normal"><i
                                        class="ri-arrow-up-s-fill"></i> %10</sub></h3>
                            <span class="text-white" style="opacity: 0.7">در مقایسه با 21490 تومان در سال
                                گذشته</span>
                        </div>
                    </div>
                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                                <h4 class="fw-bold fs-18 mb-0">جدول زمانی فعالیت</h4>
                                <div class="dropdown action-opt">
                                    <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i data-feather="more-horizontal"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                        <li>
                                            <a class="dropdown-item" href="javascript:;">
                                                <i data-feather="clock"></i>
                                                امروز
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:;">
                                                <i data-feather="pie-chart"></i>
                                                7 روز گذشته
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:;">
                                                <i data-feather="rotate-cw"></i>
                                                ماه گذشته
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:;">
                                                <i data-feather="calendar"></i>
                                                12 ماه گذشته
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:;">
                                                <i data-feather="bar-chart"></i>
                                                همیشه
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:;">
                                                <i data-feather="eye"></i>
                                                مشاهده
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:;">
                                                <i data-feather="trash"></i>
                                                حذف
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <ul class="ps-0 mb-0 list-unstyled activity-timeline max-h-402" data-simplebar>
                                <li class="activity-item">
                                    <a href="notification.html" class="text-decoration-none">
                                        <h4>8 فاکتور پرداخت شده است</h4>
                                        <div class="activity-wrap">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('assets/images/pdf.svg') }}" alt="pdf">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p>فاکتورها به شرکت پرداخت شده است و قابل استفاده است.</p>
                                                </div>
                                            </div>
                                            <span>ساعت 23:47 چهارشنبه</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="activity-item">
                                    <a href="notification.html" class="text-decoration-none">
                                        <h4>8 فاکتور پرداخت شده است</h4>
                                        <div class="activity-wrap">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('assets/images/notifications-1.jpg') }}"
                                                        alt="notifications">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p>به کاربران اجازه دهید محصولات موجود در ووکامرس شما را
                                                        دنبال کنند.</p>
                                                </div>
                                            </div>
                                            <span>21 دی 1402</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="activity-item">
                                    <a href="notification.html" class="text-decoration-none">
                                        <h4>مجموعه سبک جدید اضافه شد</h4>
                                        <div class="activity-wrap">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('assets/images/notifications-2.jpg') }}"
                                                        alt="notifications">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p>محصول بارگذاری شده توسط جان اسمیت و سایر اعضای تیم.</p>
                                                </div>
                                            </div>
                                            <span>08:14 صبح امروز</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">وضعیت جدید</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="clock"></i>
                                        امروز
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="pie-chart"></i>
                                        7 روز گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="rotate-cw"></i>
                                        ماه گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="calendar"></i>
                                        1 سال گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="bar-chart"></i>
                                        همیشه
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="eye"></i>
                                        مشاهده
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="trash"></i>
                                        حذف
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div style="direction: ltr;" id="revenu_status"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="stats-box ratings card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div class="flex-grow-1 mb-3 mb-sm-0">
                            <h4 class="fs-18 fw-semibold mb-2">رتبه بندی ها</h4>
                            <span class="fw-semibold d-block mb-3 text-gray-light">سال 1402</span>
                            <h3 class="body-font fw-bold fs-24 mb-3">8.14k <sub
                                    class="text-gray-light fw-normal">بررسی</sub></h3>
                            <div class="d-flex align-items-center">
                                <div class="svg-warning me-2">
                                    <i data-feather="star" style="width: 20px; height: 20px;"></i>
                                </div>
                                <p class="fw-semibold"><span class="text-body me-1">4.5</span> <span
                                        class="text-primary">%+15.6</span> از دوره قبل</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div id="ratings_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">بازدیدهای زنده از سایت ما</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="clock"></i>
                                        امروز
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="pie-chart"></i>
                                        7 روز گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="rotate-cw"></i>
                                        ماه گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="calendar"></i>
                                        1 سال گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="bar-chart"></i>
                                        همیشه
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="eye"></i>
                                        مشاهده
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="trash"></i>
                                        حذف
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="live_visits_on_our_site"></div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">فروش بر اساس مکان</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="clock"></i>
                                        امروز
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="pie-chart"></i>
                                        7 روز گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="rotate-cw"></i>
                                        ماه گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="calendar"></i>
                                        1 سال گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="bar-chart"></i>
                                        همیشه
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="eye"></i>
                                        مشاهده
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="trash"></i>
                                        حذف
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div style="direction: ltr;" id="sales_by_locations"></div>
                    <ul class="ps-0 mb-0 list-unstyled sales_by_locations mt-4">
                        <li>
                            <span class="fw-semibold d-block mb-2">کانادا</span>
                            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 75%">
                                    <span class="count fw-semibold text-body">%75</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="fw-semibold d-block mb-2">روسیه</span>
                            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="55"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 55%">
                                    <span class="count fw-semibold text-body">%55</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="fw-semibold d-block mb-2">گرینلند</span>
                            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="45"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 45%">
                                    <span class="count fw-semibold text-body">%45</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="fw-semibold d-block mb-2">آمریکا</span>
                            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="35"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 35%">
                                    <span class="count fw-semibold text-body">%35</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-bold fs-18 mb-0">مشتریان جدید</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="clock"></i>
                                        امروز
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="pie-chart"></i>
                                        7 روز گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="rotate-cw"></i>
                                        ماه گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="calendar"></i>
                                        1 سال گذشته
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="bar-chart"></i>
                                        همیشه
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="eye"></i>
                                        مشاهده
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="trash"></i>
                                        حذف
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="ps-0 mb-0 list-unstyled max-h-198" data-simplebar>
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <div class="d-sm-flex justify-content-between align-content-center">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/user-1.jpg') }}" class="rounded-circle wh-44"
                                            alt="user-1">
                                    </div>
                                    <div class="flex-grow-1 ms-10">
                                        <h4 class="fw-semibold fs-16 mb-0">جردن استیونسون</h4>
                                        <span class="text-gray-light">@jstevenson5c</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-2 mt-sm-0">
                                    <span>1100 تومان</span>
                                    <span
                                        class="bg-opacity-10 bg-primary fs-13 fw-semibold text-primary py-1 px-3 rounded-pill ms-10">15
                                        سفارش</span>
                                </div>
                            </div>
                        </li>
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <div class="d-sm-flex justify-content-between align-content-center">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/user-2.jpg') }}" class="rounded-circle wh-44"
                                            alt="user-2">
                                    </div>
                                    <div class="flex-grow-1 ms-10">
                                        <h4 class="fw-semibold fs-16 mb-0">لیدیا ریس</h4>
                                        <span class="text-gray-light">@lreese3b</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-2 mt-sm-0">
                                    <span>1100 تومان</span>
                                    <span
                                        class="bg-opacity-10 bg-primary fs-13 fw-semibold text-primary py-1 px-3 rounded-pill ms-10">17
                                        سفارش</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-sm-flex justify-content-between align-content-center">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/user-3.jpg') }}" class="rounded-circle wh-44"
                                            alt="user-3">
                                    </div>
                                    <div class="flex-grow-1 ms-10">
                                        <h4 class="fw-semibold fs-16 mb-0">ایسین عرفات</h4>
                                        <span class="text-gray-light">@jstevenson6c</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-2 mt-sm-0">
                                    <span>1100 تومان</span>
                                    <span
                                        class="bg-opacity-10 bg-primary fs-13 fw-semibold text-primary py-1 px-3 rounded-pill ms-10">19
                                        سفارش</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection