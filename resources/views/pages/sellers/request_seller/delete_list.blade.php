@extends('layouts.app')
@section('title', 'درخواست فروش')
@section('content')

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-bold fs-18 mb-0">درخواست فروش‌های حذف شده</h4>
                <div class="dropdown action-opt">
                </div>
            </div>

            <div class="default-table-area recent-orders">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="text-primary">نام و نام خانوادگی</th>
                                <th scope="col">شماره تماس</th>
                                <th scope="col">نوع ملک</th>
                                <th scope="col">نوع درخواست</th>
                                <th scope="col">تاریخ حذف</th>
                                <th scope="col">بازگردانی</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($data))
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="fw-semibold">{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ $item->phone }}l" class="d-flex align-items-center">
                                                <h6>{{ $item->phone }}</h6>
                                            </a>
                                        </td>
                                        <td class="fw-semibold">{{ $item->request_type }}</td>
                                        <td class="fw-semibold">{{ $item->reoperty_type }}</td>
                                        <td>{{ $item->delete_at }}</td>
                                        <td>
                                            <form action="{{ route('seller_request_undelete') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="request_id" value="{{ $item->id }}">
                                                <input type="hidden" name="seller_id" value="{{ $item->seller_id }}">
                                                <input type="hidden" name="seller_name" value="{{ $item->name }}">
                                                <button type="submit"
                                                    class="btn bg-success bg-opacity-10 fw-semibold text-success py-2 px-4 mt-2 me-2"><i
                                                        class="flaticon-unlock"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">درخواست فروش یافت نشد.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
