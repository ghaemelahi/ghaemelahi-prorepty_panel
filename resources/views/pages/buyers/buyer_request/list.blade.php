@extends('layouts.app')
@section('title', 'درخواست خریدان')
@section('content')
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">درخواست‌های خرید</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="index.html" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>خانه</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">درخواست‌های خرید</span>
            </li>
        </ul>
    </div>
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-0">همه درخواست‌های خرید ({{ $data['buyer_info']->name }})</h4>
                <div class="d-sm-flex align-items-center">
                    <button class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line text-white"></i>
                            <span>افزودن درخواست</span>
                        </span>
                    </button>
                    <div class="dropdown action-opt ms-sm-4 mt-3 mt-sm-0">
                        <a href="{{ route('proposal_building_list', $data['buyer_info']->id) }}"
                            class="btn btn-info py-2 px-3 text-white fw-semibold rounded-3">
                            ملک های پیشنهادی
                        </a>
                    </div>
                </div>




                <!-- Button trigger modal -->
                <button type="button"
                    class="border-0 btn btn-info py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                    data-bs-toggle="modal" data-bs-target="#searchUserModal">
                    <span class="py-sm-1 d-block">
                        <i class="flaticon-search text-white"></i>
                        <span>جستجو</span>
                    </span>
                </button>



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
                                                    <input class="form-check-input" type="radio" id="buy"
                                                        name="search_request_type" @checked($search_request_type == 'buy')
                                                        value="buy">
                                                    <label class="form-check-label" for="buy">خرید</label>
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
                                    <a href="{{ route('buyer_requests', $data['buyer_info']->id) }}"
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
                @if (sizeof($data['buyer_requests']) > 0)
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
                                    <th scope="col">تاریخ ثبت</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['buyer_requests'] as $item)
                                    <tr>
                                        <td>
                                            <div class="flex-grow-1 ms-3">
                                                <h4 class="fw-semibold fs-16 mb-0 lh-base hover">
                                                    {{ $item->request_type == 'buy' ? 'خرید' : 'اجاره' }}
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
                                            <span class="d-block fs-15 text-center">{{ $item->bedrooms }} عدد</span>
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
                                            <button class="btn btn-primary py-2 px-3 text-white fw-semibold rounded-3"
                                                data-bs-toggle="modal" data-bs-target="#moreInfoModal{{ $item->id }}">
                                                <i class="flaticon-view"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <span class="d-block text-center">{{ $item->created_at }}</span>
                                        </td>
                                        <td class="justify-content-center">
                                            <button type="button"
                                                class="btn bg-info bg-opacity-10 fw-semibold text-info py-2 px-4 mt-2 me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal{{ $item->id }}">بروزرسانی</button>
                                            <button type="button"
                                                class="btn bg-danger bg-opacity-10 fw-semibold text-danger py-2 px-4 mt-2 me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteUserModal{{ $item->id }}">حذف</button>

                                        </td>
                                    </tr>
                                    {{-- Modal description Request --}}
                                    <div class="modal fade" id="moreInfoModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="moreInfoModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="moreInfoModalLabel{{ $item->id }}">
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
                                                    <form action="{{ route('buyer_request_update') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="request_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="buyer_id"
                                                            value="{{ $data['buyer_info']->id }}">
                                                        <div class="form-group mb-4">
                                                            <label class="label">وضعیت درخواست *</label>
                                                            <select class="form-select form-control text-dark"
                                                                name="status" aria-label="Default select example">
                                                                <option @selected($item->status == 'doing') value="doing">در درست
                                                                    اقدام
                                                                </option>
                                                                <option @selected($item->status == 'compelet') value="compelet">انجام
                                                                    شد
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label class="label">نام خریدار *</label>
                                                            <input type="text" name="buyer_name" readonly
                                                                value="{{ $data['buyer_info']->name }}"
                                                                class="form-control text-dark" placeholder="نام خریدار">
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label class="label">شماره تماس خریدار *</label>
                                                            <input type="text" name="buyer_phone" readonly
                                                                value="{{ $data['buyer_info']->phone }}"
                                                                class="form-control text-dark"
                                                                placeholder="شماره تماس خریدار">
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label class="label">نوع ملک *</label>
                                                            <select class="form-select form-control text-dark"
                                                                name="reoperty_type" aria-label="Default select example">
                                                                <option @selected($item->reoperty_type == 'tejari') value="tejari">تجاری
                                                                </option>
                                                                <option @selected($item->reoperty_type == 'maskoni') value="maskoni">مسکونی
                                                                </option>
                                                                <option @selected($item->reoperty_type == 'earth_maskoni') value="earth_maskoni">زمین مسکونی
                                                                </option>
                                                                <option @selected($item->reoperty_type == 'earth_tejari') value="earth_tejari">زمین تجاری
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label class="label">نوع درخواست *</label>
                                                            <div class="form-control">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"
                                                                        @checked($item->request_type == 'buy') type="radio"
                                                                        id="buy" name="request_type"
                                                                        value="buy">
                                                                    <label class="form-check-label"
                                                                        for="buy">خرید</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"
                                                                        @checked($item->request_type == 'ejareh') type="radio"
                                                                        id="ejareh" name="request_type"
                                                                        value="ejareh">
                                                                    <label class="form-check-label"
                                                                        for="ejareh">اجاره</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label class="label">قیمت *</label>
                                                            <input type="text"
                                                                value="{{ number_format($item->price) }}" name="price"
                                                                required class="form-control text-dark"
                                                                onkeyup="separate(this);" placeholder="5,000,000">
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label class="label">تعداد خواب *</label>
                                                            <input type="number" value="{{ $item->bedrooms }}"
                                                                name="bedrooms" required class="form-control text-dark"
                                                                placeholder="5">
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


                                    {{-- modal Delete Request --}}
                                    <div class="modal fade" id="deleteUserModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteUserModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel{{ $item->id }}">
                                                        حذف
                                                        خریدار
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا مطمئن هستید که می‌خواهید درخواست را حذف
                                                    کنید؟
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('buyer_request_delete') }}">
                                                        @csrf
                                                        <input type="hidden" name="request_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="buyer_id"
                                                            value="{{ $data['buyer_info']->id }}">
                                                        <input type="hidden" name="buyer_name"
                                                            value="{{ $data['buyer_info']->name }}">

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
                {{ $data['buyer_requests']->links() }}
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
            <form action="{{ route('buyer_request_store') }}" method="POST">
                @csrf
                <input type="hidden" name="buyer_id" value="{{ $data['buyer_info']->id }}">
                <div class="form-group mb-4">
                    <label class="label">نام خریدار *</label>
                    <input type="text" name="buyer_name" readonly value="{{ $data['buyer_info']->name }}"
                        class="form-control text-dark" placeholder="نام خریدار">
                </div>
                <div class="form-group mb-4">
                    <label class="label">شماره تماس خریدار *</label>
                    <input type="text" name="buyer_phone" readonly value="{{ $data['buyer_info']->phone }}"
                        class="form-control text-dark" placeholder="شماره تماس خریدار">
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
                    <div class="form-control">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="buy" name="request_type"
                                value="buy">
                            <label class="form-check-label" for="buy">خرید</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="ejareh" name="request_type"
                                value="ejareh">
                            <label class="form-check-label" for="ejareh">اجاره</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="label">قیمت *</label>
                    <input type="text" name="price" required class="form-control text-dark"
                        onkeyup="separate(this);" placeholder="5,000,000">
                </div>
                <div class="form-group mb-4">
                    <label class="label">تعداد خواب *</label>
                    <input type="number" name="bedrooms" required class="form-control text-dark" placeholder="5">
                </div>
                <div class="form-group mb-4">
                    <label class="label">توضیحات</label>
                    <textarea name="description" class="form-control text-dark" name="description" id="" cols="30"
                        rows="5"></textarea>
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
