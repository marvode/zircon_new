<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function makeDefault(Request $request)
    {
        $this->validate($request, [
            'address_id' => 'required'
        ]);

        $user = Auth::user();
        $address = Address::find($request->address_id);

        if ($address->user_id != $user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user->update(['default_address_id' => $address->id]);

        return response()->json(['success' => 'Address updated successfully']);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $address = Address::find($id);
        $userAddress = $user->addresses();

        if ($address->user_id !=$user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if($address->id === $user->default_address_id ) {
            if($userAddress->count() > 1) {
                $user->update(['default_address_id' => $userAddress->latest()->first()->id]);
            }
            else {
                $user->update(['default_address_id' => null]);
            }
        }

        $address->delete();

        return response()->json(['success' => 'Address deleted successfully']);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);

        $user = Auth::user();
        $address = Address::find($request->address_id);

        if ($address->user_id !=$user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $address->update([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        $user->update(['default_address_id' => $address->id]);

        return response()->json(['success' => 'Address updated successfully']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'street' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
        ]);

        $address = Address::create([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'user_id' => Auth::id(),
        ]);

        Auth::user()->update(['default_address_id' => $address->id]);

        return response()->json(['success' => 'Address created successfully']);
    }
}
