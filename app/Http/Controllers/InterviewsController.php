<?php

namespace App\Http\Controllers;

use App\Candidate_Work_Experiences;
use App\Interviews;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InterviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('interview.interviewscreate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->candidate_marriage_statuss);
        $interviews=new Interviews;
        $interviews->candidate_name=$request->candidate_name;
        $interviews->candidate_dob=$request->candidate_dob;
        $interviews->candidate_age=$request->candidate_age;
        $interviews->candidate_number=$request->candidate_number;
        $interviews->candidate_email=$request->candidate_Email;
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
        $interviews->candidate_soft_skills=implode(',',$request->soft_skill);
        $interviews->candidate_any_special_knowledge=$request->special_knowledge;
        $interviews->candidate_any_medical_problem=$request->medical_problem;
        $interviews->candidate_any_habits=implode(',',$request->habits);
        $interviews->candidate_expected_salary=$request->expected_amount;
        $interviews->candidate_form_filling_date=$request->date;
        $interviews->earlier_tour=$request->earlier_tour;
        // dd($interviews->candidate_marriage_status);
        // dd($request->all());
        if($request->signature){
            $get_signature=$request->signature;
            $encoded_image = explode(",", $get_signature)[1];
            $decoded_image = base64_decode($encoded_image);
            $filename="storage/".Str::random(40).".png";
            $image= file_put_contents($filename, $decoded_image);
            // dd($filename);
            
        }else{
            $interviews->candidate_signature="no_candidate_image.png";
        }
        $interviews->candidate_signature=$filename;
        // dd($interviews->candidate_signature);
        $interviews->save();
        // if(){
            
            $count=count($request->company_name);
            // dd($count);
            for($i=0;$i<$count;$i++){
                // dd($i);
                $candidate_work_experience=new Candidate_Work_Experiences;
                $candidate_work_experience->candidate_id=2;
                $candidate_work_experience->candidate_company_name->$request->company_name[$i];
                $candidate_work_experience->candidate_work_experience->$request->working_as[$i];
                $candidate_work_experience->candidate_salary_per_month->$request->salary_per_month[$i];
                $candidate_work_experience->cheque_cash_status->$request->cheque_or_cash[$i];
                $candidate_work_experience->full_part_time_status->$request->parttime_fulltime[$i];
                $candidate_work_experience->reason_for_leaving_previous_company->$request->reason_for_leaving[$i];
                // dd($candidate_work_experience);
                $candidate_work_experience->save();
            }
            // dd($i);
           
            // $candidate_work_experience->candidate_id=$interviews->id;

        // }



       
        
       
       

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interviews  $interviews
     * @return \Illuminate\Http\Response
     */
    public function show(Interviews $interviews)
    {
        //
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
    public function update(Request $request, Interviews $interviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interviews  $interviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interviews $interviews)
    {
        //
    }
}
