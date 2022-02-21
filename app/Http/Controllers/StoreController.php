<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $stores = Store::orderBy('created_at', 'ASC')
            ->orderBy('name', 'DESC')
            ->latest()
            ->limit(10)
            ->paginate(5);

        return view('admin.stores.index', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::where('status', '=', 'Active')->get();
        $Store = new Store();
        return view('admin.stores.create', ['stores' => $stores, 'Store' => $Store]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate(Store::validateRule());

        //requset Merge ^_^ 
        $request->merge([
            'slug' => Str::slug($request->get('name'))
        ]);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('uploads', 'public');
            $input['image'] = $image_path;
        }
        $stores = Store::create($input);
        //  Write into session 
        //$success = $request->session()->flash('success', $request->name . 'add successfully');
        //Alert::success('Success Title', 'Success Message');

        return redirect()->route('stores.index', ['stores' => $stores]);
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
        // Gate::authorize('stores.update');

        $Store = Store::findorfail($id);
        $stores = Store::where('status', '=', 'Active')->get();

        return view('admin.stores.edit', ['stores' => $stores, 'Store' => $Store]);
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
        // Gate::authorize('stores.update');

        $request->validate(Store::validateRule($id));
        $Store = Store::find($id);

        #Method 4 : Mass assignment
        $request->merge([
            'slug' => Str::slug($request->get('name')) . '-2',
        ]);

        $input = $request->all();
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('uploads', 'public');
            $input['image'] = $image_path;
        }
        $Store->update($input);



        return redirect()->route('stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Store = Store::findorFail($id);
        $Store->delete();
        return redirect()->back();
    }

    public function DeleteAllSelectedStore(Request $request)
    {

        $delete_all_id = explode(",", $request->delete_all_id);
        Store::whereIn('id', $delete_all_id)->Delete();

        return redirect()->back();
    }
}
