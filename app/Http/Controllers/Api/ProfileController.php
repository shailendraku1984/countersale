<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\DB;
use App\Models\UserAddress;
use App\Models\User;

class ProfileController extends Controller
{


public function update(UpdateProfileRequest $request)
{
    $user = $request->user();

    DB::transaction(function () use ($request, $user) {

        /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Addresses
        |--------------------------------------------------------------------------
        */
		 

        foreach ($request->addresses as $address) {

            UserAddress::updateOrCreate(

                [
                    'user_id' => $user->id,
                    'type' => $address['type'],
                ],

                [
                    'full_name' => $address['full_name'],
                    'phone' => $address['phone'] ?? null,
                    'country' => $address['country'],
                    'state' => $address['state'],
                    'city' => $address['city'],
                    'zip_code' => $address['zip_code'],
                    'landmark' => $address['landmark'] ?? null,
                    'address_line_1' => $address['address_line_1'],
                    'address_line_2' => $address['address_line_2'] ?? null,
                    'is_default' => $address['is_default'] ?? false,
                ]
            );
        }
    });

    return response()->json([
        'status' => true,
        'message' => 'Profile updated successfully',
        'data' => $user->load('addresses'),
    ]);
}


}