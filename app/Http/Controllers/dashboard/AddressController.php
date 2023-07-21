<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Exception;


class AddressController extends Controller
{
    public function edit(string $id)
    {
        $cities = City::all();
        $request = request();
        if ($request->is('user/*')) {
            try {
                $role = User::findOrFail($id);
                $type = 'user';
            } catch (Exception $e) {
                return redirect()->route('user.index')->with('info', 'Page not found . . .');
            }

        } elseif ($request->is('vendors/*')) {
            try {
                $role = Vendor::findOrFail($id);
                $type = 'vendor';
            } catch (Exception $e) {
                return redirect()->route('vendors.index')->with('info', 'Page not found . . .');
            }

        }
        return view('dashboard.addresses.edit', compact('role', 'type', 'cities'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'city_id' => ['required'],
            'street' => ['required', 'string'],
            'phone' => ['required', 'string', 'min:9', 'max:15'],
            'district' => ['required', 'string'],
        ]);
        $userId = $request->route('user') ?? false;
        $vendorId = $request->route('vendor') ?? false;
        if ($userId) {
            $user = User::findOrFail($userId);
            $user->address->fill($request->all())->save();
            return redirect()->route('user.index')->with('success','Address Updated');
        } elseif ($vendorId) {
            $vendor = Vendor::findOrFail($vendorId);
            $vendor->address->fill($request->all())->save();
            return redirect()->route('vendors.index')->with('success','Address Updated');
        }
    }
}
