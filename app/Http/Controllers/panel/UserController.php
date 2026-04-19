<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Helpers\LogService;
use App\Http\Requests\Users\UserDeleteRequest;
use App\Http\Requests\Users\UserIndexRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function index(UserIndexRequest $request)
    {
        $search_name = $request->search_name;
        $search_email = $request->search_email;
        $search_roles = $request->input('search_roles', []);
        $search_active = intval($request->search_active);
        $system_users = User::query()
        ->searchName($search_name)
        ->searchEmaile($search_email)
        ->searchRoles($search_roles)
        ->searchActive($search_active)
        ->paginate(15)
        ->appends($request->query());

        return view('pages.user_system.list', compact('system_users', 'search_name', 'search_email', 'search_roles', 'search_active'));
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();

        $data['p_created_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $data['p_updated_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $data['password'] = Hash::make($request->password);
        $user = User::query()->create($data);
        // $user = User::create([
        //     'name'         => $request->name,
        //     'email'        => $request->email,
        //     'system_roles' => $request->system_roles,
        //     'password'     => Hash::make($request->password),
        //     'p_created_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        //     'p_updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        // ]);

        // اختصاص نقش
        $role = Role::findByName($request->system_roles);
        $user->assignRole($role);

        //MAKE:-> LOG SERVICE
        $system_role = $request->system_roles == 'admin' ? 'مدیر' : 'منشی';
        $report = "create_user_system";
        $description = "ثبت کاربر سیستم $request->name با نقش کاربری $system_role";
        $this->logService->saveLog($report, $description);
        //MAKE:-> END LOG SERVICE
        return redirect()->route('user_system')->with('success_create_user_system', 'کاربر با موفقیت ایجاد شد');
    }

    public function update(UserUpdateRequest $request)
    {

        $user = User::find($request->user_id);

        $data = $request->all();
        $data['password'] = $request->password ? Hash::make($request->password):$user->password;
        $data['p_updated_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $user->update($data);
       /* $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'system_roles' => $request->system_roles,
            'password'     => $user->password,
            'p_updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        if ($request->password) {
            User::whereId($request->user_id)->update([
                'password'     => Hash::make($request->password),
            ]);
        }*/

        // اختصاص نقش
        $user = User::find($request->user_id);
        $role = Role::findByName($request->system_roles);
        $user->roles()->detach();
        $user->assignRole($role);

        //MAKE:-> LOG SERVICE
        $system_role = $request->system_roles == 'admin' ? 'مدیر' : 'منشی';
        $report = "update_user_system";
        $description = "ویرایش کاربر سیستم $request->name با نقش کاربری $system_role";
        $this->logService->saveLog($report, $description);
        //MAKE:-> END LOG SERVICE
        return redirect()->route('user_system')->with('success_update_user_system', "کاربر $request>name با موفقیت بروزرسانی شد");
    }

    public function delete(UserDeleteRequest $request, User $user)
    {

        $user->delete();
        /*User::whereId($request->user_id)->update([
            'is_deleted' => 1,
            'p_updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'deleted_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);*/

        //MAKE:-> LOG SERVICE
        $report = "delete_user_system";
        $description = "حذف کاربر سیستم $request->name";
        $this->logService->saveLog($report, $description);
        //MAKE:-> END LOG SERVICE
        return redirect()->route('user_system')->with('success_delete_user_system', "کاربر $request->name با موفقیت حذف گردید.");
    }


    public function user_report(Request $request,$user_id)
    {
        $validate = validator::make(['user_id' => $user_id], [
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error_notfound_user_id', 'کاربر موردنظر یافت نشد.');
        }

        $data['user_system_info'] = DB::table('users')->whereId($user_id)->first();
        $data['user_system_reports'] = DB::table('reports')->where('user_id', $user_id)->paginate(50)->through(function ($item) {
            $item->report = match ($item->report) {
                'create_user_system' => 'ثبت کاربر',
                'update_user_system' => 'ویرایش کاربر',
                'delete_user_system' => 'حذف کاربر',
                'sell_prorepty_to_buyer' => 'فروش ملک به خریدار',
                'create_buyer' => 'ثبت خریدار',
                'update_buyer' => 'ویرایش خریدار',
                'delete_buyer' => 'حذف خریدار',
                'undelete_buyer' => 'فعال کردن خریدار',
                'create_seller' => 'ثبت فروشنده',
                'update_seller' => 'ویرایش فروشنده',
                'delete_seller' => 'حذف فروشنده',
                'undelete_seller' => 'فعال کردن فروشنده',
                'update_image_seller_request' => 'ویرایش عکس درخواست فروش',
                'delete_image_seller_request' => 'حذف عکس درخواست فروش',
                'create_seller_request' => 'ثبت درخواست فروش',
                'update_seller_request' => 'ویرایش درخواست فروش',
                'delete_seller_request' => 'حذف درخواست فروش',
                'undelete_seller_request' => 'فعال سازی درخواست فروش',
                'create_buyer_request' => 'ثبت درخواست خرید',
                'update_buyer_request' => 'ویرایش درخواست خرید',
                'delete_buyer_request' => 'حذف درخواست خرید',
                'undelete_buyer_request' => 'فعال سازی درخواست خرید',
            };

            return $item;
        })->appends($request->query());

        return view('pages.user_system.reports', compact('data'));
    }
}
