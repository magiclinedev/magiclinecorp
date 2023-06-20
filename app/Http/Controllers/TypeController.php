<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\User;
class TypeController extends Controller
{
    function types(){
        $types = Type::whereNull('archived')->get();
        return view('type',compact('types'));
    }
    function addtype(){
        return view('addtype');
    }
    function storetype(Request $request){
        if($request->type){
            $request->validate([
                'type' => 'required|string',
            ]);
            $type = new Type;
            $loggeduser = session()->get('LoggedUser');
            $user = User::find($loggeduser);
            $type->type = $request->input('type');
            $type->addedby = $user->username;
            $type->save();
            return redirect()->route('types')->with('success','Type was successfully added!');
        } else{
            return back();
        }
    }
    function trashtype(Request $request){
        if ($request->action == 'deletetype') {
            foreach ($request->checkbox as $key => $type_id) {
                $type = Type::find($type_id)->delete();
            }
            return redirect('/admin/types')->with('deleted','Type permanently deleted successfuly!');
        } else {
            return back();
        }
    }
}
