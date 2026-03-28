{{-- <div class="d-flex gap-3 justify-content-center mb-4 pb-1">
    <button class="btn btn-primary py-2 px-3 text-white fw-semibold rounded-3"
        data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id }}">
        جزئیات
    </button>
    <button class="btn btn-success py-2 px-3 text-white fw-semibold rounded-3"
        data-bs-toggle="modal" data-bs-target="#buldingSellModal{{ $item->id }}">
        فروش ملک
    </button>
</div> --}}


{{-- <a href="{{ route('buyer_requests', $data['buyer_info']->id) }}"
    class="btn btn-info text-white mb-sm-0 mb-1 fs-18">صفحه قبل</a> --}}
@extends('layouts.app')
@section('title', 'خرید ملک')
@section('content')
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <a href="{{ route('buyer_requests', $data['buyer_info']->id) }}"
            class="btn btn-info text-white mb-sm-0 mb-1 fs-18">صفحه قبل</a>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="index.html" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>خانه</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">شبکه فروش ملک</span>
            </li>
        </ul>
    </div>
    {{-- <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0"> </h4>
            <!-- Button trigger modal -->
            <button type="button" class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                data-bs-toggle="modal" data-bs-target="#addUserModal">
                <span class="py-sm-1 d-block">
                    <span>جستجو پیشرفته</span>
                    <i class="flaticon-search text-white"></i>
                </span>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
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
                                        <label class="form-label d-block mb-2">نام/شماره تماس فروشنده</label>
                                        <input type="text" value="{{ $search_info_seller }}" class="form-control"
                                            id="search_info_seller" name="search_info_seller">
                                    </div>
                                    <div class="mb-3 text-start col-md-6">
                                        <label for="request_reoperty_type" class="form-label">نوع ملک</label>
                                        <select class="form-select form-control text-dark" name="request_reoperty_type"
                                            aria-label="Default select example">
                                            <option value="">انتخاب کنید... </option>
                                            <option @selected($request_reoperty_type == 'tejari') value="tejari">تجاری</option>
                                            <option @selected($request_reoperty_type == 'maskoni') value="maskoni">مسکونی</option>
                                                    <option @selected($request_reoperty_type == 'earth_maskoni') value="earth_maskoni">زمین مسکونی</option>
                                                    <option @selected($request_reoperty_type == 'earth_tejari') value="earth_tejari">مین تجاری</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 text-start col-md-6">
                                        <label for="search_request_type" class="form-label">نوع درخواست</label>

                                        <div class="form-control">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" @checked($search_request_type == 'sell')
                                                    id="sell" name="search_request_type" value="sell">
                                                <label class="form-check-label" for="sell">فروش</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="ejareh"
                                                    @checked($search_request_type == 'ejareh') name="search_request_type" value="ejareh">
                                                <label class="form-check-label" for="ejareh">اجاره</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-start col-md-6">
                                        <label class="form-label d-block mb-2">قیمت</label>
                                        <input type="text"
                                            value="{{ $request_price != null ? number_format($request_price) : '' }}"
                                            onkeyup="separate(this);" class="form-control" id="request_price"
                                            name="request_price">
                                    </div>
                                    <div class="mb-3 text-start col-md-6">
                                        <label class="form-label d-block mb-2">آدرس</label>
                                        <input type="text" value="{{ $request_address }}" class="form-control"
                                            id="request_address" name="request_address">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-white"
                                    data-bs-dismiss="modal">انصراف</button>
                                <button type="submit" class="btn btn-primary text-white">جستجو</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}




    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">لیست املاک پیشنهادی</h4>
            </div>

            <div class="default-table-area members-list">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-primary text-start">
                                    <div class="form-check">
                                        <label class="form-check-label ms-2" for="flexCheckDefault">نام فروشنده</label>
                                    </div>
                                </th>
                                <th scope="col">شماره تماس</th>
                                <th scope="col">قیمت</th>
                                <th scope="col">نوع درخواست</th>
                                <th scope="col">جزئیات</th>
                                <th scope="col">تاریخ ثبت</th>
                                <th scope="col">عملیات</th>
                            </tr>
                        </thead>
                        @if (sizeof($offer_sell_buildings) > 0)
                            <tbody>
                                @foreach ($offer_sell_buildings as $item)
                                    <tr class="text-center">
                                        <td class="text-start">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check pe-2">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 lh-1">
                                                        <img src="{{ asset($item->path) }}" class="wh-44 rounded-circle"
                                                            alt="user">
                                                    </div>
                                                    <div class="flex-grow-1 ms-10">
                                                        <h4 class="fw-semibold fs-16 mb-0">{{ $item->seller_name }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="callto:{{ $item->seller_phone }}">{{ $item->seller_phone }}</a>
                                        </td>
                                        <td>
                                            <span
                                                class="bg-success bg-opacity-10 text-success fs-13 fw-semibold py-1 px-2 rounded-1">{{ number_format($item->price) }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <span
                                                    class="bg-info bg-opacity-10 text-info fs-13 fw-semibold py-1 px-2 rounded-1">{{ $item->request_type == 'sell' ? 'فروش' : 'اجاره' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary py-2 px-3 text-white fw-semibold rounded-3"
                                                data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id }}">
                                                جزئیات
                                            </button>
                                        </td>
                                        <td>
                                            <span>{{ $item->created_at }}</span>
                                        </td>
                                        <td>

                                            <button class="btn btn-success py-2 px-3 text-white fw-semibold rounded-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#buldingSellModal{{ $item->id }}">
                                                فروش ملک
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- modal information sellers --}}
                                    <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editUserModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel{{ $item->id }}">
                                                        جزئیات
                                                        درخواست
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>

                                                <div class="offcanvas-body p-4">
                                                    <input type="hidden" name="request_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="seller_id" value="{{ $item->id }}">
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
                                                        <label class="label">نام فروشنده *</label>
                                                        <input type="text" name="seller_name" disabled
                                                            value="{{ $item->seller_name }}" class="form-control text-dark"
                                                            placeholder="نام فروشنده">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">شماره تماس فروشنده *</label>
                                                        <input type="text" name="seller_phone" disabled
                                                            value="{{ $item->seller_phone }}"
                                                            class="form-control text-dark" placeholder="شماره تماس فروشنده">
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
                                                                    @checked($item->request_type == 'sell') type="checkbox"
                                                                    id="sell" name="request_type" value="sell">
                                                                <label class="form-check-label"
                                                                    for="sell">فروش</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                    @checked($item->request_type == 'ejareh') type="checkbox"
                                                                    id="ejareh" disabled name="request_type"
                                                                    value="ejareh">
                                                                <label class="form-check-label"
                                                                    for="ejareh">اجاره</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">ابعاد ساختمان *</label>
                                                        <input type="text" disabled name="dimensions_building"
                                                            value="{{ $item->dimensions_building }}" required
                                                            class="form-control text-dark">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">متراژ زمین *</label>
                                                        <input type="text" disabled name="meterage_building"
                                                            value="{{ $item->meterage_building }}" required
                                                            class="form-control text-dark">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">مدت ساخت *</label>
                                                        <input type="text" disabled name="year_manufacture"
                                                            value="{{ $item->year_manufacture }}" required
                                                            class="form-control text-dark">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">نوع سند *</label>
                                                        <input type="text" disabled name="document_type"
                                                            value="{{ $item->document_type }}" required
                                                            class="form-control text-dark">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">قیمت *</label>
                                                        <input type="text" disabled
                                                            value="{{ number_format($item->price) }}" name="price"
                                                            required class="form-control text-dark"
                                                            onkeyup="separate(this);" placeholder="5,000,000">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">تعداد خواب *</label>
                                                        <input type="number" disabled
                                                            value="{{ $item->number_bedrooms }}" name="number_bedrooms"
                                                            required class="form-control text-dark" placeholder="5">
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">امکانات *</label>
                                                        <div class="form-control">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                    @checked($item->water == 1) type="checkbox" disabled
                                                                    id="water" name="water" value="1">
                                                                <label class="form-check-label" for="water">اب</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                    @checked($item->electric == 1) type="checkbox" disabled
                                                                    id="electric" name="electric" value="1">
                                                                <label class="form-check-label" for="electric">برق</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                    @checked($item->gas == 1) type="checkbox" disabled
                                                                    id="gas" name="gas" value="1">
                                                                <label class="form-check-label" for="gas">گاز</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                    @checked($item->telephone == 1) type="checkbox" disabled
                                                                    id="telephone" name="telephone" value="1">
                                                                <label class="form-check-label"
                                                                    for="telephone">تلفن</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label class="label">آدرس *</label>
                                                        <textarea name="address" disabled class="form-control text-dark" id="" cols="30" rows="5">{{ $item->address }}</textarea>
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
                                                        فروش ملک
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="بستن"></button>
                                                </div>

                                                <div class="offcanvas-body p-4">
                                                    <form action="{{ route('building_sell') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="request_seller_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="seller_name"
                                                            value="{{ $item->seller_name }}">

                                                        <div class="form-group mb-4">
                                                            <label class="label">خریدار *</label>
                                                            <div class="form-control">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="buyer_id" name="buyer_id"
                                                                        value="{{ $data['buyer_info']->id }}">
                                                                    <label class="form-check-label"
                                                                        for="buyer_id">{{ $data['buyer_info']->name }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group d-flex gap-3 justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                                <span class="py-sm-1 d-block">
                                                                    <span>ثبت</span>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">درخواست فروش یافت نشد.</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="mt-3">
                    {{ $offer_sell_buildings->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
