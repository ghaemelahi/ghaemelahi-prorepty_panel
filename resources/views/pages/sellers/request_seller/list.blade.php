@extends('layouts.app')
@section('title', 'درخواست فروشندگان')
@section('content')
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">درخواست‌ها</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="index.html" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>خانه</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">درخواست‌ها</span>
            </li>
        </ul>
    </div>
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">همه درخواست‌های ({{ $data['seller_info']->name }})</h4>
                <div class="d-sm-flex align-items-center">
                    <button class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line text-white"></i>
                            <span>افزودن درخواست</span>
                        </span>
                    </button>

                </div>

                <!-- Button trigger modal -->
                <div>
                    <button type="button"
                        class="border-0 btn btn-info py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                        data-bs-toggle="modal" data-bs-target="#searchUserModal">
                        <span class="py-sm-1 d-block">
                            <i class="flaticon-search text-white"></i>
                            <span>جستجو</span>
                        </span>
                    </button>
                </div>



                <!-- Modal search result -->
                <div class="modal fade" id="searchUserModal" tabindex="-1" aria-labelledby="searchUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="GET">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="searchUserModalLabel">جستجو</h5>
                                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"
                                        aria-label="بستن"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="form-group mb-4 col-md-6">
                                            <label class="label">نوع ملک</label>
                                            <select class="form-select form-control text-dark" name="search_reoperty_type"
                                                aria-label="Default select example">
                                                <option value="">انتخاب کنید</option>
                                                <option @selected($search_reoperty_type == 'tejari') value="tejari">تجاری</option>
                                                <option @selected($search_reoperty_type == 'maskoni') value="maskoni">مسکونی</option>
                                                <option @selected($search_reoperty_type == 'earth_maskoni') value="earth_maskoni">زمین مسکونی
                                                </option>
                                                <option @selected($search_reoperty_type == 'earth_tejari') value="earth_tejari">زمین تجاری
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4 col-md-6">
                                            <label class="label">نوع درخواست</label>
                                            <div class="form-control">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="sell"
                                                        name="search_request_type" @checked($search_request_type == 'sell')
                                                        value="sell">
                                                    <label class="form-check-label" for="sell">فروش</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="ejareh"
                                                        name="search_request_type" @checked($search_request_type == 'ejareh')
                                                        value="ejareh">
                                                    <label class="form-check-label" for="ejareh">اجاره</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4 col-md-6">
                                            <label class="label">قیمت</label>
                                            <input type="text"
                                                value="{{ $search_price != 0 ? number_format($search_price) : '' }}"
                                                name="search_price" class="form-control text-dark" onkeyup="separate(this);"
                                                autocomplete="off">
                                        </div>
                                        <div class="form-group mb-4 col-md-6">
                                            <label class="label">تعداد خواب</label>
                                            <input type="number" value="{{ $search_bedrooms }}" name="search_bedrooms"
                                                autocomplete="off" class="form-control text-dark">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('buyer_requests', $data['seller_info']->id) }}"
                                        class="btn btn-danger hover-white text-white">بازنشانی صفحه</a>
                                    <button type="button" class="btn btn-secondary text-white"
                                        data-bs-dismiss="modal">انصراف</button>
                                    <button type="submit" class="btn btn-primary text-white">جستجو</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="default-table-area project-list style-two">
                @if (sizeof($data['seller_requests']) > 0)
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">نوع درخواست</th>
                                    <th scope="col">نوع ملک</th>
                                    <th scope="col">قیمت</th>
                                    <th scope="col">تعداد خواب</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">توضیحات</th>
                                    <th scope="col">اطلاعات تکمیلی</th>
                                    <th scope="col">عکس‌ها</th>
                                    <th scope="col">آدرس</th>
                                    <th scope="col">عملیات</th>
                                    {{-- <th scope="col">ویرایش عکس‌ها</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['seller_requests'] as $item)
                                    <tr>
                                        <td>
                                            <div class="flex-grow-1 ms-3">
                                                <h4 class="fw-semibold fs-16 mb-0 lh-base hover">
                                                    {{ $item->request_type == 'sell' ? 'فروش' : 'اجاره' }}
                                                </h4>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="d-block fs-15 text-center">
                                                @if ($item->reoperty_type == 'tejari')
                                                    تجاری
                                                @elseif($item->reoperty_type == 'maskoni')
                                                    مسکونی
                                                @elseif($item->reoperty_type == 'earth_maskoni')
                                                    زمین مسکونی
                                                @elseif($item->reoperty_type == 'earth_tejari')
                                                    زمین تجاری
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-block fs-15 text-center">{{ number_format($item->price) }}
                                                تومان</span>
                                        </td>
                                        <td>
                                            <span class="d-block fs-15 text-center">{{ $item->number_bedrooms }} عدد</span>
                                        </td>
                                        <td>
                                            @if ($item->status == 'compelet')
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 fw-semibold text-center d-block">انجام
                                                    شد</span>
                                            @elseif($item->status == 'doing')
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success py-2 px-3 fw-semibold d-block text-center">در
                                                    دست اقدام</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-primary py-2 px-3 text-white fw-semibold rounded-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#descritionModal{{ $item->id }}">
                                                <i class="flaticon-view"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info py-2 px-3 text-white fw-semibold rounded-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#morInformationModal{{ $item->id }}">
                                                <i class="flaticon-view"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="">
                                                <button
                                                    class="btn btn-sm btn-success py-2 px-3 text-white fw-semibold rounded-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ImageRequestModal{{ $item->id }}">
                                                    عکس‌ها
                                                </button>

                                                <a href="{{ route('change_image_seller_requests', $item->id) }}"
                                                    class="btn btn-sm bg-warning bg-opacity-10 fw-semibold text-wabg-warning py-2">ویرایش
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="d-block text-center">{{ $item->street_name }}</span>
                                        </td>
                                        <td class="justify-content-center">
                                            <button type="button"
                                                class="btn btn-sm bg-info bg-opacity-10 fw-semibold text-info py-2 px-4 mt-2 me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal{{ $item->id }}">بروزرسانی</button>
                                            <button type="button"
                                                class="btn btn-sm bg-danger bg-opacity-10 fw-semibold text-danger py-2 px-4 mt-2 me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteUserModal{{ $item->id }}">حذف</button>

                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('change_image_seller_requests', $item->id) }}"
                                                class="btn btn-sm bg-warning bg-opacity-10 fw-semibold text-wabg-warning py-2">ویرایش
                                            </a>
                                        </td> --}}
                                    </tr>
                                    {{-- Modal description Request --}}
                                    <div class="modal fade" id="descritionModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="descritionModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="descritionModalLabel{{ $item->id }}">
                                                        توضیحات
                                                        درخواست
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <!-- فرم توضیحات (نمونه، قابلیت افزودن اکشن و مقادیر بیشتر دارد) -->
                                                    <textarea disabled class="form-control">{{ $item->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    {{-- Modal Images Request --}}
                                    <div class="modal fade" id="ImageRequestModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="ImageRequestModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="ImageRequestModalLabel{{ $item->id }}">
                                                        عکس‌ها
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <!-- فرم توضیحات (نمونه، قابلیت افزودن اکشن و مقادیر بیشتر دارد) -->

                                                    <div id="carouselExampleControlsNoTouching{{ $item->id }}"
                                                        class="carousel slide" data-bs-touch="false">
                                                        <div class="carousel-inner">
                                                            @foreach ($item->images as $image)
                                                                {{-- @dd($item->images) --}}
                                                                <div class="carousel-item active">
                                                                    <img src="{{ asset($image->path) }}"
                                                                        class="d-block w-100" alt="carousel">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @if (count($item->images) > 1)
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#carouselExampleControlsNoTouching{{ $item->id }}"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">قبلی</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#carouselExampleControlsNoTouching{{ $item->id }}"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">بعدی</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    {{-- Modal More Information Request --}}
                                    <div class="modal fade" id="morInformationModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="morInformationModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="morInformationModalLabel{{ $item->id }}">
                                                        اطلاعات تکمیلی
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>
                                                <div class="modal-body text-start">

                                                    <div class="form-group mb-4 col-md-6">
                                                        <label class="label">تاریخ ثبت *</label>
                                                        <input type="text" disabled value="{{ $item->created_at }}"
                                                            class="form-control text-dark">
                                                    </div>
                                                    <!-- فرم توضیحات (نمونه، قابلیت افزودن اکشن و مقادیر بیشتر دارد) -->

                                                    <div class="form-group mb-4">
                                                        <label class="label">جزئیات آدرس</label>
                                                        <textarea disabled class="form-control text-dark" id="" cols="30" rows="3">{{ $item->address }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">امکانات</label>
                                                        <div class="form-control">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" disabled
                                                                    @checked($item->water == 1) type="checkbox"
                                                                    id="water" value="1">
                                                                <label class="form-check-label" for="water">اب</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" disabled
                                                                    @checked($item->water == 1) type="checkbox"
                                                                    id="electric" value="1">
                                                                <label class="form-check-label" for="electric">برق</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" disabled
                                                                    @checked($item->gas == 1) type="checkbox"
                                                                    id="gas" value="1">
                                                                <label class="form-check-label" for="gas">گاز</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" disabled
                                                                    @checked($item->telephone == 1) type="checkbox"
                                                                    id="telephone" value="1">
                                                                <label class="form-check-label"
                                                                    for="telephone">تلفن</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group mb-4 col-md-6">
                                                            <label class="label">ابعاد ساختمان *</label>
                                                            <input type="text" disabled
                                                                value="{{ $item->dimensions_building }}"
                                                                class="form-control text-dark">
                                                        </div>
                                                        <div class="form-group mb-4 col-md-6">
                                                            <label class="label">متراژ زمین *</label>
                                                            <input type="text" disabled
                                                                value="{{ $item->meterage_building }}"
                                                                class="form-control text-dark">
                                                        </div>
                                                        <div class="form-group mb-4 col-md-6">
                                                            <label class="label">مدت ساخت *</label>
                                                            <input type="text" disabled
                                                                value="{{ $item->year_manufacture }}"
                                                                class="form-control text-dark">
                                                        </div>
                                                        <div class="form-group mb-4 col-md-6">
                                                            <label class="label">نوع سند *</label>
                                                            <input type="text" disabled
                                                                value="{{ $item->document_type }}"
                                                                class="form-control text-dark">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Modal Update Request --}}
                                    <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editUserModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel{{ $item->id }}">
                                                        ویرایش
                                                        اطلاعات
                                                        کاربر
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>

                                                <div class="offcanvas-body p-4">
                                                    <div class="row">
                                                        <form action="{{ route('seller_request_update') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="request_id"
                                                                value="{{ $item->id }}">
                                                            <input type="hidden" name="seller_id"
                                                                value="{{ $data['seller_info']->id }}">
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">وضعیت درخواست *</label>
                                                                <select class="form-select form-control text-dark"
                                                                    name="status" aria-label="Default select example">
                                                                    <option @selected($item->status == 'doing') value="doing">در
                                                                        درست
                                                                        اقدام
                                                                    </option>
                                                                    <option @selected($item->status == 'compelet') value="compelet">
                                                                        انجام
                                                                        شد
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">نام فروشنده *</label>
                                                                <input type="text" name="seller_name" readonly
                                                                    value="{{ $data['seller_info']->name }}"
                                                                    class="form-control text-dark"
                                                                    placeholder="نام فروشنده">
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">شماره تماس فروشنده *</label>
                                                                <input type="text" name="seller_phone" readonly
                                                                    value="{{ $data['seller_info']->phone }}"
                                                                    class="form-control text-dark"
                                                                    placeholder="شماره تماس فروشنده">
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">نوع ملک *</label>
                                                                <select class="form-select form-control text-dark"
                                                                    name="reoperty_type"
                                                                    aria-label="Default select example">
                                                                    <option @selected($item->reoperty_type == 'tejari') value="tejari">
                                                                        تجاری
                                                                    </option>
                                                                    <option @selected($item->reoperty_type == 'maskoni') value="maskoni">
                                                                        مسکونی
                                                                    </option>
                                                                    <option @selected($item->reoperty_type == 'earth_maskoni')
                                                                        value="earth_maskoni">
                                                                        زمین مسکونی
                                                                    </option>
                                                                    <option @selected($item->reoperty_type == 'earth_tejari')
                                                                        value="earth_tejari">
                                                                        زمین تجاری
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">نوع درخواست *</label>
                                                                <select
                                                                    class="form-select form-control text-dark request-type"
                                                                    name="request_type" id=""
                                                                    aria-label="Default select example">
                                                                    <option @selected($item->request_type == 'sell') value="sell">
                                                                        فروش
                                                                    </option>
                                                                    <option @selected($item->request_type == 'ejareh') value="ejareh">
                                                                        اجاره
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">ابعاد ساختمان *</label>
                                                                <input type="text" name="dimensions_building"
                                                                    value="{{ $item->dimensions_building }}" required
                                                                    class="form-control text-dark">
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">متراژ زمین *</label>
                                                                <input type="text" name="meterage_building"
                                                                    value="{{ $item->meterage_building }}" required
                                                                    class="form-control text-dark">
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">مدت ساخت *</label>
                                                                <input type="text" name="year_manufacture"
                                                                    value="{{ $item->year_manufacture }}" required
                                                                    class="form-control text-dark">
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">نوع سند *</label>
                                                                <input type="text" name="document_type"
                                                                    value="{{ $item->document_type }}" required
                                                                    class="form-control text-dark">
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6 request-price {{$item->request_type == 'ejareh' ? 'content-visibility' : ''}}">
                                                                <label class="label">قیمت *</label>
                                                                <input type="text"
                                                                    value="{{ number_format($item->price) }}"
                                                                    name="price" required class="form-control text-dark"
                                                                    onkeyup="separate(this);" placeholder="5,000,000">
                                                            </div>


                                                            {{-- <div class="content-visibility rent-data"> --}}
                                                                <div class="form-group mb-4 col-md-6 col-sm-6 {{$item->request_type != 'ejareh' ? 'content-visibility' : ''}} rent-data">
                                                                    <label class="label">مبلغ ماهیانه</label>
                                                                    <input type="text"
                                                                        value="{{ number_format($item->monthly_amount) }}"
                                                                        name="monthly_amount"
                                                                        class="form-control text-dark"
                                                                        onkeyup="separate(this);" placeholder="5,000,000">
                                                                </div>
                                                                <div class="form-group mb-4 col-md-6 col-sm-6 {{$item->request_type != 'ejareh' ? 'content-visibility' : ''}} rent-data">
                                                                    <label class="label">پول پیش</label>
                                                                    <input type="text"
                                                                        value="{{ number_format($item->down_payment) }}"
                                                                        name="down_payment" class="form-control text-dark"
                                                                        onkeyup="separate(this);" placeholder="5,000,000">
                                                                </div>
                                                            {{-- </div> --}}
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">تعداد خواب *</label>
                                                                <input type="number"
                                                                    value="{{ $item->number_bedrooms }}"
                                                                    name="number_bedrooms" required
                                                                    class="form-control text-dark" placeholder="5">
                                                            </div>
                                                            <div class="form-group mb-4 col-md-6 col-sm-6">
                                                                <label class="label">امکانات *</label>
                                                                <div class="form-control">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($item->water == 1) type="checkbox"
                                                                            id="water" name="water" value="1">
                                                                        <label class="form-check-label"
                                                                            for="water">اب</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($item->electric == 1) type="checkbox"
                                                                            id="electric" name="electric"
                                                                            value="1">
                                                                        <label class="form-check-label"
                                                                            for="electric">برق</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($item->gas == 1) type="checkbox"
                                                                            id="gas" name="gas" value="1">
                                                                        <label class="form-check-label"
                                                                            for="gas">گاز</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($item->telephone == 1) type="checkbox"
                                                                            id="telephone" name="telephone"
                                                                            value="1">
                                                                        <label class="form-check-label"
                                                                            for="telephone">تلفن</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label class="label">آدرس *</label>
                                                                <input type="text" name="street_name" required
                                                                    class="form-control text-dark"
                                                                    value="{{ $item->street_name }}">
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label class="label">جزئیات آدرس *</label>
                                                                <textarea name="address" class="form-control text-dark" id="" cols="30" rows="5">{{ $item->address }}</textarea>
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label class="label">پیوست</label>
                                                                <input type="file" accept="image/*" multiple
                                                                    maxlength="5" name="images[]"
                                                                    class="form-control text-dark" placeholder="5">

                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label class="label">توضیحات</label>
                                                                <textarea name="description" class="form-control text-dark" name="description" id="" cols="30"
                                                                    rows="5">{{ $item->description }}</textarea>
                                                            </div>
                                                            <div class="form-group d-flex gap-3 justify-content-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                                    <span class="py-sm-1 d-block">
                                                                        <i class="ri-add-line text-white"></i>
                                                                        <span>ویرایش درخواست</span>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- modal Delete Request --}}
                                    <div class="modal fade" id="deleteUserModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteUserModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel{{ $item->id }}">
                                                        حذف
                                                        فروشنده
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا مطمئن هستید که می‌خواهید درخواست را حذف
                                                    کنید؟
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('seller_request_delete') }}">
                                                        @csrf
                                                        <input type="hidden" name="request_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="seller_id"
                                                            value="{{ $data['seller_info']->id }}">
                                                        <input type="hidden" name="seller_name"
                                                            value="{{ $data['seller_info']->name }}">

                                                        <button type="button" class="btn btn-secondary text-white"
                                                            data-bs-dismiss="modal">خیر</button>
                                                        <button type="submit"
                                                            class="btn btn-danger text-white">حذف</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">درخواستی یافت نشد.</td>
                    </tr>
                @endif
            </div>
            <div class="mt-3">
                {{ $data['seller_requests']->links() }}
            </div>
        </div>
    </div>





    {{-- modal create new request --}}

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-4">
            <h5 class="offcanvas-title fs-18 mb-0" id="offcanvasRightLabel">ایجاد درخواست</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <form action="{{ route('seller_request_store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="seller_id" value="{{ $data['seller_info']->id }}">
                <div class="form-group mb-4">
                    <label class="label">نام فروشنده *</label>
                    <input type="text" name="seller_name" readonly value="{{ $data['seller_info']->name }}"
                        class="form-control text-dark" placeholder="نام فروشنده">
                </div>
                <div class="form-group mb-4">
                    <label class="label">شماره تماس فروشنده *</label>
                    <input type="text" name="seller_phone" readonly value="{{ $data['seller_info']->phone }}"
                        class="form-control text-dark" placeholder="شماره تماس فروشنده">
                </div>
                <div class="form-group mb-4">
                    <label class="label">نوع ملک *</label>
                    <select class="form-select form-control text-dark" name="reoperty_type"
                        aria-label="Default select example">
                        <option value="tejari">تجاری</option>
                        <option value="maskoni">مسکونی</option>
                        <option value="earth_maskoni">زمین مسکونی</option>
                        <option value="earth_tejari">زمین تجاری</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label class="label">نوع درخواست *</label>
                    <select class="form-select form-control text-dark request-type" name="request_type" id=""
                        aria-label="Default select example">
                        <option selected value="sell">فروش
                        </option>
                        <option value="ejareh">اجاره
                        </option>
                    </select>
                </div>


                <div class="form-group mb-4">
                    <label class="label">ابعاد ساختمان *</label>
                    <input type="text" name="dimensions_building" required class="form-control text-dark">
                </div>
                <div class="form-group mb-4">
                    <label class="label">متراژ زمین *</label>
                    <input type="text" name="meterage_building" required class="form-control text-dark">
                </div>
                <div class="form-group mb-4">
                    <label class="label">مدت ساخت *</label>
                    <input type="text" name="year_manufacture" required class="form-control text-dark">
                </div>
                <div class="form-group mb-4">
                    <label class="label">نوع سند *</label>
                    <input type="text" name="document_type" required class="form-control text-dark">
                </div>
                <div class="form-group mb-4 request-price disabled">
                    <label class="label">قیمت</label>
                    <input type="text" name="price" class="form-control text-dark"
                        onkeyup="separate(this);" placeholder="5,000,000">
                </div>
                <div class="content-visibility rent-data" id="">

                    <div class="form-group mb-4">
                        <label class="label">مبلغ ماهیانه </label>
                        <input type="text" name="monthly_amount" class="form-control text-dark"
                            onkeyup="separate(this);" placeholder="5,000,000">
                    </div>
                    <div class="form-group mb-4">
                        <label class="label">پول پیش </label>
                        <input type="text" name="down_payment" class="form-control text-dark"
                            onkeyup="separate(this);" placeholder="5,000,000">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="label">تعداد خواب *</label>
                    <input type="number" name="number_bedrooms" required class="form-control text-dark">
                </div>
                <div class="form-group mb-4">
                    <label class="label">امکانات *</label>
                    <div class="form-control">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="water" name="water"
                                value="1">
                            <label class="form-check-label" for="water">اب</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="electric" name="electric"
                                value="1">
                            <label class="form-check-label" for="electric">برق</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="gas" name="gas"
                                value="1">
                            <label class="form-check-label" for="gas">گاز</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="telephone" name="telephone"
                                value="1">
                            <label class="form-check-label" for="telephone">تلفن</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="label">آدرس *</label>
                    <input type="text" name="street_name" required class="form-control text-dark">
                </div>
                <div class="form-group mb-4">
                    <label class="label">جزئیات آدرس *</label>
                    <textarea name="address" class="form-control text-dark" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group mb-4">
                    <label class="label">پیوست</label>
                    <input type="file" accept="image/*" multiple maxlength="5" name="images[]"
                        class="form-control text-dark" placeholder="5">
                </div>
                <div class="form-group mb-4">
                    <label class="label">توضیحات</label>
                    <textarea class="form-control text-dark" name="description" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group d-flex gap-3 justify-content-end">
                    <button type="submit" class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line text-white"></i>
                            <span>ثبت درخواست</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
