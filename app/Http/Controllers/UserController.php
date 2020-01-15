<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use Spatie\Permission\Models\Permission;
use DB;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::orderBy('name', 'ASC')->get();
        return view('users.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name'
        ]);

        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'status' => true
        ]);
        $user->assignRole($request->role);
        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',

        ]);
        // $user = User::all();
        // dd($user);
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->name = $request->name;
        if($request->password == null){
            $user->password = $user->password;
        }
        else{
            $user->password = bcrypt($request->password);
        }
         //avatar
         if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $path = public_path() . '/assets/backend/dist/img/user/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccsess = $file->move($path, $filename);
            //hapus Media_Sample lama
            if ($user->avatar){
                $old_foto = $user->avatar;
                $filepath = public_path() . '/assets/backend/dist/img/user/' . $user->avatar;
                try {
                    File::delete($filepath);
                }
                catch (FileNotFoundException $e){
                    //File sudah dihapus atau tidak ada
                }
            }
            $user->avatar = $filename;
        }
             $user->save();
        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }

    public function rolePermission(Request $request)
{
    $role = $request->get('role');

    //Default, set dua buah variable dengan nilai null
    $permissions = null;
    $hasPermission = null;

    //Mengambil data role
    $roles = Role::all()->pluck('name');

    //apabila parameter role terpenuhi
    if (!empty($role)) {
        //select role berdasarkan namenya, ini sejenis dengan method find()
        $getRole = Role::findByName($role);

        //Query untuk mengambil permission yang telah dimiliki oleh role terkait
        $hasPermission = DB::table('role_has_permissions')
            ->select('permissions.name')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id', $getRole->id)->get()->pluck('name')->all();

        //Mengambil data permission
        $permissions = Permission::all()->pluck('name');
    }
    return view('users.role_permission', compact('roles', 'permissions', 'hasPermission'));
}
public function addPermission(Request $request)
{
    $this->validate($request, [
        'name' => 'required|string|unique:permissions'
    ]);

    $permission = Permission::firstOrCreate([
        'name' => $request->name
    ]);
    return redirect()->back();
}
public function setRolePermission(Request $request, $role)
{
    //select role berdasarkan namanya
    $role = Role::findByName($role);

    //fungsi syncPermission akan menghapus semua permissio yg dimiliki role tersebut
    //kemudian di-assign kembali sehingga tidak terjadi duplicate data
    $role->syncPermissions($request->permission);
    return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
}
public function roles(Request $request, $id)
{
    $user = User::findOrFail($id);
    $roles = Role::all()->pluck('name');
    return view('users.roles', compact('user', 'roles'));
}
//untuk meng-handle perubahan role user
public function setRole(Request $request, $id)
{
    $this->validate($request, [
        'role' => 'required'
    ]);
    $user = User::findOrFail($id);
    //menggunakan syncRoles agar terlebih dahulu menghapus semua role yang dimiliki
    //kemudian di-set kembali agar tidak terjadi duplicate
    $user->syncRoles($request->role);
    return redirect()->back()->with(['success' => 'Role Sudah Di Set']);
}
public function userOnlineStatus()
{
    $users = DB::table('users')->get();

    foreach ($users as $user) {
        if (Cache::has('user-is-online-' . $user->id))
            echo "User " . $user->name . " is online.";
        else
            echo "User " . $user->name . " is offline.";
    }
}
}
