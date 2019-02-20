<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\StudentRequest;
use App\Traits\FileUploader;
use App\User;
use App\Profile;
use App\Address;
use App\Geolocation;
use App\Contact;

class StudentController extends Controller
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
            $students = User::where('role_id', 3)->where('name', 'like', '%'.request('search').'%')
            ->orWhere('email', 'like', '%'.request('search').'%')->sortable()->paginate(10);
        } else {
            $students = User::where('role_id', 3)->sortable(['id' => 'desc'])->paginate(10);
        }
        
        return view('admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $user = User::create([
            'name' => $request->student_name,
            'email' => $request->student_email,
            'password' => bcrypt($request->student_password),
            'role_id' => 3,
            'is_active' => true
        ]);

        //profile
        $profile = Profile::create([
            'user_id' => $user->id,
            'sex' => $request->student_sex,
            'birth_place' => $request->student_birth_place,
            'birth_date' => Carbon::createFromFormat('d/m/Y', $request->student_birth_date)->toDateString(),
        ]);

        //upload image
        $filename = $this->uploadImage($request->file('student_image'), $user->email, 'student');
        $profile->image = $filename;
        $profile->save();

        //address
        $address = Address::create([
            'user_id' => $user->id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->student_address,
            'postal_code' => $request->student_postal_code,
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
            'phone_number' => $request->student_phone_number,
            'wa_number' => $request->student_wa_number,
            'facebook_url' => $request->student_facebook_url,
            'instagram_url' => $request->student_instagram_url
        ]);

        return redirect('admin/student')->with('success', 'Berhasil tambah Siswa');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('admin.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, User $student)
    {

        $student->name = $request->student_name;
        $student->email = $request->student_email;
        $student->save();

        //profile
        $student->profile->sex = $request->student_sex;
        $student->profile->birth_place = $request->student_birth_place;
        $student->profile->birth_date = Carbon::createFromFormat('d/m/Y', $request->student_birth_date)->toDateString();
        $student->profile->save();

        if ($request->hasFile('student_image')) {
            $this->deleteOldImage('student', $student->profile->image);
            //upload image
            $filename = $this->uploadImage($request->file('student_image'), $student->email, 'student');
            $student->profile->image = $filename;
            $student->profile->save();
        }

        //address
        $student->address->province_id = $request->province_id;
        $student->address->city_id = $request->city_id;
        $student->address->address = $request->student_address;
        $student->address->postal_code = $request->student_postal_code;
        $student->address->save();

        //geolocation
        $student->geolocation->latitude = $request->latitude;
        $student->geolocation->longitude = $request->longitude;
        $student->geolocation->save();

        //contact
        $student->contact->phone_number = $request->student_phone_number;
        $student->contact->wa_number = $request->student_wa_number;
        $student->contact->facebook_url = $request->student_facebook_url;
        $student->contact->instagram_url = $request->student_instagram_url;
        $student->contact->save();

        return back()->with('success', 'Berhasil perbarui Siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        // delete image profile
        $this->deleteOldImage('student', $student->profile->image);

        //delete teacher
        $student->delete();
        return redirect('/admin/student')->with('success', 'Berhasil hapus Siswa');
    }
}
