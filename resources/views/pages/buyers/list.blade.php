@extends('layouts.app')
@section('title', 'لیست خریداران')
@section('content')

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">خریداران</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="index.html" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>خانه</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">خریداران</span>
            </li>
        </ul>
    </div>

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">لیست خریداران</h4>
                <!-- Button trigger modal -->
                <button type="button"
                    class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                    data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>افزودن خریدار</span>
                    </span>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('buyer_store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">افزودن خریدار جدید</h5>
                                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"
                                        aria-label="بستن"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 text-start">
                                        <label for="name" class="form-label">نام و نام خانوادگی</label>
                                        <input type="text" class="form-control" requierd id="name" name="name">
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="phone" class="form-label">شماره تماس</label>
                                        <input type="tel" minlength="11" maxlength="11" requierd class="form-control"
                                            id="phone" name="phone">
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label class="form-label d-block mb-2">جنسیت</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" checked type="radio" id="male"
                                                name="gender" value="male">
                                            <label class="form-check-label" for="male">آقا</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="female" name="gender"
                                                value="female">
                                            <label class="form-check-label" for="female">خانم</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-white"
                                        data-bs-dismiss="modal">انصراف</button>
                                    <button type="submit" class="btn btn-primary text-white">ثبت خریدار</button>
                                </div>
                            </form>
                        </div>
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
                                        <div class="mb-3 text-start col-md-6">
                                            <label for="name" class="form-label">نام و نام خانوادگی</label>
                                            <input type="text" value="{{ $search_name }}" class="form-control" id="search_name" name="search_name">
                                        </div>
                                        <div class="mb-3 text-start col-md-6">
                                            <label for="search_phone" class="form-label">شماره تماس</label>
                                            <input type="tel" value="{{ $search_phone }}" maxlength="11" class="form-control"
                                                id="search_phone" name="search_phone">
                                        </div>
                                        <div class="mb-3 text-start col-md-6">
                                            <label class="form-label d-block mb-2">جنسیت</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" @checked($search_gender == 'male') type="radio" id="male"
                                                    name="search_gender" value="male">
                                                <label class="form-check-label" for="male">آقا</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" @checked($search_gender == 'female') type="radio" id="female" name="search_gender"
                                                    value="female">
                                                <label class="form-check-label" for="female">خانم</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('buyers') }}"
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


            
            <div class="default-table-area members-list">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-primary text-start">
                                    <div class="form-check">
                                        <label class="form-check-label ms-2" for="flexCheckDefault">نام و نام
                                            خانوادگی</label>
                                    </div>
                                </th>
                                <th scope="col">شماره تماس</th>
                                <th scope="col">جنسیت</th>
                                <th scope="col">تاریخ ثبت</th>
                                <th scope="col">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($buyers) > 0)
                                @foreach ($buyers as $item)
                                    <tr class="text-center">
                                        <td class="text-start">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check pe-2">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 ms-10">
                                                        <h4 class="fw-semibold fs-16 mb-0">{{ $item->name }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $item->phone }}">{{ $item->phone }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $item->gender == 'male' ? 'آقا' : 'خانم' }}</span>
                                        </td>
                                        <td>
                                            {{ $item->created_at }}
                                        </td>
                                        <td>

                                            <div class="d-flex gap-3 justify-content-center mb-4 pb-1">
                                                <button href="chat.html"
                                                    class="btn btn-primary py-2 px-3 text-white fw-semibold rounded-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal{{ $item->id }}">
                                                    بروزرسانی
                                                </button>
                                                <button href="chat.html"
                                                    class="btn btn-danger py-2 px-3 text-white fw-semibold rounded-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteUserModal{{ $item->id }}">
                                                    حذف
                                                </button>
                                                <a href="{{ route('buyer_requests', $item->id) }}"
                                                    class="btn btn-info py-2 px-3 text-white fw-semibold rounded-3">
                                                    درخواست‌ها
                                                </a>
                                            </div>


                                            {{-- modal update buyers --}}
                                            <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="editUserModalLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editUserModalLabel{{ $item->id }}">ویرایش
                                                                اطلاعات
                                                                خریدار
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="بستن"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <!-- فرم ویرایش اطلاعات (نمونه، قابلیت افزودن اکشن و مقادیر بیشتر دارد) -->
                                                            <form method="POST" action="{{ route('buyer_update') }}">
                                                                @csrf
                                                                <input type="hidden" name="buyer_id"
                                                                    value="{{ $item->id }}">
                                                                <div class="mb-3">
                                                                    <label class="form-label">نام خریدار</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="{{ $item->name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">شماره تماس</label>
                                                                    <input type="tel" minlength="11" maxlength="11"
                                                                        name="phone" value="{{ $item->phone }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label d-block mb-2">جنسیت</label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($item->gender == 'male') type="radio"
                                                                            id="male" name="gender" value="male">
                                                                        <label class="form-check-label"
                                                                            for="male">آقا</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($item->gender == 'female') type="radio"
                                                                            id="female" name="gender" value="female">
                                                                        <label class="form-check-label"
                                                                            for="female">خانم</label>
                                                                    </div>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary text-white">ذخیره
                                                                    تغییرات</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- modal delete buyer --}}

                                            <div class="modal fade" id="deleteUserModal{{ $item->id }}"
                                                tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteUserModalLabel{{ $item->id }}">حذف
                                                                خریدار
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="بستن"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            آیا مطمئن هستید که می‌خواهید خریدار "{{ $item->name }}" را
                                                            حذف
                                                            کنید؟
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{ route('buyer_delete') }}">
                                                                @csrf
                                                                <input type="hidden" name="buyer_id"
                                                                    value="{{ $item->id }}">
                                                                <input type="hidden" name="name"
                                                                    value="{{ $item->name }}">

                                                                <button type="button"
                                                                    class="btn btn-secondary text-white"
                                                                    data-bs-dismiss="modal">خیر</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger text-white">حذف</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">خریداری یافت نشد.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                {{ $buyers->links() }}
            </div>
        </div>
    </div>
@endsection
