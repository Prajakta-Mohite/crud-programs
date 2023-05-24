<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Program;
use DataTables;
use DB;
class ProgramController extends Controller
{
    public function index()
    {
        return view('show');
    }

    public function showProgram()
    {
        $datas = Program::get();
        $count=0;
       
            return DataTables::of($datas)->addIndexColumn()
            ->addColumn('count', function ($row) {                
                static $count = 1;
                return $count++;
            })
            ->addColumn('checkbox', function ($row) {
                $url1 = '<input type="checkbox" class="checkbox-input" name="array_check"  value="'.$row->id.'"/>';
                return $url1;
            })
            ->addColumn('image', function ($row) {
                $url = url("Program/Image/" . $row->featured_image);
                $url1 = '<img src="' . $url . '" alt="" width="80" height="80">';
                return $url1;
            })
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route("single-edit-program", ['id' => $row->id]) . '" class="btn btn-success btn-sm">Edit</a>';
                return $btn;
            })
            ->rawColumns(['image','checkbox','count','action'])
            ->make(true);
    }

    public function addProgram()
    {
        return view('add-program');
    }


    public function storeProgram(Request $request)
    {
        try {
            for($i=0;$i<count($request->title);$i++)
            {
              
                $imagefile =$request->images[$i]->getClientOriginalName();
                $request->images[$i]->move(public_path('Program/Image'), $imagefile);
    
                Program::insert([
                    'program_title' => $request->title[$i],
                    'type' => $request->type[$i],
                    'activities' => $request->activities[$i],
                    'featured_image' => $imagefile,
                    'brief_intro' =>$request->brief[$i], 
                ]);
            }
         
        
            return redirect()->to('/')->with('success', 'Programs successfully inserted.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while inserting programs.');
        }
    }

    public function editProgram(Request $request)
    {
        $checkedArray = $request->input('checkedArray');
        
        $checkedArray = explode(',', $checkedArray);
    
        $data = Program::whereIn('id', $checkedArray)->get();
    
        return view('edit-program', compact('data'));
    }

   
    public function updateProgram(Request $request)
    {
        $updateprogram = $request->input('program');
        $count = 0;
        
        foreach($updateprogram as $update)
        {  
                Program::where('id',$update['id'])->update([
                    'program_title'=>$update['title'],
                    'type'=>$update['type'],
                    'activities'=>$update['activities'],
                    'brief_intro'=>$update['brief'],
                ]);
        }
            return view('show');
    }

    public function singleEditProgram($id,Request $request)
    {
        $data = Program::where('id', $id)->first();
    
        return view('single-edit-program', compact('data'));

    }
    public function singleUpdateProgram($id,Request $request)
    {
        if($request->images)
        {
            $imagefile =$request->images->getClientOriginalName();
            $request->images->move(public_path('Program/Image'), $imagefile);
    
            Program::where('id',$id)->update([
                'program_title'=>$request->title,
                'type'=>$request->type,
                'activities'=>$request->activities,
                'brief_intro'=>$request->brief,
                'featured_image'=>$imagefile,
            ]);
        }
        else{
        
            Program::where('id',$id)->update([
                'program_title'=>$request->title,
                'type'=>$request->type,
                'activities'=>$request->activities,
                'brief_intro'=>$request->brief,
            ]);
        }
        
       
    
        return view('show');

    }

    public function deleteProgram(Request $request)
    {
        $checkedArray = $request->input('checkedArray');

        $count = 0;
        foreach($checkedArray as $check)
        {
            DB::table('programs')->where('id',$check)->delete();
            $count++;
        }
        if(count($checkedArray) == $count)
        {
            return response()->json([
                'message'=>'Programs deleted successfully',
                'statuscode'=>200
            ]);
        }
    }

}