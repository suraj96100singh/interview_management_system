<?php

namespace App\Http\Controllers;

use App\Category;
use App\Questions;
use App\Options;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
// use IOFactory

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
        foreach($option as $newoption){
            $a=str_replace('options_','',$newoption);
            array_push($number,$a);
        }
        // dd($number);
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
        
        // return response()->json($question);
        // $old_option=Options::where('question_id',$question)->delete();
        $department_id=Questions::find($question)->department_id;
        
        $ids = explode(",", $question);
        $idscount=count($ids);
        // for($i=0;$i<count($ids);$i++){
        //     $questions=Questions::where('id',$ids[$i])->delete();
        // }
        
        $questions=Questions::find($ids)->each(function ($main,$key){
            $main->delete();
        });
        // $request->session()->flash('errormsg','Data deleted Successfully');
        return response()->json([
            'status'=>'200',
            'department_id'=>$department_id,
            'errormsg'=>'Data Deleted Successfully',
            'question_id'=>$question,
            'id_count'=>$idscount,
            
        ]);
        // $request->session()->flash('errormsg','Data deleted Successfully');
        //     return redirect('questions');
       
    }
    public function importDataIndex(Request $request){
        
    $department=Category::all();
        return view('questions.importExcel',compact('department'));
    }



    public function importData(Request $request){
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('uploaded_file');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'C', $column_limit );
            $startcount = 2;
            $data = array();
            $question=array();
            // dd($column_range);

            foreach ( $row_range as $row ) {
                
                $data[] = [
                    'question' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'option' => $sheet->getCell( 'B' . $row )->getValue(),
                    'correct_answer' => $sheet->getCell( 'C' . $row )->getValue(),
                ];
                $startcount++;
            }
            // dd($data);
            // question show
            $question_val=array_column($data,'question');
            $question_unique=(array_unique($question_val));
            $sorted_key=array_filter(array_merge( $question_unique));
           

                $question_value=[
                    'question'=>$sorted_key
                ];
                // dd($question_value);
                
            // dd($data[0]['question']);
            // dd($question_value);
            // optionshow
            $option=array();
            $unique_question_length=count($question_value['question']);
            $main_data_lenght=count($data);
             $count=0;
            for($i=0;$i<$unique_question_length;$i++){
                for($j=0;$j<$main_data_lenght;$j++){
                    if($question_value['question'][$i]==$data[$j]['question']){
                        $option['option_'.$count][]=$data[$j]['option'];
                        $correct_answer['correct_answer_'.$count][]=$data[$j]['correct_answer'];
                    }  
                }
                $count++;
                
                
            }
            // below data save code   
            $keys=array_keys($option);
            $options=preg_grep('/option/',$keys);
            $number=[];
            foreach($options as $newoption){
                $a=str_replace('option_','',$newoption);
                array_push($number,$a);
            }
            $index=0; 
           foreach($question_value as $question_partial_val){
            foreach($question_partial_val as $question_last_value){
                $question_tbl=new Questions();
                $question_tbl->Question=$question_last_value;
                $question_tbl->department_id=$request->selected_department;
                
                if($question_tbl->save())
                {

                        foreach($option['option_'.$number[$index]] as $key=>$option_val){
                            $options_tbl=new Options();
                            $options_tbl->options=$option_val;
                            $options_tbl->question_id=$question_tbl->id;
                            if($correct_answer['correct_answer_'.$number[$index]][$key]=="yes"){
                                $options_tbl->right_answer=1;

                            }else{
                                $options_tbl->right_answer=0;
                              

                            }
                            $options_tbl->save(); 
                        }
            }
            $index++;
            }
           }
           $request->session()->flash('msg','Data Added Successfully');
           return redirect('questions');
        } catch (Exception $e) {
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('Great! Data has been successfully uploaded.');
    }

    
    
}
