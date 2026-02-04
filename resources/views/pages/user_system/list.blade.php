@extends('layouts.app')
@section('title', 'لیست کاربران سیستم')
@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">کاربران سیستم</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="index.html" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>خانه</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">کاربران سیستم</span>
        </li>
    </ul>
</div>

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">لیست کاربران</h4>
                <!-- Button trigger modal -->
                <button type="button"
                    class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3"
                    data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>افزودن کاربر</span>
                    </span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('user_system_store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">افزودن کاربر جدید</h5>
                                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"
                                        aria-label="بستن"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 text-start">
                                        <label for="userName" class="form-label">نام</label>
                                        <input type="text" class="form-control" id="userName" name="name" required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="userEmail" class="form-label">ایمیل</label>
                                        <input type="email" class="form-control" id="userEmail" name="email" required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="userPassword" class="form-label">رمز عبور</label>
                                        <input type="password" class="form-control" id="userPassword" name="password"
                                            required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label class="form-label d-block mb-2">سمت کاربری</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="roleAdmin"
                                                name="system_roles" value="admin">
                                            <label class="form-check-label" for="roleAdmin">مدیر</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="roleSecretary"
                                                name="system_roles" value="secretary">
                                            <label class="form-check-label" for="roleSecretary">منشی</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-white"
                                        data-bs-dismiss="modal">انصراف</button>
                                    <button type="submit" class="btn btn-primary text-white">ثبت کاربر</button>
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
                                            <label for="search_email" class="form-label">ایمیل</label>
                                            <input type="text" value="{{ $search_email }}" class="form-control"
                                                id="search_email" name="search_email">
                                        </div>
                                        <div class="mb-3 text-start col-md-6">
                                            <label class="form-label d-block mb-2">نقش کاربری</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" @checked(in_array('admin', $search_roles ?? [])) type="checkbox" id="admin"
                                                    name="search_roles[]" value="admin">
                                                <label class="form-check-label" for="admin">مدیر</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" @checked(in_array('secretary', $search_roles ?? [])) type="checkbox" id="secretary" name="search_roles[]"
                                                    value="secretary">
                                                <label class="form-check-label" for="secretary">منشی</label>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-start col-md-6">
                                            <label class="form-label d-block mb-2">وضعیت کاربری</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" @checked($search_active == '1') type="radio" id="1"
                                                    name="search_active" value="1">
                                                <label class="form-check-label text-success" for="1">فعال</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" @checked($search_active == '0') type="radio" id="0" name="search_active"
                                                    value="0">
                                                <label class="form-check-label text-danger" for="0">غیرفعال</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route(name: 'user_system') }}"
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
                                        <label class="form-check-label ms-2" for="flexCheckDefault">نام</label>
                                    </div>
                                </th>
                                <th scope="col">ایمیل</th>
                                <th scope="col">نقش</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">گزارش عملکرد</th>
                                <th scope="col">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($system_users) > 0)
                                @foreach ($system_users as $user)
                                    <tr class="text-center">
                                        <td class="text-start">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check pe-2">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 ms-10">
                                                        <h4 class="fw-semibold fs-16 mb-0">{{ $user->name }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $user->system_roles == 'admin' ? 'مدیر' : 'منشی' }}</span>
                                        </td>
                                        <td>
                                            @if ($user->active == 1)
                                                <span
                                                    class="bg-success bg-opacity-10 text-success fs-13 fw-semibold py-1 px-2 rounded-1">فعال</span>
                                            @else
                                                <span
                                                    class="bg-danger bg-opacity-10 text-danger fs-13 fw-semibold py-1 px-2 rounded-1">غیرفعال</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('user_system_report',$user->id)}}"
                                                    class="btn btn-outline-info fw-semibold hover-white px-3 py-1 fs-13 rounded-1">
                                                    <i data-feather="activity"></i>
                                                </a>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <!-- دکمه ویرایش -->
                                                <button
                                                    class="btn btn-sm text-white btn-warning px-3 py-1 fs-13 fw-semibold rounded-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal{{ $user->id }}">
                                                    ویرایش
                                                </button>

                                                <!-- دکمه حذف -->
                                                <button
                                                    class="btn btn-sm text-white btn-danger px-3 py-1 fs-13 fw-semibold rounded-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteUserModal{{ $user->id }}">
                                                    حذف
                                                </button>
                                            </div>

                                            <!-- Modal ویرایش  -->
                                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="editUserModalLabel{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editUserModalLabel{{ $user->id }}">ویرایش اطلاعات
                                                                کاربر
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="بستن"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <!-- فرم ویرایش اطلاعات (نمونه، قابلیت افزودن اکشن و مقادیر بیشتر دارد) -->
                                                            <form method="POST"
                                                                action="{{ route('user_system_update') }}">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $user->id }}">
                                                                <div class="mb-3">
                                                                    <label class="form-label">نام کاربر</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="{{ $user->name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">رمزعبور</label>
                                                                    <input type="password" name="password"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label d-block mb-2">سمت
                                                                        کاربری</label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($user->system_roles == 'admin') type="radio"
                                                                            id="roleAdmin" name="system_roles"
                                                                            value="admin">
                                                                        <label class="form-check-label"
                                                                            for="roleAdmin">مدیر</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($user->system_roles == 'secretary') type="radio"
                                                                            id="roleSecretary" name="system_roles"
                                                                            value="secretary">
                                                                        <label class="form-check-label"
                                                                            for="roleSecretary">منشی</label>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label d-block mb-2">وضعیت
                                                                        کاربری</label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($user->active == '1') type="radio"
                                                                            id="active_user" name="active"
                                                                            value="1">
                                                                        <label class="form-check-label text-success"
                                                                            for="active_user">فعال</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            @checked($user->active == '0') type="radio"
                                                                            id="deactive" name="active"
                                                                            value="0">
                                                                        <label class="form-check-label text-danger"
                                                                            for="deactive">غیرفعال</label>
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

                                            <!-- Modal حذف -->
                                            <div class="modal fade" id="deleteUserModal{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteUserModalLabel{{ $user->id }}">حذف کاربر
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="بستن"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            آیا مطمئن هستید که می‌خواهید کاربر "{{ $user->name }}" را حذف
                                                            کنید؟
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST"
                                                                action="{{ route('user_system_delete') }}">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $user->id }}">
                                                                <input type="hidden" name="name"
                                                                    value="{{ $user->name }}">

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
                                    <td colspan="5" class="text-center text-muted py-4">کاربری یافت نشد.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                {{ $system_users->links() }}
            </div>
        </div>
    </div>
@endsection
