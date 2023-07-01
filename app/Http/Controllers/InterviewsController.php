<?php

namespace App\Http\Controllers;

use App\Candidate_Work_Experiences;
use App\Interviews;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\Questions;
use App\Options;
use Faker\Provider\ar_EG\Internet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InterviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $url_count=0;
    public function index(Request $request)
    {
        // experiment 1
        if ($request->ajax()) {
            $data = Interviews::with('departmentName')->select('*');
           
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                         if($row->candidate_status=='pending'){
                            return "<div class='text-center'><select  name='candidate_status' id='$row->id' class='btn btn-primary myselect mt-1'>
                            <option value='pending' selected >Pending</option>
                             <option value='accept'>Accept</option>
                             <option value='reject'>Reject</option>
                          </select></div>";
                         }elseif($row->candidate_status=='accept'){
                            return "<div class='text-center'><select  name='candidate_status' id='$row->id' class='btn btn-success myselect mt-1' disabled>
                            <option value='pending'  >Pending</option>
                             <option value='accept'  selected>Accept</option>
                             <option value='reject'>Reject</option>
                          </select></div>";
                         }else{
                            return "<div class='text-center'><select  name='candidate_status' id='$row->id' class='btn btn-danger myselect mt-1' disabled>
                            <option value='pending'>Pending</option>
                             <option value='accept'>Accept</option>
                             <option value='reject' selected>Reject</option>
                          </select></div>";
                         }
                    })
                    ->addColumn('action',function($row){
                        
                            return "<button class='btn btn-primary show_full_detail text-nowrap mt-1' data-toggle='modal' data-target='#candidateModal' value='$row->id' name='action'>view detail</button>";
                        
                        
                    
                    })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('status') == 'pending' || $request->get('status') == 'accept' || $request->get('status') == 'reject') {
                            $instance->where('candidate_status', $request->get('status'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('candidate_name', 'LIKE', "%$search%")
                                ->orWhere('candidate_number', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
                    // ->rawColumns(['action']);
        }
    //    experiment 2
        // if ($request->ajax()) {
                 
        //     $request_data=$request->get('status');
        //     $data = Interviews::where('candidate_status','=',$request_data)->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('status', function($row){
        //                  if($row->status){
        //                     return '<span class="badge badge-primary">Active</span>';
        //                  }else{
        //                     return '<span class="badge badge-danger">Deactive</span>';
        //                  }
        //             })
        //             ->filter(function ($instance) use ($request) {
        //                 if ($request->get('status') == 'pending' || $request->get('status') == 'accept' || $request->get('status') == 'reject') {
        //                     $instance->where('candidate_status', $request->get('status'));
        //                 }
        //             })
        //             ->rawColumns(['status'])
        //             ->make(true);
            // return response()->json(['data'=>$data]);
        // }
        // $candidate_detail=Interviews::with('departmentName')->orderByRaw("FIELD(candidate_status , 'pending', 'accept', 'reject') ASC")->orderBy('id','desc')->get();
        // return view('interview.interviewlist',compact('candidate_detail'));
        return view('interview.interviewlist');
        

    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Category::all();
        
        return view('interview.interviewscreate',compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function interviewValidate(Request $request){
        // dd($request->all());
        // $rules=array('candidate_name' => 'required',
        //             'candidate_dob' => 'required',
        //             'candidate_number' => 'required',
        //             'candidate_permanent_address' => 'required',
        //             'department_id' => 'required',
        //             'candidate_Email'=>'required|email',
        //             'expected_amount'=>'required'

        //         );
                $validated=$request->validate(['candidate_name' => 'required',
                'candidate_dob' => 'required',
                'candidate_number' => 'required',
                'candidate_permanent_address' => 'required',
                'department_id' => 'required',
                // 'candidate_Email'=>'required|email',
                'candidate_Email' => 'unique:interviews,candidate_email',
                'expected_amount'=>'required']);
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //         return response()->json([
                   
        //             'success' => false,
        //             'errors' => $validator->getMessageBag()->toArray()

        //     ], 403); // 400 being the HTTP code for an invalid request.
        // }else{

             return response()->json(['success' => true], 200);
        // }
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
         // = $request->validate([
        //     'candidate_name' => 'required',
        //     'candidate_dob' => 'required',
        //     'candidate_number' => 'required',
        //     'candidate_permanent_address' => 'required',
        //     'candidate_10th_medium' => 'required',
        //     'candidate_10th_percentage' => 'required'
        // ]);
    //    $data_o = $request->formData;
    //    return response()->json(['success' => $ggg], 200);
                
// -----
    // $rules=array('candidate_name' => 'required', 'candidate_dob' => 'required',
    //                  'candidate_number' => 'required', 'candidate_permanent_address' => 'required',
    //                   'department_id' => 'required',
    //                   'candidate_Email'=>'required|email','expected_amount'=>'required'

    // );
    // $validator = Validator::make($request->all(), $rules);
    $validated=$request->validate(['candidate_name' => 'required', 'candidate_dob' => 'required',
    'candidate_number' => 'required', 'candidate_permanent_address' => 'required',
     'department_id' => 'required',
     'candidate_Email' => 'unique:interviews,candidate_email','expected_amount'=>'required']);
    // if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->getMessageBag()->toArray()

    //     ], 400);
    // }
    // ------
    // else{

    //      return response()->json(['success' => true], 200);
    // }

            // echo "welcome ". $rules;




//     dd($request->candidate_marriage_statuss);
//     dd($request->candidate_marriage_statuss);
// if (isValidated($validated)) {
//     // dd($validated);
//    return reponse()->json(['status'=>200,'message'=>'success']);
// }else{
//    return reponse()->json(['status'=>400,'message'=>'error']);
// }

// return response()->json($request);

if ($request->name) {
    // dd($request->all());

    $interviews=new Interviews;
    $interviews->candidate_name = $request->candidate_name;
    $interviews->candidate_dob = $request->candidate_dob;
    $interviews->candidate_age = $request->candidate_age;
    $interviews->candidate_number = $request->candidate_number;
    $interviews->candidate_email = $request->candidate_Email;
    $interviews->candidate_marriage_status=$request->candidate_marriage_statuss;
    $interviews->candidate_permanent_address=$request->candidate_permanent_address;
    $interviews->candidate_current_address=$request->candidate_current_address;
    $interviews->candidate_10th_marks=$request->candidate_10th_percentage;
    $interviews->candidate_10th_institution_name=$request->candidate_10th_institution_name;
    $interviews->candidate_10th_medium=$request->candidate_10th_medium;
    $interviews->candidate_12th_subject_name=$request->candidate_12th_subject;
    $interviews->candidate_12th_marks=$request->candidate_12th_percentage;
    $interviews->candidate_12th_institution_name=$request->candidate_12th_institution_name;
    $interviews->candidate_12th_medium=$request->candidate_12th_medium;
    $interviews->candidate_graduation_subject=$request->graduation_degree_name;
    $interviews->candidate_graduation_percentages=$request->graduation_percentage;
    $interviews->candidate_graduation_institution_name=$request->graduation_institution_name;
    $interviews->candidate_graduation_medium=$request->graduation_medium;
    $interviews->candidate_pg_or_deploma_subject=$request->pg_deploma_degree_name;
    $interviews->candidate_pg_or_deploma_percentages=$request->pg_deploma_percentage;
    $interviews->candidate_pg_or_deploma_institution_name=$request->pg_deploma_institution_name;
    $interviews->candidate_pg_or_deploma_medium=$request->pg_deploma_medium;
    $interviews->candidate_reference_person_name=$request->refrence_person_name;
    $interviews->candidate_if_ready_to_go_outside_bikaner=$request->ready_to_go_outside_bikaner;
    $interviews->candidate_have_DL_status=$request->license_ask;
    $interviews->candidate_have_PAN_status=$request->pancard_ask;
    if($request->soft_skill)
    $interviews->candidate_soft_skills=implode(',',$request->soft_skill);
    $interviews->candidate_any_special_knowledge=$request->special_knowledge;
    $interviews->candidate_any_medical_problem=$request->medical_problem;
    if($request->habits)
    $interviews->candidate_any_habits=implode(',',$request->habits);
    $interviews->candidate_expected_salary=$request->expected_amount;
    $interviews->candidate_form_filling_date=$request->date;
    $interviews->earlier_tour=$request->earlier_tour;
    $interviews->department_id=$request->department_id;
    $interviews->address_latitude=$request->lat;
    $interviews->address_longitude=$request->long;
    $interviews->distance_btw_office=$request->distance_btw_office;
    // dd($interviews->candidate_marriage_status);
    // dd($request->all());
        // $get_signature=$request->signature;
        // $encoded_image = explode(",", $get_signature)[1];
        // // dd($encoded_image);
        // $decoded_image = base64_decode($encoded_image);
        // $filename="storage/".Str::random(40).".png";
        // // dd($decoded_image);
        // $image= file_put_contents($filename, $decoded_image);
        // // dd($filename);
        // $interviews->candidate_signature=$filename;
    // dd($interviews->candidate_signature);    
        $interviews->save();
    
   
        $count_workexp=count($request->company_name);
       
        for($i=0;$i<$count_workexp;$i++){
            
            $candidate_work_experience=new Candidate_Work_Experiences;
            $candidate_work_experience->candidate_id=$interviews->id;
            $candidate_work_experience->candidate_company_name=$request->company_name[$i];
            $candidate_work_experience->candidate_work_experience=$request->working_as[$i];
            $candidate_work_experience->candidate_salary_per_month=$request->salary_per_month[$i];
           
            if ($request->cheque_or_cash) {
                $candidate_work_experience->cheque_cash_status=$request->cheque_or_cash[$i];
            }
            if($request->parttime_fulltime)
            $candidate_work_experience->full_part_time_status=$request->parttime_fulltime[$i];
            $candidate_work_experience->reason_for_leaving_previous_company=$request->reason_for_leaving[$i];
           
            $candidate_work_experience->save();

            }

            $testquestion=Questions::with('options')->where('department_id' , "=" ,$interviews->department_id)->get();
            
            $encrypt_interviewer_id =[
                'id' =>$interviews->id,
            ];
            $encrypt_interviewer_id= Crypt::encrypt($encrypt_interviewer_id);
            return response()->json([
                'interview' => $interviews,
                'test_question' => $testquestion,
                'encrypt_interviewer_id'=>$encrypt_interviewer_id
                
            ]);
            



        }
        

    

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interviews  $interviews
     * @return \Illuminate\Http\Response
     */
    public function interview(Request $request)
            {
                // $data_o = $request->formData;
                //    return response()->json(['success' => $ggg], 200);

                    // $rules=array('candidate_name' => 'required', 'candidate_dob' => 'required',
                    //  'candidate_number' => 'required', 'candidate_permanent_address' => 'required',
                    //   'department_id' => 'required','candidate_Email'=>'required|email','expected_amount'=>'required');
                    // $validator = Validator::make(Input::all(), $rules);
                    $validated=$request->validate(['candidate_name' => 'required', 'candidate_dob' => 'required',
                    'candidate_number' => 'required', 'candidate_permanent_address' => 'required',
                     'department_id' => 'required','candidate_Email' => 'unique:interviews,candidate_email','expected_amount'=>'required']);
                    // $validator = Validator::make($data_o, $rules);
                    // if ($validator->fails()) {
                    //         return response()->json([
                    //             'success' => false,
                    //             'errors' => $validator->getMessageBag()->toArray()
                                

                    //     ],403); // 400 being the HTTP code for an invalid request.
                    //     }

                    //  return response()->json(['success' => true], 200);
            }
    public function show($id,Interviews $interviews)
    {
        // dd($id);
        // $candidate_detail=Interviews::with('departmentName')->get();
        $candidate_full_detail=Interviews::with(['departmentName','workExperienceInfo'])->find($id);

        return response()->json([
            'status'=>200,
            'candidate_full_details'=>$candidate_full_detail
        ]);
        // return view('interview.interviewlist',compact('candidate_full_detail','candidate_detail'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interviews  $interviews
     * @return \Illuminate\Http\Response
     */
    public function edit(Interviews $interviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interviews  $interviews
     * @return \Illuminate\Http\Response
     */
    public function update(Interviews $interviewer,Request $request)
    {
        
        // return response()->json($request->all());
        // dd($request->all());
        if($request->employee_status=='accept'){
        $validated = $request->validate([
                    'employee_role' => 'required',
                     'offered_salary' => 'required', 'joining_date' => 'required',
                      'employment_type' => 'required'
        ]);

        // ------
        // return response()->json($interviewer);
        $data['name']=$interviewer->candidate_name;
        $data["email"] = $interviewer->candidate_email;
        $data["title"] = "Mahesh suppliers (india) Pvt. Ltd.";
        $data["body"] = "Please Find below the Attachement";
        $data['role']=$request->employee_role;
        $data['date_of_joining']=$request->joining_date;
        $data['offer_salary']=$request->offered_salary;
        $data['address']=$interviewer->candidate_current_address;
  
        
        $interviewer->employee_role=$request->employee_role;
        $interviewer->employee_offered_salary=$request->offered_salary;
        $interviewer->employee_date_of_joining=$request->joining_date;
        $interviewer->employement_type=$request->employment_type;
        $interviewer->employee_remarks=$request->employee_remark;
        $interviewer->candidate_status='accept';
        
        $pdf = PDF::loadView('emails.welcome',$data);
        $path = storage_path('app/public/pdf/').$data['name']."_offer_latter".time().".pdf";
        $interviewer->candidate_pdf=substr($path,strpos($path ,$data['name']."_offer_latter"));
        $pdf->save($path);
        $interviewer->save();
        // $data["email"] = $interviewer->candidate_email;
        // $data["title"] = "Mahesh Infotech Pvt. Ltd.";
        // $data["body"] = "Please Find below the Attachement";
        // $pdf = PDF::loadView('emails.welcome');
        // Mail::to($interviewer->candidate_email)->send(new WelcomeMail($interviewer));
        //     $message->to($data["email"])
        //             ->subject($data["title"])
        //             ->attachData($pdf->output(), "text.pdf");

        // });
        // $data['name']=$interviewer->candidate_name;
        // $data["email"] = $interviewer->candidate_email;
        // $data["title"] = "Mahesh Infotech Pvt. Ltd.";
        // $data["body"] = "Please Find below the Attachement";
        // $data['role']=$interviewer->employee_role;
        // $data['data_of_joining']=$interviewer->employee_date_of_joining;
        // $data['offer_salary']=$interviewer->employee_offered_salary;
        // $data['address']=$request->candidate_current_address;
  
        // $pdf = PDF::loadView('emails.welcome',$data);
        // $path = storage_path('app/public/pdf/').$data['name']."_offer_latter".time()."pdf";
        
        // $pdf->save($path);
        Mail::send('emails.email', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                    ->subject('Offer Letter From Mahesh suppliers Pvt. Ltd.')
                    ->attachData($pdf->output(), "offer_latter.pdf");
                   
        });
        return response()->json(['success' => true], 200);

        }else{
            // return response()->json(['success' => "else vale main aa gya"], 200);
            $data['name']=$interviewer->candidate_name;
            $data["title"] = "Mahesh suppliers (india) Pvt. Ltd.";
            $data["email"] = $interviewer->candidate_email;
            Mail::send('emails.rejection', $data, function($message)use($data) {
                $message->to($data["email"])
                        ->subject('Your job application for Mahesh suppliers Pvt. Ltd.');
                        // ->attachData($pdf->output(), "offer_latter.pdf");
                       
            });
            $interviewer->candidate_status='reject';
            $interviewer->save();
            return response()->json(['success' => true], 200);
        }
        // $employee=Interviews::find($interviewer->id);
        // return response()->json($request->all());
        // if()
        

// ----
       

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interviews  $interviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interviews $interviewer)
    {
        //
    }
    public function examCalculation(Request $request, $id){
    //    dd(config('app.total_question'));
        $id = Crypt::decrypt($id);
        // dd($request->all());
       $all_request=array_values($request->all());
       $interview_candidate=Interviews::where("id","=",$id)->first();
       $total_question=Questions::where('department_id' , "=" ,$interview_candidate->department_id)->count();
       
        $data_count=count($request->all());
        $count=0;
        for($i=2;$i<$data_count;$i++){
            if(Options::find($all_request[$i])->right_answer==1){
                $count++;
            }
        }
        $interview_candidate->total_correct_question=$count;
        $interview_candidate->total_question=config('app.total_question');
        $interview_candidate->save();
        return view('interview/interviewdone');

    }
    public function examConduct(Request $request , $id){
        $id = Crypt::decrypt($request->id);
        $interview=Interviews::where("id","=",$id)->first();

        $all_question=Session::get('questions');
        $id=Session::get('id');
        // dd($id);
        // if ($all_question==null ) {
            if($request->id!=$id){
            $all_question=Questions::with('options')->where('department_id' , "=" ,$interview->department_id)->inRandomOrder()->limit(10)->get();
            
            Session::put('questions', $all_question);
            Session::put('id', $request->id);

            if(count($all_question)>0){
                
                return view('interview.examconduct' ,compact('all_question','interview'));

            }else{

                return view('interview.interviewdone');

            }
        }
       
        return view('interview.examconduct' ,compact('all_question','interview'));
        
       
   
        
        // return response()->json(['test_question'=>$all_question]);
       
    }
    
    
}
