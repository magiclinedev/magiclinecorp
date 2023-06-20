<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
class CategoryController extends Controller
{
    function categories(){
        $categories = Category::whereNull('archived')->get();
        return view('category',compact('categories'));
    }
    function addcategory(){
        return view('addcategory');
    }
    function storecateg(Request $request){
        if($request->category){
            $request->validate([
                'category' => 'required|string',
            ]);
            $category = new Category;
            $loggeduser = session()->get('LoggedUser');
            $user = User::find($loggeduser);
            $category->category = $request->input('category');
            $category->addedby = $user->username;
            $category->save();
            return redirect()->route('categories')->with('success','Category was successfully added!');
        } else{
            return back();
        }
    }
    function trashcateg(Request $request){
        if ($request->action == 'deletecateg') {
            foreach ($request->checkbox as $key => $type_id) {
                $type = Category::find($type_id)->delete();
            }
            return redirect('/admin/categories')->with('deleted','Type permanently deleted successfuly!');
        } else {
            return back();
        }
    }
}
