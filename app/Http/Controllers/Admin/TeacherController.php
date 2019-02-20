<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\TeacherRequest;
use App\Traits\FileUploader;
use App\User;
use App\Profile;
use App\Address;
use App\Geolocation;
use App\Contact;
use App\Educational;
use App\Achievement;

class TeacherController extends Controller
{
    use FileUploader;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $teachers = User::where('role_id', 2)->where('name', 'like', '%'.request('search').'%')
            ->orWhere('email', 'like', '%'.request('search').'%')->sortable()->paginate(10);
        } else {
            $teachers = User::where('role_id', 2)->sortable(['id' => 'desc'])->paginate(10);
        }
        
        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $user = User::create([
            'name' => $request->teacher_name,
            'email' => $request->teacher_email,
            'password' => bcrypt($request->teacher_password),
            'role_id' => 2
        ]);

        //profile
        $profile = Profile::create([
            'user_id' => $user->id,
            'sex' => $request->teacher_sex,
            'birth_place' => $request->teacher_birth_place,
            'birth_date' => Carbon::createFromFormat('d/m/Y', $request->teacher_birth_date)->toDateString(),
        ]);

        //upload image
        $filename = $this->uploadImage($request->file('teacher_image'), $user->email, 'teacher');
        $profile->image = $filename;
        $profile->save();

        //address
        $address = Address::create([
            'user_id' => $user->id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->teacher_address,
            'postal_code' => $request->teacher_postal_code,
        ]);

        //geolocation
        $geolocation = Geolocation::create([
            'user_id' => $user->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        //contact
        $contact = Contact::create([
            'user_id' => $user->id,
            'phone_number' => $request->teacher_phone_number,
            'wa_number' => $request->teacher_wa_number,
            'facebook_url' => $request->teacher_facebook_url,
            'instagram_url' => $request->teacher_instagram_url
        ]);

        return redirect('admin/teacher')->with('success', 'Berhasil tambah Guru');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teacher)
    {
        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, User $teacher)
    {
        if ($teacher->educationals()->count() < 1) {
           return back()->with('error', 'Anda belum mengisi riwayat pendidikan');
        }

        if ($teacher->achievements()->count() < 1) {
           return back()->with('error', 'Anda belum mengisi penghargaan');
        }

        $teacher->name = $request->teacher_name;
        $teacher->email = $request->teacher_email;
        $teacher->save();

        //profile
        $teacher->profile->sex = $request->teacher_sex;
        $teacher->profile->birth_place = $request->teacher_birth_place;
        $teacher->profile->birth_date = Carbon::createFromFormat('d/m/Y', $request->teacher_birth_date)->toDateString();
        $teacher->profile->save();

        if ($request->hasFile('teacher_image')) {
            $this->deleteOldImage('teacher', $teacher->profile->image);
            //upload image
            $filename = $this->uploadImage($request->file('teacher_image'), $teacher->email, 'teacher');
            $teacher->profile->image = $filename;
            $teacher->profile->save();
        }

        //address
        $teacher->address->province_id = $request->province_id;
        $teacher->address->city_id = $request->city_id;
        $teacher->address->address = $request->teacher_address;
        $teacher->address->postal_code = $request->teacher_postal_code;
        $teacher->address->save();

        //geolocation
        $teacher->geolocation->latitude = $request->latitude;
        $teacher->geolocation->longitude = $request->longitude;
        $teacher->geolocation->save();

        //contact
        $teacher->contact->phone_number = $request->teacher_phone_number;
        $teacher->contact->wa_number = $request->teacher_wa_number;
        $teacher->contact->facebook_url = $request->teacher_facebook_url;
        $teacher->contact->instagram_url = $request->teacher_instagram_url;
        $teacher->contact->save();

        return back()->with('success', 'Berhasil perbarui Guru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        // delete image profile
        $this->deleteOldImage('teacher', $teacher->profile->image);

        // delete certificate educational
        if ($teacher->educationals()->count() > 0) {
            foreach ($teacher->educationals as $edu) {
                $this->deleteOldImage('certificate_edu', $edu->certificate_image);
            }
        }

        //delete certificate achievements
        if ($teacher->achievements()->count() > 0) {
            foreach ($teacher->achievements as $ach) {
                $this->deleteOldImage('certificate_ach', $ach->certificate_image);
            }
        }

        //delete teacher
        $teacher->delete();
        return redirect('/admin/teacher')->with('success', 'Berhasil hapus Guru');
    }

    public function setActive(User $teacher)
    {
        $teacher->is_active = true;
        $teacher->save();
        return back()->with('success', 'Berhasil Aktifkan Guru');
    }

    public function setNonactive(User $teacher)
    {
        $teacher->is_active = false;
        $teacher->save();
        return back()->with('success', 'Berhasil Nonaktif Guru');
    }

    public function educational(Request $request, User $teacher)
    {
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

    public function updateEducational(Request $request, User $teacher, Educational $educational)
    {
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

    public function achievement(Request $request, User $teacher)
    {
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

    public function updateAchievement(Request $request, User $teacher, Achievement $achievement)
    {
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
