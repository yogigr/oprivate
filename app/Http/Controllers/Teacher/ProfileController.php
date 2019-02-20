<?php

namespace App\Http\Controllers\Teacher;

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
use App\Educational;
use App\Achievement;

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
    		return redirect('teacher/profile#profile')
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
                $this->deleteOldImage('teacher', $user->profile->image);
            }
            
            //upload image
            $filename = $this->uploadImage($request->file('image'), $user->email, 'teacher');
            $profile->image = $filename;
            $profile->save();
        }

        return redirect('teacher/profile#profile')->with('success', 'Berhasil update profile');
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
    		return redirect('/teacher/profile#address')
    		->withErrors($validator)->withInput();
    	}

        //address
        Address::updateOrCreate(['user_id' => $user->id], [
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code
        ]);

        return redirect('teacher/profile#address')->with('success', 'Berhasil update alamat');
    }

    public function updateGeolocation(Request $request)
    {
    	$user = Auth::user();
    	$validator = Validator::make($request->all(), [
    		'latitude' => 'required',
            'longitude' => 'required'
    	]);

    	if ($validator->fails()) {
    		return redirect('/teacher/profile#geolocation')
    		->withErrors($validator)->withInput();
    	}

    	Geolocation::updateOrCreate(['user_id' => $user->id], [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return redirect('teacher/profile#geolocation')->with('success', 'Berhasil update lokasi');
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
    		return redirect('/teacher/profile#contact')
    		->withErrors($validator)->withInput();
    	}

        Contact::updateOrCreate(['user_id' => $user->id], [
            'phone_number' => $request->phone_number,
            'wa_number' => $request->wa_number,
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url
        ]);

        return redirect('teacher/profile#contact')->with('success', 'Berhasil update kontak');
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
    		return redirect('/teacher/profile#changePassword')
    		->withErrors($validator)->withInput();
    	}

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect('teacher/profile#changePassword')->with('success', 'Berhasil ubah password');
    }

    public function educational(Request $request)
    {
    	$teacher = Auth::user();

    	$request->validate([
            'education_start_year' => 'required|digits:4',
            'education_end_year' => 'required|digits:4',
            'education_name' => 'required|string',
            'education_certificate_image' => 'required|image|mimes:jpeg|max:200'
        ]);

        $educational = Educational::create([
            'user_id' => $teacher->id,
            'start_year' => $request->education_start_year,
            'end_year' => $request->education_end_year,
            'name' => $request->education_name
        ]);

        //upload certificate
        $filename = $this->uploadImage($request->file('education_certificate_image'), $teacher->id . ' ' . $educational->id, 'certificate_edu');
        $educational->certificate_image = $filename;
        $educational->save();

        return response()->json([
            'educational' => $educational,
            'message' => 'Riwayat Pendidikan ditambahkan'
        ]);
    }

    public function updateEducational(Request $request, Educational $educational)
    {
    	$teacher = Auth::user();

    	$request->validate([
            'education_start_year' => 'required|digits:4',
            'education_end_year' => 'required|digits:4',
            'education_name' => 'required|string'
        ]);

        if ($request->hasFile('education_certificate_image')) {
            $request->validate([
                'education_certificate_image' => 'image|mimes:jpeg|max:200'
            ]);
        }

        $educational->start_year = $request->education_start_year;
        $educational->end_year = $request->education_end_year;
        $educational->name = $request->education_name;
        $educational->save();

        if ($request->hasFile('education_certificate_image')) {
            $this->deleteOldImage('certificate_edu', $educational->certificate_image);
            //upload certificate
            $filename = $this->uploadImage($request->file('education_certificate_image'), $teacher->id . ' ' . $educational->id, 'certificate_edu');
            $educational->certificate_image = $filename;
            $educational->save();
        }

        return response()->json([
            'educational' => $educational,
            'message' => 'Riwayat Pendidikan diperbarui'
        ]);
    }

    public function deleteEducational(Educational $educational)
    {
    	$this->deleteOldImage('certificate_edu', $educational->certificate_image);
        $educational->delete();
        return response()->json([
            'message' => 'Riwayat pendidikan dihapus'
        ]);
    }

    public function achievement(Request $request)
    {
    	$teacher = Auth::user();
    	$request->validate([
            'achievement_year' => 'required|digits:4',
            'achievement_name' => 'required|string',
            'achievement_certificate_image' => 'required|image|mimes:jpeg|max:200'
        ]);

        $achievement = Achievement::create([
            'user_id' => $teacher->id,
            'year' => $request->achievement_year,
            'name' => $request->achievement_name
        ]);

        //upload certificate
        $filename = $this->uploadImage($request->file('achievement_certificate_image'), $teacher->id . ' ' . $achievement->id, 'certificate_ach');
        $achievement->certificate_image = $filename;
        $achievement->save();

        return response()->json([
            'achievement' => $achievement,
            'message' => 'Penghargaan ditambahkan'
        ]);
    }

    public function updateAchievement(Request $request, Achievement $achievement)
    {
    	$teacher = Auth::user();

    	$request->validate([
            'achievement_year' => 'required|digits:4',
            'achievement_name' => 'required|string'
        ]);

        if ($request->hasFile('achievement_certificate_image')) {
            $request->validate([
                'achievement_certificate_image' => 'image|mimes:jpeg|max:200'
            ]);
        }

        $achievement->year = $request->achievement_year;
        $achievement->name = $request->achievement_name;
        $achievement->save();

        if ($request->hasFile('achievement_certificate_image')) {
            $this->deleteOldImage('certificate_ach', $achievement->certificate_image);
            //upload certificate
            $filename = $this->uploadImage($request->file('achievement_certificate_image'), $teacher->id . ' ' . $achievement->id, 'certificate_ach');
            $achievement->certificate_image = $filename;
            $achievement->save();
        }

        return response()->json([
            'achievement' => $achievement,
            'message' => 'Penghargaan diperbarui'
        ]);
    }

    public function deleteAchievement(Achievement $achievement)
    {
    	$this->deleteOldImage('certificate_ach', $achievement->certificate_image);
        $achievement->delete();
        return response()->json([
            'message' => 'Penghargaan dihapus'
        ]);
    }
}
