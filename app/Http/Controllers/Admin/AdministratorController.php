<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $administrators = User::where('role_id', 1)->where('name', 'like', '%'.request('search').'%')
            ->orWhere('email', 'like', '%'.request('search').'%')->sortable()->paginate(10);
        } else {
            $administrators = User::where('role_id', 1)->sortable(['id' => 'desc'])->paginate(10);
        }
        
        return view('admin.administrator.index', compact('administrators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.administrator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'administrator_name' => 'required|string',
            'administrator_email' => 'required|string|unique:users,email',
            'administrator_password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->administrator_name,
            'email' => $request->administrator_email,
            'password' => bcrypt($request->administrator_password),
            'role_id' => 1,
            'is_active' => true
        ]);

        return redirect('admin/administrator')->with('success', 'Berhasil tambah administrator');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $administrator)
    {
        return view('admin.administrator.edit', compact('administrator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $administrator)
    {
        $request->validate([
            'administrator_name' => 'required|string',
            'administrator_email' => 'required|string|unique:users,email,'.$administrator->id,
        ]);

        $administrator->name = $request->administrator_name;
        $administrator->email = $request->administrator_email;
        $administrator->save();

        return back()->with('success', 'Berhasil perbarui Administrator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $administrator)
    {
        //delete teacher
        $administrator->delete();
        return redirect('admin/administrator')->with('success', 'Berhasil hapus Administrator');
    }
}
