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
        $datas = DB::tables('programs')->get();
        // $datas = Program::get();


            return DataTables::of($datas)->addIndexColumn()
            // ->addColumn('display', function ($row) {
            //     if ($row->is_visible === 1) {

            //         $btn = '<a href="#" class="text-center btn btn-success btn-sm"><i class="fas fa-check"></i></a>';
            //     } else {
            //         $btn = '<a href="#" class="text-center btn btn-danger btn-circle"><i class="fas fa-times"></i></a>';
            //     }

            //     return $btn;
            // })
            // ->addColumn('action', function ($row) {

            //     $btn = '<a href="' . route("edit-gallery", ['id' => $row->id]) . '" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
            //     <a href="' . route("delete-gallery", ['id' => $row->id]) . '" class="btn btn-danger  btn-sm"><i class="fas fa-trash"></i></a>';

            //     return $btn;
            // })->rawColumns(['display', 'action'])
            ->make(true);
    }

    public function addProgram()
    {
        return view('add-program');
    }


    public function storeProgram(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'program.*.title' => 'required',
                'program.*.type' => 'required',
                'program.*.activities' => 'required',
                'program.*.images' => 'required|image',
                'program.*.brief' => 'required',
            ]);
    
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            foreach ($request->program as $program) {
                $imagefile = $program['images']->getClientOriginalName();
                $program['images']->move(public_path('Program/Image'), $imagefile);
    
                Program::insert([
                    'program_title' => $program['title'],
                    'type' => $program['type'],
                    'activities' => $program['activities'],
                    'featured_image' => $imagefile,
                    'brief_intro' => $program['brief'],
                ]);
            }
            return redirect()->to('/')->with('success', 'Programs successfully inserted.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while inserting programs.');
        }
    }

}