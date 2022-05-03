<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;


class StudentsController extends Controller
{
	public function addStudent()
	{
		return view('add-student');
	}
	public function createStudent(Request $request)
	{
		Request()->validate([
			'name' => 'required',
			'email' => 'required|email|unique:students,email',
			'phone' => 'required|unique:students,phone',
			'address' => 'required',
			'foto' => 'required|mimes:jpg,jpeg,png|max:1024',
		],[
			'name.required' => 'Nama Lengkap wajib diisi',
			'email.required' => 'Email wajib diisi',
			'email.unique' => 'Email ini sudah terdaftar, silahkan pakai E-mail Lain !',
			'phone.required' => 'Nomor Hp Wajib Diisi',
			'phone.unique' => 'Nomor Hp ini sudah terdaftar, silahkan pakai Nomor Hp Lain !',
			'address.required' => 'Alamat Wajib Diisi',
			'foto.required' => 'Silahkan Upload Foto',
			'foto.mimes' => 'Type file harus JPG,Jpeg, dan png',
		]);
		//upload foto
		$image = Request()->foto;
		$imageName = time().'.'.$image->extension();
		$image->move(public_path('foto'),$imageName);

		$student = new Students();
		$student->name = $request->name;
		$student->email = $request->email;
		$student->phone = $request->phone;
		$student->address = $request->address;
		$student->foto = $imageName;

		$student->save();
		return redirect()->route('student')->with('message','Student Has Been Created Successfully !!');
	}
	public function getStudent()
	{
		$student = Students::orderBy('id','DESC')->get();
		return view('student',compact('student'));
	}
	public function deleteStudent($id)
	{

		$student = Students::findOrFail($id);
		// Hapus Data Student dengan manghapus Foto di folder Publik
		$image_path = public_path('foto').'/'.$student->foto;
		unlink($image_path);
		$student->delete();
		return redirect()->route('student')->with('message','Student Has Been Created Successfully !!');
		
	}
	public function UpdateStudent(Request $request)
	{
		Request()->validate([
			'foto' => 'mimes:jpg,jpeg,png|max:1024',
		],[
			'foto.mimes' => 'Type file harus JPG,Jpeg, dan png',
		]);
		$student = Students::find($request->id);
		$student->name = $request->name;
		$student->email = $request->email;
		$student->phone = $request->phone;
		$student->address = $request->address;

		// Kalau Mau Update Foto
		if (Request()->foto<>"") {
			$image = Request()->foto;
			$imageName = time().'.'.$image->extension();
			if (file_exists('foto/' . $student->foto)) {
				unlink('foto/' . $student->foto);
			}

			$image->move(public_path('foto'),$imageName);
			$student->foto = $imageName;

			$student->save();

		}else {
			// Kalau Tidak Mau Update Foto
			$student = Students::find($request->id);
			$student->name = $request->name;
			$student->email = $request->email;
			$student->phone = $request->phone;
			$student->address = $request->address;

			$student->save();
		}
		
		return redirect()->route('student')->with('message','Student Has Been Edit Successfully !!');
	}
}
