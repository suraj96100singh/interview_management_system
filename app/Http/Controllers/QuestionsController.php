<?php

namespace App\Http\Controllers;

use App\Category;
use App\Questions;
use App\Options;


use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $department_data=Questions::with('options')->find(1);
        // dd($department_data);
        $question_count=Category::with('questions')->get();
        // dd($request->id);
        if($request->id){
            $department_wise_question=Category::with('questions')->find($request->id);
            // dd('hii');
            // return $department_wise_question;
            return response()->json([
                'status'=>200,
                'all_questions'=>$department_wise_question,
            ]);
            // }else{
            // return response()->json([
            //     'status'=>400,
            //     'message'=>"data not Found",
            // ]);
}
    return view('questions.index', compact('question_count'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department=Category::all();
        return view('questions.list',compact('department'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request->all());
        // foreach ($request->questions as $question_val){
            
        //     $question_tbl=new Questions();
        //     $question_tbl->Question=$question_val;
        //     $question_tbl->department_id=$request->selected_department;
        //     if($question_tbl->save()){
        //         foreach($request->options as $option_val){
        //             $option_val_length=count($option_val);
        //             for($i=0;$i<$option_val_length;$i++){
        //                 $options_tbl=new Options();
        //                 $options_tbl->options=$option_val[$i];
        //                 $options_tbl->question_id=$question_tbl->id;
        //                 $options_tbl->save();
        //             }
                    
        //         }
        //     }
            
        // }
        $keys=array_keys($request->all());
        $option=preg_grep('/option/',$keys);
        $number=[];
        // dd($option);
        foreach($option as $newoption){
            $a=str_replace('options_','',$newoption);
            array_push($number,$a);
            // dd($a);
        }
      
        $index=0; 

       foreach($request->question as $question){
        // dd($question);
        $question_tbl=new Questions();
        $question_tbl->Question=$question;
        $question_tbl->department_id=$request->selected_department;
        $correct_answer_index=1;
        if($question_tbl->save()){
            foreach($request['options_'.$number[$index]] as $option){
                // dd($option);
                $options_tbl=new Options();
                $options_tbl->options=$option;
                $options_tbl->question_id=$question_tbl->id;
                if($request['correct_answer_'.$number[$index]]==$correct_answer_index){
                    $options_tbl->right_answer=1;
                }else{
                    $options_tbl->right_answer=0;
                }
                $options_tbl->save();

                $correct_answer_index++;
               
                // dd($option);
            }
        }
        $index++;
       

       }
       $request->session()->flash('msg','Data Added Successfully');
       return redirect('questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id)
    {
        if($question_id){
            $department_data=Questions::with('options')->find($question_id);
            if($department_data){
                return response()->json([
                    'status'=>200,
                    'question_option'=>$department_data,
                ]);

            }else{
                return response()->json([
                    'status'=>400,
                    'message'=>"data not found",
                ]);

            }
        }
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
        $question_tbl=Questions::find($id);
        $question_tbl->Question=$request->question;
        $correct_answer_index=1;
        if($question_tbl->update()){
            $old_option=Options::where('question_id',$id)->delete();
            foreach($request->options as $new_options){
                // dd($request->correct_answer);
                $option_new=new Options();
                $option_new->options=$new_options;
                $option_new->question_id=$question_tbl->id;
                if($request->correct_answer==$correct_answer_index){
                    $option_new->right_answer=1;
                }else{
                    $option_new->right_answer=0;
                }
                $option_new->save();

                $correct_answer_index++;
                
            }


            
            
        }
       $request->session()->flash('msg','Data Updated Successfully');
        return redirect('questions');
        



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question, Request $request)
    {
        $old_option=Options::where('question_id',$question)->delete();
        $department_id=Questions::find($question)->department_id;
        $questions=Questions::find($question)->delete();
        // $request->session()->flash('errormsg','Data deleted Successfully');
        return response()->json([
            'status'=>'200',
            'department_id'=>$department_id,
            'errormsg'=>'Data Deleted Successfully',
            
        ]);
        // $request->session()->flash('errormsg','Data deleted Successfully');
        //     return redirect('questions');
       
    }
}
