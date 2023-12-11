<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAdminResquest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list(){
        $admins = User::orderBy('id','desc')->where('id_admin','=',1)->get();
        $data['header_title']='Admin';
        return view('admin.admin.list',$data,['admins'=>$admins]);
    }

    public function add(){
        $user = new User();
        $data['header_title']='Add new admin';
        return view('admin.admin.add',$data,['user'=>$user]);
    }

    public function store(Request $request){
       
        $user = new User();

        $request->validate([
            'name'=>'required|string|min:2',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:4|max:8',
            'status'=>'required|numeric'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->id_admin = 1;
        $user->status = $request->status;

        $user->save();
         return redirect('admin/admin/list')->with('success',"Admin successfully created.");
    }

    public function modify(User $user){

        $data['header_title']="Modify Admin";

        return view('admin.admin.add',['user'=>$user],$data);
    }

    public function update(User $user,Request $request){

        $validated = $request->validate([
            'name'=>'required|string|min:2',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:4|max:8',
            'status'=>'required|numeric'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($user->password)){
        $user->password = Hash::make($request->password);
        }
        $user->id_admin = 1;
        $user->status = $request->status;

        $user->save();
         return redirect('admin/admin/list')->with('success',"Admin successfully updated.");
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->back()->with('success',"Admin successfully deleted.");
    }
}
