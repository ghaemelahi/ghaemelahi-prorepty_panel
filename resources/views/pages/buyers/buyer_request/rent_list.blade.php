@extends('layouts.app')
@section('title', 'لیست اجاره')
@section('content')
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">شبکه اجاره ملک</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="index.html" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>خانه</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">شبکه اجاره ملک</span>
            </li>
        </ul>
    </div>

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="card-body p-4">
                <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-sm-0"> </h4>
                    <!-- Button trigger modal -->
                    <button type="button"
                        class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                        data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <span class="py-sm-1 d-block">
                            <span>جستجو پیشرفته</span>
                            <i class="flaticon-search text-white"></i>
                        </span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="GET">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addUserModalLabel">جستجو پیشرفته</h5>
                                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"
                                            aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="mb-3 text-start col-md-6">
                                                <label class="form-label d-block mb-2">نام/شماره تماس خریدار</label>
                                                <input type="text" value="{{ $search_info_buyer }}" class="form-control"
                                                    id="search_info_buyer" name="search_info_buyer">
                                            </div>
                                            <div class="mb-3 text-start col-md-6">
                                                <label for="search_reoperty_type" class="form-label">نوع ملک</label>
                                                <select class="form-select form-control text-dark"
                                                    name="search_reoperty_type" aria-label="Default select example">
                                                    <option value="">انتخاب کنید... </option>
                                                    <option @selected($search_reoperty_type == 'tejari') value="tejari">تجاری</option>
                                                    <option @selected($search_reoperty_type == 'maskoni') value="maskoni">مسکونی</option>
                                                    <option @selected($search_reoperty_type == 'earth_maskoni') value="earth_maskoni">زمین مسکونی
                                                    </option>
                                                    <option @selected($search_reoperty_type == 'earth_tejari') value="earth_tejari">زمین تجاری
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3 text-start col-md-6">
                                                <label for="search_request_type" class="form-label">نوع درخواست</label>

                                                <div class="form-control">
                                                    <div class="form-check form-check-inline">
                                                        <input disabled class="form-check-input" type="radio"
                                                            @checked($search_request_type == 'buy') id="buy"
                                                            name="search_request_type" value="buy">
                                                        <label class="form-check-label" for="buy">خرید</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="ejareh"
                                                            @checked(true) name="search_request_type"
                                                            value="ejareh">
                                                        <label class="form-check-label" for="ejareh">اجاره</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-start col-md-6">
                                                <label class="form-label d-block mb-2">مبلغ ماهیانه</label>
                                                <input type="text"
                                                    value="{{ $search_monthly_amount != null ? number_format($search_monthly_amount) : '' }}"
                                                    onkeyup="separate(this);" class="form-control" id="search_monthly_amount"
                                                    name="search_monthly_amount">
                                            </div>
                                            <div class="mb-3 text-start col-md-6">
                                                <label class="form-label d-block mb-2">پیش‌ پرداخت</label>
                                                <input type="text"
                                                    value="{{ $search_down_payment != null ? number_format($search_down_payment) : '' }}"
                                                    onkeyup="separate(this);" class="form-control" id="search_down_payment"
                                                    name="search_down_payment">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('rent_list_requests') }}"
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
            </div>

            <div class="default-table-area members-list">
                <div class="table-responsive">


                    @if (sizeof($data) > 0)
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" class="text-primary text-start">
                                        <div class="form-check">
                                            <label class="form-check-label ms-2" for="flexCheckDefault">نام و نام
                                                خانوادگی</label>
                                        </div>
                                    </th>
                                    {{-- <th scope="col">شماره تماس</th> --}}
                                    <th scope="col">نوع درخواست</th>
                                    <th scope="col">نوع ملک</th>
                                    <th scope="col">مبلغ ماهیانه</th>
                                    <th scope="col">پیش‌ پرداخت</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="text-center">
                                        <td class="text-start">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 ms-10">
                                                        <h4 class="fw-semibold fs-16 mb-0">{{ $item->name }}</h4>
                                                        <a href="tel:{{ $item->phone }}"><span
                                                                class="text-gray-light">{{ $item->phone }}</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td>
                                        <a href="callto:{{ $item->phone }}">{{ $item->phone }}</a>
                                    </td> --}}
                                        <td>
                                            <span>
                                                    اجاره
                                            </span>
                                        </td>
                                        <td>{{ $item->persian_reoperty_type }}</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <span
                                                    class="bg-success bg-opacity-10 text-success fs-13 fw-semibold py-1 px-2 rounded-1">{{ number_format($item->monthly_amount) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <span
                                                    class="bg-success bg-opacity-10 text-success fs-13 fw-semibold py-1 px-2 rounded-1">{{ number_format($item->down_payment) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3 justify-content-center mb-4 pb-1">
                                                <button class="btn btn-primary py-2 px-3 text-white fw-semibold rounded-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal{{ $item->buyer_request_id }}">
                                                    جزئیات
                                                </button>
                                                <a href="{{ route('buyer_requests', $item->id) }}"
                                                    class="btn btn-info py-2 px-3 text-white fw-semibold rounded-3">
                                                    درخواست‌ها
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- modal information sellers --}}
                                    <div class="modal fade" id="editUserModal{{ $item->buyer_request_id }}" tabindex="-1"
                                        aria-labelledby="editUserModalLabel{{ $item->buyer_request_id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel{{ $item->buyer_request_id }}">
                                                        جزئیات
                                                        درخواست
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>

                                                <div class="offcanvas-body p-4">
                                                    <input type="hidden" name="request_id" value="{{ $item->buyer_request_id }}">
                                                    <input type="hidden" name="buyer_id" value="{{ $item->id }}">
                                                    <div class="form-group mb-4">
                                                        <label class="label">تاریخ ثبت *</label>
                                                        <input type="text" name="created_at" disabled
                                                            value="{{ $item->created_at }}"
                                                            class="form-control text-dark" placeholder="تاریخ ثبت">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">وضعیت درخواست *</label>
                                                        <input type="text" disabled class=" form-control text-dark"
                                                            value="{{ $item->status == 'doing' ? 'در دست اقدام' : 'انجام شد' }}"
                                                            id="">
                                                        {{-- <select class="form-select form-control text-dark" name="status"
                                                                            aria-label="Default select example">
                                                                            <option @selected($item->status == 'doing') value="doing">در درست
                                                                                اقدام
                                                                            </option>
                                                                            <option @selected($item->status == 'compelet') value="compelet">انجام
                                                                                شد
                                                                            </option>
                                                                        </select> --}}
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">نام خریدار *</label>
                                                        <input type="text" name="name" disabled
                                                            value="{{ $item->name }}" class="form-control text-dark"
                                                            placeholder="نام خریدار">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">شماره تماس خریدار *</label>
                                                        <input type="text" name="phone" disabled
                                                            value="{{ $item->phone }}" class="form-control text-dark"
                                                            placeholder="شماره تماس خریدار">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">نوع ملک *</label>
                                                        <select class="form-select form-control text-dark"
                                                            name="reoperty_type" aria-label="Default select example"
                                                            disabled>
                                                            <option @selected($item->reoperty_type == 'tejari') value="tejari">تجاری
                                                            </option>
                                                            <option @selected($item->reoperty_type == 'maskoni') value="maskoni">مسکونی
                                                            </option>
                                                            <option @selected($item->reoperty_type == 'earth_maskoni') value="earth_maskoni">زمین
                                                                مسکونی
                                                            </option>
                                                            <option @selected($item->reoperty_type == 'earth_tejari') value="earth_tejari">زمین
                                                                تجاری
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">نوع درخواست *</label>
                                                        <div class="form-control">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" disabled
                                                                    @checked($item->request_type == 'buy') type="checkbox"
                                                                    id="buy" name="request_type" value="buy">
                                                                <label class="form-check-label"
                                                                    for="buy">خرید</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                    @checked(true) type="checkbox"
                                                                    id="ejareh" disabled name="request_type"
                                                                    value="ejareh">
                                                                <label class="form-check-label"
                                                                    for="ejareh">اجاره</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">پیش پرداخت *</label>
                                                        <input type="text" disabled
                                                            value="{{ number_format($item->down_payment) }}" name="down_payment"
                                                            required class="form-control text-dark"
                                                            onkeyup="separate(this);" placeholder="5,000,000">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">مبلغ ماهیانه *</label>
                                                        <input type="text" disabled
                                                            value="{{ number_format($item->monthly_amount) }}" name="monthly_amount"
                                                            required class="form-control text-dark"
                                                            onkeyup="separate(this);" placeholder="5,000,000">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">تعداد خواب *</label>
                                                        <input type="number" disabled value="{{ $item->bedrooms }}"
                                                            name="bedrooms" required class="form-control text-dark"
                                                            placeholder="5">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">توضیحات</label>
                                                        <textarea name="description" disabled class="form-control text-dark" name="description" id=""
                                                            cols="30" rows="5">{{ $item->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    {{-- modal sell building --}}
                                    <div class="modal fade" id="buldingSellModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="buldingSellModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="buldingSellModalLabel{{ $item->id }}">
                                                        اجاره ملک
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">ملکی یافت نشد.</td>
                        </tr>
                    @endif
                </div>
            </div>
            <div class="mt-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
