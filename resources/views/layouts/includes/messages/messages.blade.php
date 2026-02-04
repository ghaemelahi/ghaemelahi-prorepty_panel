{{-- Strart Alert User Systems --}}
@if ($errors->error_store_user_system->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_store_user_system->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if ($errors->errors_update_user_system->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->errors_update_user_system->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if ($errors->error_delete_user_system->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_delete_user_system->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if ($errors->error_search_data->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_search_data->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if (Session::has('success_update_user_system'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_update_user_system') }}",
        });
    </script>
@endif


@if (Session::has('success_create_user_system'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_create_user_system') }}",
        });
    </script>
@endif


@if (Session::has('success_delete_user_system'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_delete_user_system') }}",
        });
    </script>
@endif


@if (Session::has('error_deactive_user_system'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "warning",
            text: "{{ Session::get('error_deactive_user_system') }}",
        });
    </script>
@endif


@if (Session::has('error_notfound_user_system'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            text: "{{ Session::get('error_notfound_user_system') }}",
        });
    </script>
@endif
{{-- End Alert User Systems --}}





{{-- Start Alert Buyer --}}
@if ($errors->error_store_buyer->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_store_buyer->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if ($errors->error_search_buyer->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_search_buyer->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if ($errors->error_update_buyer->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_update_buyer->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if ($errors->error_delete_buyer->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_delete_buyer->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if ($errors->error_undelete_buyer->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_undelete_buyer->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if (Session::has('success_create_buyer'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_create_buyer') }}",
        });
    </script>
@endif


@if (Session::has('success_update_buyer'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_update_buyer') }}",
        });
    </script>
@endif


@if (Session::has('success_delete_buyer'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_delete_buyer') }}",
        });
    </script>
@endif


@if (Session::has('success_undelete_buyer'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_undelete_buyer') }}",
        });
    </script>
@endif

{{-- End Alert buyer --}}





{{-- Start Alert Buyer  Request --}}
@if ($errors->error_not_found_buyer->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_not_found_buyer->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_create_buyer_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_create_buyer_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_update_buyer_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_update_buyer_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_delete_buyer_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_delete_buyer_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_undelete_buyer_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_undelete_buyer_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if (Session::has('success_create_buyer_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_create_buyer_request') }}",
        });
    </script>
@endif


@if (Session::has('success_update_buyer_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_update_buyer_request') }}",
        });
    </script>
@endif


@if (Session::has('success_delete_buyer_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_delete_buyer_request') }}",
        });
    </script>
@endif


@if (Session::has('success_undelete_buyer_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_undelete_buyer_request') }}",
        });
    </script>
@endif

{{-- End Alert buyer Request --}}





{{-- Start Alert Seller --}}
@if ($errors->error_store_seller->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_store_seller->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if ($errors->error_update_seller->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_update_seller->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if ($errors->error_delete_seller->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_delete_seller->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if ($errors->error_undelete_seller->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_undelete_seller->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if (Session::has('success_create_seller'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_create_seller') }}",
        });
    </script>
@endif


@if (Session::has('success_update_seller'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_update_seller') }}",
        });
    </script>
@endif


@if (Session::has('success_delete_seller'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_delete_seller') }}",
        });
    </script>
@endif


@if (Session::has('success_undelete_seller'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_undelete_seller') }}",
        });
    </script>
@endif

{{-- End Alert Seller --}}





{{-- Start Alert seller  Request --}}
@if ($errors->error_not_found_seller->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_not_found_seller->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_create_seller_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_create_seller_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_update_seller_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_update_seller_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_delete_seller_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_delete_seller_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif



@if ($errors->error_undelete_seller_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_undelete_seller_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if (Session::has('success_create_seller_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_create_seller_request') }}",
        });
    </script>
@endif


@if (Session::has('success_update_seller_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_update_seller_request') }}",
        });
    </script>
@endif


@if (Session::has('success_delete_seller_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_delete_seller_request') }}",
        });
    </script>
@endif


@if (Session::has('success_undelete_seller_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_undelete_seller_request') }}",
        });
    </script>
@endif

{{-- End Alert seller Request --}}


{{-- Start Alert change Image seller  Request --}}
@if ($errors->error_not_found_seller_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_not_found_seller_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if ($errors->error_update_change_seller_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_update_change_seller_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if ($errors->error_delete_change_seller_request->any())
    <div class="alert alert-danger mt-3" role="alert">
        @foreach ($errors->error_delete_change_seller_request->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif




@if (Session::has('success_update_change_image_seller_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_update_change_image_seller_request') }}",
        });
    </script>
@endif




@if (Session::has('success_delete_change_image_seller_request'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_delete_change_image_seller_request') }}",
        });
    </script>
@endif
{{-- End Alert change Image seller Request --}}


{{-- Start Alert change Image seller  Request --}}
@if (Session::has('error_add_building_sell'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            text: "{{ Session::get('error_add_building_sell') }}",
        });
    </script>
@endif


@if (Session::has('success_sell_building_to_buyer'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_sell_building_to_buyer') }}",
        });
    </script>
@endif
{{-- End Alert change Image seller Request --}}



{{-- Start Alert reate new sell request buy cusmers with link  Request --}}
@if (Session::has('success_create_seller_request_customer'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            text: "{{ Session::get('success_create_seller_request_customer') }}",
        });
    </script>
@endif
{{-- End Alert reate new sell request buy cusmers with link Request --}}