<?php
namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Price;
use App\Models\Product;
use App\Models\TemporaryFile;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    function products(Request $request){
        session()->forget('folder');
        $selected = '';
        $selected_comp = '';
        if ($request->categ_filter) {
            $selected = $request->categ_filter;
            $selected_comp = $request->comp_filter;
            if ($selected && $selected_comp) {
                $products = Product::where('category','=',$selected)->where('company','=',$selected_comp)->whereNull('archived')->get();
            } else {
                $products = Product::where('category','=',$selected)->whereNull('archived')->get();
            }
        } else{
            $products = Product::whereNull('archived')->get();;
        }
        
        return view('products',compact('products','selected','selected_comp'));
    }
    function partnerproduct(Request $request, $company){
        session()->forget('folder');
        $company = $company;
        $selected = '';
        if ($request->categ_filter) {
            $selected = $request->categ_filter;
            $products = Product::where('company','=',strtoupper($company))->where('category','=',$request->categ_filter)->whereNull('archived')->get();
        } else{
        $products = Product::where('company','=',strtoupper($company))->whereNull('archived')->get();
        }
        return view('partnerproduct',compact('products','company','selected'));
        
    }
    function addproducts(Request $request){
        session()->forget('folder');
        $company = $request->company;
       return view('addproducts',compact('company'));
    }
    function editproducts($id){
        session()->forget('folder');
        $product = Product::find($id);
        return view('editproducts',compact('product'));
    }
    function trashproduct(Request $request){
        $company = $request->company;
       return view('trashproduct',compact('company'));
    }
    function product_detail(Request $request){
        $id = $request->id;
       if(isset($id)){
        $products = Product::find($id);
        return view('product_detail',compact('products'));
       } else {
        return back();
       }
    }
    function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'po' => 'nullable|unique:products',
            'itemref' => 'required|unique:products',
            'company' => 'required|string',
            'category' => 'required|string',
            'type' => 'required|string',
            'price' => 'nullable|string',
            'description' => 'required',
            'images.*' => 'required|mimes:jpeg,png,jpg|max:50000',
            'costing' => 'nullable|mimes:xls,xlsx|max:50000',
            'pdf' => 'nullable|mimes:pdf|max:50000',
            'priceaccess' => 'nullable',
        ]);

        $LoggedUser = session()->get('LoggedUser');
        $userdata = User::find($LoggedUser);
        $images = [];
        $tmp_folder = session()->get('folder');
        //$temporaryImages = TemporaryFile::all();
        if ($validatedData->fails()) {
            
            foreach ($tmp_folder as $folder) {
                
                $temporaryImages = TemporaryFile::where('folder',$folder)->get();
                foreach ($temporaryImages as $temporaryImage) {
                    Storage::deleteDirectory('public/tmp/' . $temporaryImage->folder);
                    $temporaryImage->delete();
                }
            }
            session()->forget('folder');
            return back()->withErrors($validatedData)->withInput();
        }
        foreach ($tmp_folder as $key => $folder) {
            $temporaryImages = TemporaryFile::where('folder',$folder)->get();
            foreach ($temporaryImages as $temporaryImage) {
                Storage::copy('public/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->file, 'public/product_images/'. $temporaryImage->file);
                $images[] = $temporaryImage->file;
                Storage::deleteDirectory('public/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }
        }
        sort($images);
        $pdfname = null;
        $costingname = null;
        $threedfname = null;
        if (!empty($request->file('costing'))) {
            $costingname = $request->file('costing')->getClientOriginalName();
            $filepath = $request->file('costing')->storeAS('public/product_files',$costingname);
        }
        if (!empty($request->file('pdf'))) {
            $pdfname = $request->file('pdf')->getClientOriginalName();
            $filepath = $request->file('pdf')->storeAS('public/product_pdfs',$pdfname);
            if (!empty($request->file('costing'))) {
                $costingname = $request->file('costing')->getClientOriginalName();
                $filepath = $request->file('costing')->storeAS('public/product_files',$costingname);
            }
        }
        $product = Product::create([
            'po' => $request->input('po'),
            'itemref' => $request->input('itemref'),
            'company' => $request->input('company'),
            'category' => $request->input('category'),
            'type' => $request->input('type'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'images' => implode(",",$images),
            'file' => $costingname,
            'pdf' => $pdfname,
            '3df' =>  $threedfname,
            'addedby' => $userdata->username,
        ]);
        if(isset($request->priceaccess)){
        foreach ($request->priceaccess as $access) {
            $price = Price::create([
                'itemref' => $request->input('itemref'),
                'user_id' => $access,
            ]);
        }
        }
        
        session()->forget('folder');
        return redirect('/admin/partnerproduct/'.strtolower($request->input('company')))->with('success','Product Added Successfully');
    }
    
    function storeupdateproducts(Request $request){
        $validatedData = Validator::make($request->all(),[
            'po' => 'nullable',
            'itemref' => 'required',
            'company' => 'required|string',
            'category' => 'required|string',
            'price' => 'nullable|string',
            'type' => 'required|string',
            'description' => 'required',
            'images.*' => 'required|mimes:jpeg,png,jpg|max:50000',
            'costing' => 'nullable|mimes:xls,xlsx|max:50000',
            'pdf' => 'nullable|mimes:pdf|max:50000',
            'priceaccess' => 'nullable',
        ]);

        $LoggedUser = session()->get('LoggedUser');
        $userdata = User::find($LoggedUser);
        $images = [];
        $tmp_folder = session()->get('folder');
        //$temporaryImages = TemporaryFile::all();
        if ($validatedData->fails()) {
            foreach ($tmp_folder as $folder) {
                $temporaryImages = TemporaryFile::where('folder',$folder)->get();
                foreach ($temporaryImages as $temporaryImage) {
                    Storage::deleteDirectory('public/tmp/' . $temporaryImage->folder);
                    $temporaryImage->delete();
                }
            }
            session()->forget('folder');
            return back()->withErrors($validatedData)->withInput();
        }
        $checks = DB::table('products')->where('po','=',$request->po)->get();
        $checks2 = DB::table('products')->where('itemref','=',$request->itemref)->get();
        foreach ($checks as $check) {
            $check_id = $check->id;
        }
        foreach ($checks2 as $check2) {
            $check_id2 = $check2->id;
        }
        if(!isset($check_id)){ $check_id = $request->id;}
        if(!isset($check_id2)){ $check_id2 = $request->id;}
        if (!empty($request->po)) {
            if ($request->id != $check_id) {
                foreach ($tmp_folder as $folder) {
                    $temporaryImages = TemporaryFile::where('folder',$folder)->get();
                    foreach ($temporaryImages as $temporaryImage) {
                        Storage::deleteDirectory('public/tmp/' . $temporaryImage->folder);
                        $temporaryImage->delete();
                    }
                }
                session()->forget('folder');
                return back()->with('fail','PO is already taken by other product');
            }
        }
        if ($request->id != $check_id2) {
            foreach ($tmp_folder as $folder) {
                $temporaryImages = TemporaryFile::where('folder',$folder)->get();
                foreach ($temporaryImages as $temporaryImage) {
                    Storage::deleteDirectory('public/tmp/' . $temporaryImage->folder);
                    $temporaryImage->delete();
                }
            }
            session()->forget('folder');
            return back()->with('fail','Item Reference is already taken by other product');
        } 
        else {
            $LoggedUser = session()->get('LoggedUser');
            $userdata = User::find($LoggedUser);
            $images = [];

            if($request->old_costing != null){
                $costingname =$request->old_costing;
            } else {
                $costingname = null;
            }
            if($request->old_pdf != null){
                $pdfname =$request->old_pdf;
            } else {
                $pdfname = null;
            }
        
            foreach ($tmp_folder as $folder) {
                $temporaryImages = TemporaryFile::where('folder',$folder)->get();
                foreach ($temporaryImages as $temporaryImage) {
                    Storage::copy('public/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->file, 'public/product_images/'. $temporaryImage->file);
                    $images[] = $temporaryImage->file;
                    Storage::deleteDirectory('public/tmp/' . $temporaryImage->folder);
                    $temporaryImage->delete();
                }
            }
            if (!empty($request->file('costing'))) {
                $costingname = $request->file('costing')->getClientOriginalName();
                $filepath = $request->file('costing')->storeAS('public/product_files',$costingname);
            }
            if (!empty($request->file('pdf'))) {
                $pdfname = $request->file('pdf')->getClientOriginalName();
                $filepath = $request->file('pdf')->storeAS('public/product_pdfs',$pdfname);
            }
        if($images){
            $product = Product::whereId($request->id)->update([
                'po' => $request->input('po'),
                'itemref' => $request->input('itemref'),
                'company' => $request->input('company'),
                'category' => $request->input('category'),
                'type' => $request->input('type'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'images' => implode(",",$images),
                'file' => $costingname,
                'pdf' => $pdfname,
                'updatedby' => $userdata->username,
            ]);
            
            $checkprice = Price::where('itemref','=',$request->input('itemref'))->get();
            $priceaccess = [];
            if(count($checkprice)==0){
                if ($request->priceaccess) {
                    foreach ($request->priceaccess as $access) {
                        $priceaccess[]=$access;
                    }
                    $price = Price::create([
                        'itemref' => $request->input('itemref'),
                        'user_id' => implode(',',$priceaccess),
                    ]);
                }
            } else{
                if ($request->priceaccess) {
                foreach ($request->priceaccess as $access) {
                    $priceaccess[]=$access;
                }
                $price = Price::where('itemref','=',$request->input('itemref'))->update([
                    'itemref' => $request->input('itemref'),
                    'user_id' => implode(',',$priceaccess),
                ]);
                }
            }
        } else {
            $product = Product::whereId($request->id)->update([
                'po' => $request->input('po'),
                'itemref' => $request->input('itemref'),
                'company' => $request->input('company'),
                'category' => $request->input('category'),
                'type' => $request->input('type'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'file' => $costingname,
                'pdf' => $pdfname,
                'updatedby' => $userdata->username,
            ]);
            $checkprice = Price::where('itemref','=',$request->input('itemref'))->get();
            $priceaccess = [];
            if(!empty($request->priceaccess)){
                if(count($checkprice)==0){
                    foreach ($request->priceaccess as $access) {
                        $priceaccess[]=$access;
                    }
                    $price = Price::create([
                        'itemref' => $request->input('itemref'),
                        'user_id' => implode(',',$priceaccess),
                    ]);
                } else{
                    foreach ($request->priceaccess as $access) {
                        $priceaccess[]=$access;
                    }
                    $price = Price::where('itemref','=',$request->input('itemref'))->update([
                        'itemref' => $request->input('itemref'),
                        'user_id' => implode(',',$priceaccess),
                    ]);
                }
            } else {
                if(count($checkprice)==0){
                    $price = Price::create([
                        'itemref' => $request->input('itemref'),
                        'user_id' => null,
                    ]);
                } else{
                    $price = Price::where('itemref','=',$request->input('itemref'))->update([
                        'itemref' => $request->input('itemref'),
                        'user_id' => null,
                    ]);
                }
            }
        }
        
        return redirect('/admin/partnerproduct/'.strtolower($request->input('company')))->with('success','Updated Product Infomations Sucessfully!');
        }
    }
    function trash(Request $request){
        if (isset($request->actions)) {
            if (isset($request->checkbox)) {
                foreach ($request->checkbox as $key => $id) {
                    $product = Product::whereId($id)->update([
                        'archived' => 1,
                    ]);
                }
                return redirect('/admin/partnerproduct/'.strtolower($request->company))->with('deleted','Product transfered to trash successfully!!');
            }
            else {
                return back();
            }
        } elseif (isset($request->id)) {
            $product = Product::whereId($request->id)->update([
                'archived' => 1,
            ]);
            $product_data = Product::find($request->id);
            return redirect('/admin/partnerproduct/'.strtolower($product_data->company))->with('deleted','Product transfered to trash successfully!!');
        } else {
            return back();
        }
    }
    function trashaction(Request $request){
        if ($request->action == 'restoreproduct') {
            foreach ($request->checkbox as $key => $product_id) {
                $product = Product::whereId($product_id)->update([
                    'archived' => null,
                ]);
            }
            return redirect('/admin/trashproduct')->with('success','Product restored sucessfully!');
        } elseif ($request->action == 'deleteproduct') {
            foreach ($request->checkbox as $key => $product_id) {
                $product = Product::find($product_id)->delete();
            }
            return redirect('/admin/trashproduct')->with('deleted','Product permanently deleted successfuly!');
        } else {
            return back();
        }
        
    }
    function duplicateproduct(Request $request){
        $product = Product::find($request->id);
        $products = Product::create([
            'po' => $product->po,
            'itemref' => $product->itemref,
            'company' => $product->company,
            'category' => $product->category,
            'type' => $product->type,
            'price' => $product->price,
            'description' => $product->description,
            'images' => $product->images,
            'file' => $product->filefile,
            'pdf' => $product->pdf,
            'addedby' => $product->addedby,
            'updatedby' => $product->updatedby,
        ]);
        return redirect('/admin/partnerproduct/'.strtolower($product->company))->with('success','Product duplicated successfully!!');
    }
    function restoreproduct(Request $request){
        if(isset($request->id)){
            $product = Product::whereId($request->id)->update([
                'archived' => null,
            ]);
            if($product){
                return redirect('/admin/trashproduct')->with('success','Product restored sucessfully!');
            }
        } else {
            return back();
        }
    }
    function deleteproduct(Request $request){
        if(isset($request->id)){
            $product = Product::find($request->id)->delete();
            if($product){
                return redirect('/admin/trashproduct')->with('deleted','Product permanently deleted successfuly!');
            }
        } else {
            return back();
        }
    }
    function tmpUpload(Request $request){
        if ($request->hasFile('images')) {
            $folder = uniqid('product',true);
            $images = $request->file('images');
            $name = $images->getClientOriginalName();
            $path = $images->storeAs('public/tmp/'.$folder, $name);
            TemporaryFile::create([
                'folder' => $folder,
                'file' => $name,
            ]);
            return $folder;
        }
        return '';
        
    }
    function tmpDelete(Request $request){
        $temporaryImage = TemporaryFile::where('folder', request()->getContent())->first();

        if ($temporaryImage) {
            // Retrieve the full path of the temporary image folder
            $folderPath = storage_path('app/public/tmp/' . $temporaryImage->folder);

            // Delete the directory and its contents recursively
            if (is_dir($folderPath)) {
                $files = glob($folderPath . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                rmdir($folderPath);
            }

            // Delete the temporary image record from the database
            $temporaryImage->delete();
        }

        return response('');
    }
    function genproductpdf(Request $request){
        $product = Product::find($request->id);
        return view('product-pdf',compact('product'));
    }
}
