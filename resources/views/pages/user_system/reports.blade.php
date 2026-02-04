@extends('layouts.app')
@section('title', 'گزارش عملکرد')
@section('content')


<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <a href="{{ route('user_system') }}" class="btn btn-primary hover-white fw-semibold rounded-1 text-white mb-sm-0 mb-1 fs-18">صفحه قبل</a>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="index.html" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>خانه</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">لیست عملکرد</span>
        </li>
    </ul>
</div>
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">گزارش عملکرد ({{$data['user_system_info']->name}})</h4>
            </div>
            <div class="default-table-area members-list">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">ردیف</th>
                                <th scope="col">عملیات</th>
                                <th scope="col">توضیحات</th>
                                <th scope="col">تاریخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data['user_system_reports']) > 0)
                                @foreach ($data['user_system_reports'] as $counter=>$user)
                                    <tr class="text-center">
                                        <td>{{ $counter + 1 }}</td>
                                        <td class="text-start">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check pe-2">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 ms-10">
                                                        <h4 class="fw-semibold fs-16 mb-0">{{ $user->report }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $user->description }}
                                        </td>
                                        <td>
                                            <span>{{ $user->date }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">اطلاعاتی یافت نشد.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $data['user_system_reports']->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
