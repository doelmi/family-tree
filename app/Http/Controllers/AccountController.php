<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPasswordRule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function profile()
    {
        $contentTitle = 'Pengguna';
        $user = Auth::user();
        return view('content.bfr-account-profile', compact('contentTitle', 'user'));
    }

    public function profileUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email," . Auth::user()->id,
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            DB::commit();
            return redirect()->route('account.profile')->with('message', 'Profil Saya berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }

    public function profileUpdatePassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', new MatchOldPasswordRule],
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();

            DB::commit();
            return redirect()->route('account.profile')->with('message', 'Kata sandi Anda berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }
}
