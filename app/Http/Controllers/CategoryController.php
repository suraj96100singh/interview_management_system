<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $collection = collect(['taylor', 'abigail',null])->map(function (string $name) {
        //     return strtoupper($name);
        // })->reject(function (string $name) {
        //     return empty($name);
        // });
        
        $department_data=Category::with('user')->orderBy('id','desc')->get();
        
        $items=User::all();
        // dd($department_data);
        return view('categories.ShowCategories',compact('department_data','items'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $items=User::all();
        // return view('categories.ShowCategories',compact('items'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate(
        //     [
        //         'Department_Name'=>'regex:/^[\pL\s\-]+$/u|max:50',
        //         'Head_of_Department'=>'required',
        //         'Department_Email'=>'required',
        //         'Department_Phone_Number'=>'required|digits:10',
        //         'Department_Working_Hours'=>'required',
        //         'Department_Status'=>'required',
        //         'Department_Image'=>'required'
        //     ]
        // );

        // return response()->json(["sdfdsf"]);
        
       
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'Department_Name'=>'regex:/^[\pL\s\-]+$/u|max:50',
            'Head_of_Department'=>'required',
            'Department_Email'=>'required',
            'Department_Phone_Number'=>'required|digits:10',
            'Department_Working_Hours'=>'required',
            'Department_Status'=>'required'
            // 'Department_Image'=>'required'
                   ]);
                //    dd($validator);
// --------------------------------------------------------
     if($validator->validate()){  
       
            if($request->hasFile('Department_Image')){
                // Get filename with the extension
                $filenameWithExt = $request->file('Department_Image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('Department_Image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('Department_Image')->storeAs('public', $fileNameToStore);
            } else {
                $fileNameToStore = 'no_image.png';
            }
        //         //    ------------------------dushratarika---
                // if($validator->fails()){
                //     return response()->json([
                //         'status'=>400,
                //         "errors"=>$validator->messages(),
                       
                //     ]);
                // }else{
                //     $category= new Category();
                //     $category->department_name=$request->input('Department_Name');
                //     $category->head_of_department =$request->input('Head_of_Department');
                //     $category->department_email=$request->input('Department_Email');
                //     $category->department_phone_number=$request->input('Department_Phone_Number');
                //     $category->department_address=$request->input('Department_Address');
                //     $category->department_working_hours=$request->input('Department_Working_Hours');
                //     $category->shift_start_time=$request->input('shift_start_time');
                //     $category->shift_end_time=$request->input('shift_end_time');
                //     $category->department_status=$request->input('Department_Status');
                //     $category->department_image=$request->input('Department_Image');
                //     $category->save();
                //     return response()->json([
                //         'status'=>200,
                //         'messages'=>'Added successfuylly',
                //     ]);
                //     $request->session()->flash('msg','Data Added Successfully');
                //     return redirect('categories');

                // }

                //------------------dushratrika-----
        
      
               

                    // // --------------------------------------------------------
                    $category= new Category();
                    $category->department_name=$request->Department_Name;
                    $category->head_of_department =$request->Head_of_Department;
                    $category->department_email=$request->Department_Email;
                    $category->department_phone_number=$request->Department_Phone_Number;
                    $category->department_address=$request->Department_Address;
                    // dd($category);
                    $category->department_working_hours=$request->Department_Working_Hours;
                    $category->shift_start_time=$request->shift_start_time;
                    $category->shift_end_time=$request->shift_end_time;
                    $category->department_status=$request->Department_Status;
                    $category->department_image=$fileNameToStore;
                    // dd($category);
                    $category->save();
                    $request->session()->flash('msg','Data Added Successfully');
                    return redirect('categories');
           
           
           }else{
             //db inserstion

             return redirect('/categories')->withErrors($validator)->withInput();
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $items=User::all();
        // dd($items);
        $category=Category::find($id);
        if($category){
            return response()->json([
                'status'=>200,
                'category'=>$category,
    
    
            ]);
           
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'Department Not Found',
    
    
            ]);
            

        }
        
            // return view('categories.ShowCategories',compact('category'));

      
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request->Department_Status_on_index)){
            $category=Category::find($id);
            $category->department_status=$request->Department_Status_on_index;
            $category->save();
            $request->session()->flash('msg','Data Updated Successfully');
            return redirect('categories');
        }else{
            $validator = Validator::make($request->all(),[
            'Department_Name'=>'regex:/^[\pL\s\-]+$/u|max:50',
            'Department_Email'=>'required',
            'Department_Phone_Number'=>'required|digits:10'
           ]);
           $main=Category::find($id);
           if($validator->validate()){
            if($request->hasFile('Department_Image')){
                
                if($main->department_image=='no_image.png'){
                $filenameWithExt = $request->file('Department_Image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('Department_Image')->getClientOriginalExtension();
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $path = $request->file('Department_Image')->storeAs('public',$fileNameToStore);

                }else{
                unlink('storage/'.$main->department_image);
                $filenameWithExt = $request->file('Department_Image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('Department_Image')->getClientOriginalExtension();
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $path = $request->file('Department_Image')->storeAs('public',$fileNameToStore); 
                // dd($path);

                }
                
            } else {
                if($main->department_image=='no_image.png'){
                $fileNameToStore = 'no_image.png';
                }else{
                    unlink('storage/'.$main->department_image);
                    $fileNameToStore = 'no_image.png';

                }
            }
                    // --------------------------------------------------------
                    $category=Category::find($id);
                    $category->department_name=$request->Department_Name;
                    $category->head_of_department =$request->Head_of_Department;
                    $category->department_email=$request->Department_Email;
                    $category->department_phone_number=$request->Department_Phone_Number;
                    $category->department_address=$request->Department_Address;
                    // dd($category);
                    $category->department_working_hours=$request->Department_Working_Hours;
                    $category->shift_start_time=$request->shift_start_time;
                    $category->shift_end_time=$request->shift_end_time;
                    $category->department_status=$request->Department_Status;
                    $category->department_image=$fileNameToStore;
                    // dd($category);
                    $category->update();
                    $request->session()->flash('msg','Data Updated Successfully');
                    return redirect('categories');
           
           
           }else{
             //db inserstion
             return redirect('/categories')->withErrors($validator)->withInput();
           }
        }
        //    ------------------------------------forbutton
           

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        if(!$id){
            $request->session()->flash('errormsg','Record not Found');
            return redirect('employee');
        }
        else{
            $post =Category::where('id',$id)->first();
            $post->delete();
            


        }
        $request->session()->flash('errormsg','Data deleted Successfully');
            return redirect('categories');
    }
    // public function changestatus($id){
    //     $category=Category::find($id);
    //     // $category->department_status=$request->Department_Status;
    //     dd($category);


    // }
  
}
