@extends('layouts.auth_panels.auth_app')
@section('title', 'ثبت درخواست')
@section('content')

    <div class="row justify-content-center">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card bg-white border-1 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">ثبت درخواست فروش</h4>
                    {{-- <div class="border-bottom pb-3 mb-3">
                        <h4 class="fs-18 fw-semibold mb-1">پروفایل</h4>
                        <p class="fs-15">عکس و مشخصات شخصی خود را در اینجا به روز کنید.</p>
                    </div> --}}
                    <form action="{{ route('customer_request_sell_store') }}" enctype="multipart/form-data" method="POST">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">نام و نام خانوادگی *</label>
                                <input type="text" name="seller_name" class="form-control text-dark"
                                    placeholder="نام و نام خانوادگی">
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">شماره تماس *</label>
                                <input type="text" name="seller_phone" class="form-control text-dark"
                                    placeholder="شماره تماس">
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">جنسیت *</label>
                                <select class="form-select form-control text-dark" name="gender"
                                    aria-label="Default select example">
                                    <option value="male">آقا</option>
                                    <option value="female">خانم</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">نوع ملک *</label>
                                <select class="form-select form-control text-dark" name="reoperty_type"
                                    aria-label="Default select example">
                                    <option value="tejari">تجاری</option>
                                    <option value="maskoni">مسکونی</option>
                                    <option value="earth">زمین</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">نوع درخواست *</label>
                                <div class="form-control">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="sell" name="request_type"
                                            value="sell">
                                        <label class="form-check-label" for="sell">فروش</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="ejareh" name="request_type"
                                            value="ejareh">
                                        <label class="form-check-label" for="ejareh">اجاره</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">ابعاد ساختمان *</label>
                                <input type="text" name="dimensions_building" class="form-control text-dark">
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">متراژ زمین *</label>
                                <input type="text" name="meterage_building" class="form-control text-dark">
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">مدت ساخت *</label>
                                <input type="text" name="year_manufacture" class="form-control text-dark">
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">نوع سند *</label>
                                <input type="text" name="document_type" class="form-control text-dark">
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">قیمت *</label>
                                <input type="text" name="price" class="form-control text-dark"
                                    onkeyup="separate(this);">
                            </div>
                            <div class="form-group col-md-6 mb-4">
                                <label class="label">تعداد خواب *</label>
                                <input type="number" name="number_bedrooms" class="form-control text-dark">
                            </div>
                            <div class="form-group col-md-6 mb-4">
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
                                <textarea name="address" class="form-control text-dark" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label class="label">پیوست *</label>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
