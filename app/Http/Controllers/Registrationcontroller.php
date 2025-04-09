<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\State;
use App\Models\City;
use DB;


class Registrationcontroller extends Controller
{
    public function index()
    {
        $states = State::all();
        return view("form",compact('states'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:studentdata',
            'password' => 'required',
            'number' => 'required|numeric',
            'gender' => 'required',
            'city' => 'required|string',
            'state_id' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
     
        $imageName = null;
    if ($request->hasFile('profile_photo')) {
        $image = $request->file('profile_photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
    }

    $student = Student::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'number' => $request->number,
        'gender' => $request->gender,
        'city' => $request->city,
        'state_id' => $request->state_id,
        'profile_photo' => $imageName,
    ]);

    Mail::to($request->email)->send(new SendEmail($student));

    return redirect('/records')->with('success', 'Registration successful!');
}


public function variable_data(Request $request)
{
    $imageName = null;
    if ($request->hasFile('profile_photo')) {
        $image = $request->file('profile_photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
    }

    Student::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'number' => $request->number,
        'gender' => $request->gender,
        'city' => $request->city,
        'state_id' => $request->state_id,
        'profile_photo' => $imageName,
    ]);


    return redirect('/records')->with('success', 'Student registered successfully!');
}


    public function records()
 {
      $records = Student::select('studentdata.*','states.name as st_name','cities.name as ct_name')
                        ->join('states','states.id','=','studentdata.state_id')
                        ->join('cities','cities.id','=','studentdata.city')
                        ->orderBy('id', 'DESC')->paginate(10);
    return view('records', compact('records'));

 }

 public function delete_record($id)
 {
     Student::destroy($id);
     return back();
 }

 public function edit_record($id)
 {
     $data = Student::find($id);
     return view('edit_form', compact('data'));
 }
 
 public function update_data(Request $request, $id)
{
    $data = Student::find($id);

    if (!$data) {
        return redirect('/records')->with('error', 'Student not found!');
    }

    $imageName = $data->profile_photo;
    if ($request->hasFile('profile_photo')) {
        $image = $request->file('profile_photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
    }

    $data->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'number' => $request->number,
        'gender' => $request->gender,
        'city' => $request->city,
        'state_id' => $request->state_id,
        'profile_photo' => $imageName,
    ]);

    return redirect('/records')->with('success', 'Student updated successfully!');
}   
  

 public function toggle_status($id) 
{
    $student = Student::findOrFail($id);
    $student->status = $student->status == 1 ? 0 : 1;
    $student->save();

    return redirect()->route('records')->with('success', 'Status updated successfully.');
}
 
public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);

 
    }
 

    public function recodes()
    {
        $records = Student::all(); 
        return view('recodes', compact('records'));

    }
    
    
}


