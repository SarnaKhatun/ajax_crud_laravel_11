<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function addStudent(Request $request)
    {
        $file = $request->file('image');
        $fileName = time().''.$file->getClientOriginalName();
        $filePath = $file->storeAs('images', $fileName, 'public');

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->image = $filePath;
        $student->save();
        return response()->json(['res' => 'Student Created Successfully']);
    }

    public function getStudents()
    {
        $students = Student::all();
        return response()->json(['students' => $students]);

    }

    public function getStudentData($id)
    {
        $student = Student::where('id',$id)->get();
        return view('edit-user', compact('student'));
    }

    public function updateStudent(Request $request){
       $student = Student::find($request->id);
       $student->name = $request->name;
       $student->email = $request->email;
       if ($request->file('image')) {
           $file = $request->file('image');
           $fileName = time().''.$file->getClientOriginalName();
          $filePath = $file->storeAs('images', $fileName, 'public');
           $student->image = $filePath;
       }
       $student->save();
       return response()->json(['result' => 'Student Data Updated']);
    }

    public function deleteData($id)
    {
        Student::where('id', $id)->delete();
        return response()->json(['result' =>'Student Data Deleted Successfully']);
    }
}
