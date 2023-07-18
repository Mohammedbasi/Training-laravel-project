<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $vendors = Vendor::with('address')->filter($request->query())->paginate(5);
        return view('dashboard.vendors.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        $vendor = Vendor::create($request->all())->save();
        return redirect()->route('vendors.index')->with('success', 'Vendor Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $vendor = Vendor::findOrFail($id);
        }catch (Exception $e){
            return redirect()->route('vendors.index')->with('info', 'Page not found . . .');
        }
        return view('dashboard.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor Updated . . .');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Vendor Deleted . . .');
    }

    public function trash()
    {
        $vendors = Vendor::onlyTrashed()->paginate(10);
        return view('dashboard.vendors.softDelete', compact('vendors'));
    }

    public function restore(string $id)
    {
        $vendor = Vendor::onlyTrashed()->findOrFail($id);
        $vendor->restore();
        return redirect()->route('vendors.trash')->with('success', 'Vendor restored!');
    }

    public function forceDelete(string $id)
    {
        $vendor = Vendor::onlyTrashed()->findOrFail($id);
        $vendor->forceDelete();
        return redirect()->route('vendors.trash')->with('success', 'Vendors deleted forever!');
    }
}
