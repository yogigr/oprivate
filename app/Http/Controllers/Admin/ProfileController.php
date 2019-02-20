<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $admin = Auth::user();
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email,'.$admin->id,
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect('admin/profile')->with('success', 'Berhasil update profile');
    }

    public function changePassword(Request $request)
    {
        $admin = Auth::user();
        $request->validate([
            'old_password' => [
                'required',
                function($attribute, $value, $fail) use ($admin) {
                    if (!Hash::check($value, $admin->password)) {
                        return $fail($attribute.' is invalid');
                    }
                },
            ],
            'new_password' => 'required|string|min:6|confirmed'
        ]);
        $admin->password = bcrypt($request->new_password);
        $admin->save();
        return redirect('admin/profile')->with('success', 'Berhasil mengganti password');
    }

}
