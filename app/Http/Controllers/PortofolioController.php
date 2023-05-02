<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\portofolio;
use Illuminate\Support\Facades\Redis;

class PortofolioController extends Controller
{
    //

    public function index()
    {
        $portofolios = portofolio::all();
        return view('laravel-examples.user-management', ['portofolios' => $portofolios]);
    }

    public function create(Request $request)
    {
        $portofolio = portofolio::create($request->all());
        if ($request->hasFile('image')) {
            $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            $portofolio->image = $request->file('image')->getClientOriginalName();
            $portofolio->save();
        }

        return redirect('/user-management')->with('success', 'Portofolio berhasil ditambahkan')->with('alert', 'hide');
    }

    public function edit(Request $request)
    {
        $portofolio = portofolio::find($request->id);
        $portofolio->title = $request->title;
        $portofolio->description = $request->description;
        if ($request->hasFile('image')) {
            $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            $portofolio->image = $request->file('image')->getClientOriginalName();
        }
        $portofolio->save();
        return redirect('/user-management')->with('success', 'Portofolio berhasil diubah')->with('alert', 'hide');
    }

    public function delete(Request $request, $id)
    {
        portofolio::destroy($id);
        return redirect('/user-management')->with('success', 'Portofolio berhasil dihapus')->with('alert', 'hide');
    }

}
