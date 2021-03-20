<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        return view('license.create');
    }

    public function saveLicense(Request $request)
    {
        $user = User::find($request->client_id);
        $today = Carbon::today();
        $date = $today->addMonths($request->expire_date);
        $expire_date = $date->toDateString();
        if($user){
            if( ! $user->hasLicense($request->client_id) )
            {
                $user->license()->create([
                    'license_key' => $request->license_key,
                    'expire_date' => $expire_date
                ]);
                return view('license.data',[
                    'user' => $user->with('license')->first()
                ])->render();
            }else{
                return response()->json([
                    'error' => 'You have already a valid license key which expire date is '. $user->license->expire_date
                ]);
            }
        }
    }

    public function checkLicense()
    {
        return view('license.check');
    }
    
    public function checkLicenseValidity(Request $request)
    {   
        $user = User::find($request->client_id);
        if($user){
            if( $user->hasLicense($request->client_id) )
            {   
                if($request->license_key == $user->license->license_key)
                {
                    return response()->json([
                        'success' => 'Congratulations!'
                    ]);
                }else{
                    return response()->json([
                        'error' => 'Your license key not matched!'
                    ]);
                }
                
            }else{
                return response()->json([
                    'error' => 'You have no valid license key.'
                ]);
            }
        }
    }
}
