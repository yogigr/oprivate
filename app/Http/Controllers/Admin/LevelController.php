<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $levels = Level::where('name', 'like', '%'.request('search').'%')
            ->orWhere('short_name', 'like', '%'.request('search').'%')->sortable()->paginate(10);
        } else {
            $levels = Level::sortable(['id' => 'desc'])->paginate(10);
        }
        
        return view('admin.level.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.level.create');
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
            'level_name' => 'required|string|unique:levels,name',
            'level_short_name' => 'required|string|unique:levels,short_name'
        ]);

        $level = Level::create([
            'name' => $request->level_name,
            'short_name' => $request->level_short_name,
        ]);

        return redirect()->route('admin.level.index')->with('success', 'Berhasil tambah Jenjang Pendidikan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('admin.level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $request->validate([
            'level_name' => 'required|string|unique:levels,name,'.$level->id,
            'level_short_name' => 'required|string|unique:levels,short_name,'.$level->id
        ]);

        $level->name = $request->level_name;
        $level->short_name = $request->level_short_name;
        $level->save();
        
        return redirect()->route('admin.level.index')->with('success', 'Berhasil update Jenjang Pendidikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.level.index')->with('success', 'Berhasil hapus Jenjang Pendidikan');
    }
}
