<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\SalesRecord;
use Image;
use App\Repositories\SalesRecordRepository;

class SalesRecordController extends Controller
{
    protected $salesRecords;

    public function __construct(SalesRecordRepository $salesRecords)
    {
        // $this->middleware('auth');
        $this->salesRecords = $salesRecords;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $salesRecords = SalesRecord::where('user_id', $request->user()->id)->get();

        // return view('employee.index', [
        //     'salesRecords' => $salesRecords,
        // ]);
        return view('employee.index', [
            'salesRecords' => $this->salesRecords->forUser($request->user()),
        ]);
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
        try {
            $this->validate($request, [
                'customer_name' => 'required|between:5,50',
                'product_description' => 'required|between:5,50',
                'record_image' => 'file|image|max:1024',
            ]);
            $record_image_path=null;
            if ($request->hasFile('record_image') && $request->file('record_image')->isValid()) {
                $record_file = $request->file('record_image');
                $record_extension = $record_file->extension();
                $record_name = $request->input('customer_name') .uniqid(). '.' . $record_extension;
                $record_image_path = 'images/record/' . $record_name;
                $logo_result = Image::make($record_file)->save($record_image_path);
            }
            $input = $request->all();
            $input['record_image']=$record_image_path;
            // dd($input);
            $request->user()->salesRecords()->create($input);
            return redirect()
                    ->back()
                    ->withInput();
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'record_image'=> $e->getMessage(),
                    ]);
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SalesRecord $salesRecord)
    {
        // dd($salesRecord);
        $this->authorize('destroy', $salesRecord);
        $salesRecord->delete();
        return redirect('/employee/salesRecord');

    }
}
