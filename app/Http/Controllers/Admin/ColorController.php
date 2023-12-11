<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{

    public function list(){

        $colors = Color::getColors();

        $data['header_title']='Color';
        return view('admin.color.list',$data,['colors'=>$colors]);
    }

    public function add(){

        $color = new Color();

        $data['header_title']='Add Color';

        return view('admin.color.add',$data,['color'=>$color]);
    }

    public function store(Request $request){
        //dd($request->brand);
        $name = trim($request->color);
        $color = new Color();
        $color->name = $name;
        $color->code = $request->code;
        $color->status = $request->status;

        $color->is_delete = 0;

        $color->created_by= Auth::user()->id;
        $color->save();

        return redirect('admin/color/list')->with('success',"Color successfully created.");;

    }

    public function modify(Color $color){

        $data['header_title']="Modify Color";

        return view('admin.color.add',['color'=>$color],$data);
    }

    public function update(Color $color,Request $request){

        $name = trim($request->color);
        $color->name = $name;
        $color->code = $request->code;
        $color->status = $request->status;

        $color->is_delete = 0;

        $color->created_by= Auth::user()->id;
        $color->save();

         return redirect('admin/color/list')->with('success',"Color successfully updated.");
    }

    public function destroy(Color $color){
        $color->delete();
        return redirect()->back()->with('success',"Color successfully deleted.");
    }
}
