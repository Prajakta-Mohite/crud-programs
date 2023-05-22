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
        // $datas = Program::get();
        // dd($datas); 
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
            ->rawColumns(['image','checkbox','count'])
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

    public function deleteProgram(Request $request)
    {
        $checkedArray = $request->input('checkedArray');

        $count = 0;
        foreach($checkedArray as $check)
        {
            DB::table('programs')->where('id',intval($check))->delete();
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