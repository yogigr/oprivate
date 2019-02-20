<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Traits\FileUploader;
use Validator;
use App\Profile;
use App\Address;
use App\Geolocation;
use App\Contact;

class ProfileController extends Controller
{
    use FileUploader;

    public function index()
    {
    	$user = Auth::user();
    	return view('profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|string',
            'email' => 'required|string|unique:users,email,'.$user->id,
    		'sex' => 'required',
            'birth_place' => 'required|string',
            'birth_date' => 'required',
            'about' => 'required|string',
            'image' => 'image|mimes:jpeg|max:200'
    	]);

    	if ($validator->fails()) {
    		return redirect('student/profile#profile')
    		->withErrors($validator)->withInput();
    	}

    	$user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $profile = Profile::updateOrCreate(['user_id' => $user->id], [
            'sex' => $request->sex,
            'birth_place' => $request->birth_place,
            'birth_date' => Carbon::createFromFormat('d/m/Y', $request->birth_date)->toDateString(),
            'about' => $request->about
        ]);

        if ($request->hasFile('image')) {
            if ($user->profile) {
                $this->deleteOldImage('student', $user->profile->image);
            }
            //upload image
            $filename = $this->uploadImage($request->file('image'), $user->email, 'student');
            $profile->image = $filename;
            $profile->save();
        }

        return redirect('student/profile#profile')->with('success', 'Berhasil update profile');
    }

    public function updateAddress(Request $request)
    {
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
    		'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required|string',
            'postal_code' => 'required',
    	]);

    	if ($validator->fails()) {
    		return redirect('/student/profile#address')
    		->withErrors($validator)->withInput();
    	}

    	//address
        Address::updateOrCreate(['user_id' => $user->id], [
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code
        ]);

        return redirect('student/profile#address')->with('success', 'Berhasil update alamat');
    }

    public function updateGeolocation(Request $request)
    {
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
    		'latitude' => 'required',
            'longitude' => 'required'
    	]);

    	if ($validator->fails()) {
    		return redirect('/student/profile#geolocation')
    		->withErrors($validator)->withInput();
    	}

        Geolocation::updateOrCreate(['user_id' => $user->id], [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return redirect('student/profile#geolocation')->with('success', 'Berhasil update lokasi');
    }

    public function updateContact(Request $request)
    {
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
    		'phone_number' => 'required',
            'wa_number' => 'required',
            'facebook_url' => 'required',
            'instagram_url' => 'required'
    	]);

    	if ($validator->fails()) {
    		return redirect('/student/profile#contact')
    		->withErrors($validator)->withInput();
    	}

        Contact::updateOrCreate(['user_id' => $user->id], [
            'phone_number' => $request->phone_number,
            'wa_number' => $request->wa_number,
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url
        ]);

        return redirect('student/profile#contact')->with('success', 'Berhasil update kontak');
    }

    public function changePassword(Request $request)
    {
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
    		'old_password' => [
                'required',
                function($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail($attribute.' is invalid');
                    }
                },
            ],
            'new_password' => 'required|string|min:6|confirmed'
    	]);

    	if ($validator->fails()) {
    		return redirect('/student/profile#changePassword')
    		->withErrors($validator)->withInput();
    	}

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect('student/profile#changePassword')->with('success', 'Berhasil ubah password');
    }
}
