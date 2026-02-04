@extends('layouts.app')
@section('title', 'درخواست فروشندگان')
@section('content')
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <a href="{{ route('seller_requests',$data['seller_info']->seller_id) }}" class="btn btn-info text-white mb-sm-0 mb-1 fs-18">صفحه قبل</a>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="index.html" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>خانه</span>
                </a>
            </li>
            <li>
                <a href="{{ route('seller_requests',$data['seller_info']->seller_id) }}" class="fw-semibold fs-14 heading-font text-dark dot ms-2">درخواست‌ها</a>
            </li>
        </ul>
    </div>
    @foreach ($data['images'] as $item)
        <div
            class="form-group mb-2 p-4 bg-border-gray-light d-sm-flex justify-content-between align-items-center rounded-10">
            <div class="d-sm-flex align-items-center mb-3 mb-sm-0 me-lg-3">
                <div class="me-md-5 pe-xxl-5 mb-3 mb-sm-0">
                    {{-- <h4 class="body-font fs-15 fw-semibold text-body">آواتار پروژه</h4> --}}
                    {{-- <p>این روی آواتار پروژه شما نمایش داده می شود.</p> --}}
                </div>
                <img src="{{ asset($item->path) }}" class="rounded-4 wh-78 ms-3 ms-lg-0" alt="product">
            </div>

            <div class="d-flex ms-sm-3 ms-md-0">
                <button class="btn bg-danger bg-opacity-10 text-danger fw-semibold" data-bs-toggle="modal"
                    data-bs-target="#deleteUserModal{{ $item->id }}">حذف</button>
                <button class="btn bg-primary bg-opacity-10 text-primary fw-semibold ms-3" data-bs-toggle="modal"
                    data-bs-target="#editUserModal{{ $item->id }}">بروزرسانی</button>
            </div>
        </div>
        {{-- modal update images request --}}
        <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editUserModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel{{ $item->id }}">ویرایش عکس</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body text-start">
                        <!-- فرم ویرایش اطلاعات (نمونه، قابلیت افزودن اکشن و مقادیر بیشتر دارد) -->
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('change_image_seller_request_update') }}">
                            @csrf
                            <input type="hidden" name="images_requests_seller_id" value="{{ $item->id }}">
                            <input type="hidden" name="request_seller_id" value="{{ $data['seller_info']->request_seller_id }}">
                            <input type="hidden" name="seller_name" value="{{ $data['seller_info']->name }}">
                            <div class="mb-3">
                                <label class="form-label">انتخاب عکس</label>
                                <input type="file" accept="image/*" name="image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary text-white">ذخیره
                                تغییرات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- modal delete images request --}}

        <div class="modal fade" id="deleteUserModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="deleteUserModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel{{ $item->id }}">حذف عکس
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        آیا مطمئن هستید که می‌خواهید عکس را حذف
                        کنید؟
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('change_image_seller_request_delete') }}">
                            @csrf
                            <input type="hidden" name="images_requests_seller_id" value="{{ $item->id }}">
                            <input type="hidden" name="request_seller_id" value="{{ $data['seller_info']->request_seller_id }}">
                            <input type="hidden" name="seller_name" value="{{ $data['seller_info']->name }}">

                            <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">خیر</button>
                            <button type="submit" class="btn btn-danger text-white">حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
