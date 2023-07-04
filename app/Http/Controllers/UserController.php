<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Category;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->ajax()){
        //     $data = User::latest()->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row) {   
        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        //                    return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);

        // }
        $users=User::with('roles')->orderBy('id','desc')->get();
        // dd($userall);
        $roles=User::with('roles')->get();
        // dd($roles);
        $department=User::with('department')->get();
        // dd($department);
        return view('users.index',compact('roles','department','users'));
        // dd($users);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users=User::all();
        $roles=Roles::all();
        $department=Category::all();
        // dd($department);
        return view('users.list',compact('roles','department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $validator = Validator::make($request->all(),[
            'user_name'=>'regex:/^[\pL\s\-]+$/u|max:50',
            'department'=>'required',
            'user_roles'=>'required',
            // 'user_email'=>'required',
            'user_email' => 'unique:users,email',
            // 'user_phone_number'=>'required|digits:10',
            'user_phone_number'=>'required|digits:10|unique:users,system_user_phone',
            'user_password'=>'required',
            'user_experience'=>'required',
            // 'Department_Image'=>'required'

                   ]);
                //    dd($validator);
                //    dd($validator);
// --------------------------------------------------------
        if($validator->validate()){  
            // dd($request->all());.
            // 'password' => Hash::make($data['password']),
            $users=new User();
            $users->name=$request->user_name;
            $users->email=$request->user_email;

            $users->password=Hash::make($request->user_password);
            // $users->password=$request->user_password;
            // $users->password=$request->user_password;
            $users->department_id =$request->department;
            $users->system_user_phone=$request->user_phone_number;
            $users->ststem_user_address=$request->user_address;
            $users->roles_id=$request->user_roles;
            $users->experience=$request->user_experience;
            $users->save();
            $request->session()->flash('msg','Data Added Successfully');
            return redirect('/users'); 
        }else{
             //db inserstion

             return redirect('/users')->withErrors($validator)->withInput();
         
        
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
    public function edit($id,Request $request)
    {
       
                    $department=User::with('department')->get();
                    $roles=Roles::all();
                    $department=Category::all();
                    $user=User::find($id);
                    return view('users.list',compact('roles','department','user'));

                   
        
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
        // dd($request->all());
        $validator = Validator::make($request->all(),[
                                'user_name'=>'regex:/^[\pL\s\-]+$/u|max:50',
                                'user_roles'=>'required',
                                // 'user_phone_number'=>'required|digits:10',
                                'user_phone_number' => 'required|digits:10|unique:users,system_user_phone,' . $id,
                                // 'user_phone_number'=>'required|digits:10|unique:users,system_user_phone',
                                'user_experience'=>'required|numeric|between:0,99.99',
                   ]);
                   
                   if($validator->validate()){

                    $users=User::find($id);
                    $users->name=$request->user_name;
                    $users->department_id =$request->department;
                    $users->system_user_phone=$request->user_phone_number;
                    $users->ststem_user_address=$request->user_address;
                    $users->roles_id=$request->user_roles;
                    $users->experience=$request->user_experience;
                   

                    // dd($users);
                    $users->update();
                    $request->session()->flash('msg','Data Updated Successfully');
                    return redirect('/users');
                    }else{
                    return redirect('/users')->withErrors($validator)->withInput();
             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        $departments=Category::where('head_of_department',$id)->get();
        foreach($departments as $department){
            $department->head_of_department=null;
            $department->save();
        }

        // dd($department);
        if(!$id){
            $request->session()->flash('errormsg','Record not Found');
            return redirect('users');
        }
        else{
            $post =User::where('id',$id)->first();
            $post->delete();
        }
        $request->session()->flash('errormsg','Data deleted Successfully');
            return redirect('users');
    }
}
