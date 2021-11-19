<?php

namespace App\Http\Controllers;

use App\Person;
use App\User;
use App\UserDetail;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contentTitle = 'Pengguna';
        $users = User::all();
        return view('content.bfr-user-list', compact('contentTitle', 'users'));
    }

    public function create()
    {
        $contentTitle = 'Pengguna';
        $roles = UserRole::all();
        return view('content.bfr-user-create', compact('contentTitle', 'roles'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'status' => 'string',
                'role_id' => ['required', Rule::in(UserRole::all()->pluck('id')->toArray())],
                'person_id' => ['required', Rule::in(Person::all()->pluck('id')->toArray())]
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            UserDetail::create([
                'user_id' => $user->id,
                'people_id' => $request->person_id,
                'role_id' => $request->role_id,
                'status' => $request->status == 'on' ? 'active' : 'non-active'
            ]);

            DB::commit();
            return redirect()->route('user.index')->with('message', 'Pengguna berhasil dibuat');
        } catch (\Throwable $th) {
            DB::rollback();
            $person = Person::find($request->person_id);
            return back()->with(['error' => $th->getMessage(), 'person_name' => $person->name])->withInput();
        }
    }

    public function edit($id)
    {
        $contentTitle = 'Pengguna';
        $user = User::find($id);
        $roles = UserRole::all();
        return view('content.bfr-user-edit', compact('contentTitle', 'roles', 'user'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email,$id",
                'status' => 'string',
                'role_id' => ['required', Rule::in(UserRole::all()->pluck('id')->toArray())],
                'person_id' => ['required', Rule::in(Person::all()->pluck('id')->toArray())]
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $userDetail = UserDetail::find($user->detail->id);
            $userDetail->people_id = $request->person_id;
            $userDetail->role_id = $request->role_id;
            $userDetail->status = $request->status == 'on' ? 'active' : 'non-active';
            $userDetail->save();

            DB::commit();
            return redirect()->route('user.index')->with('message', 'Pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }

    public function updatePassword(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }
            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();
            return redirect()->route('user.index')->with('message', 'Kata sandi pengguna berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }
}
