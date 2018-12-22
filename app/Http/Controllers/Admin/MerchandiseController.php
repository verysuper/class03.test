<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Merchandise;
use Illuminate\Http\Request;
use App\Entity\Category;
use Image;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //防止無索引
        return redirect('admin/category/0');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id)
    {
        if($parent_id == 0){
            return redirect('admin/category/0');
        }
        return view('admin/merchandise/create',[
            'parent_id'=>$parent_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'merchandise_no' => 'required|between:10,10',
            'name' => 'required|between:10,100',
            'name_en' => 'required|between:10,100',
            'logo' => 'file|image|max:1024',
            'price' => 'required',
            'brand_id' => 'required',
            'vendor_id' => 'required',

        ],[
            'merchandise_no.between'=>'Must be equal 10 digits',
        ]);
        if(Merchandise::where('merchandise_no',$request->merchandise_no)->first()){
            $msg[]='編號已存在';
        }
        if(Merchandise::where('name',$request->name)->first()){
            $msg[]='名稱已存在';
        }
        if(Merchandise::where('name_en',$request->name_en)->first()){
            $msg[]='英文名稱已存在';
        }
        if(!empty($msg)){
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'msg'=> $msg,
                    ]);
        }
        $logo_relative_path=null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logo_file = $request->file('logo');
            $logo_extension = $logo_file->extension();
            $logo_name = $request->input('merchandise_no') . '.' . $logo_extension;
            $logo_relative_path = 'images/logo/merchandise/' . $logo_name;
            $logo_result = Image::make($logo_file)->resize(122, 138.5, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_relative_path);
        }
        $input = $request->all();
        $input['logo'] = $logo_relative_path;
        Merchandise::create($input); //try catch
        $parent_id = $input['parent_id'];
        if($parent_id != '0'){
            $count = Merchandise::where('parent_id', $parent_id)
                                ->where('display','1')
                                ->count();
            Category::where('id', $parent_id)
                        ->update(['sub_qty' => $count]);
        }
        return redirect('admin/merchandise/'.$parent_id.'/show/1');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function show($parent_id = 0, $display=1 )
    {
        if($parent_id != '0'){ //暫時
            $count = Merchandise::where('parent_id', $parent_id)
                                ->where('display','1')
                                ->count();
            Category::where('id', $parent_id)
                        ->update(['sub_qty' => $count]);
        }
        //新增商品時會更新該項子項目數量
        $parent=null;
        if( $parent_id > 0){
           $parent = Category::where('id',$parent_id)->first();
        }else {
            return redirect('admin/category/0');
        }
        $merchandise = Merchandise::orderBy('updated_at', 'desc')
                    ->where('parent_id', $parent_id)
                    ->where('display', $display)
                    ->get();
                    // ->toJson(JSON_PRETTY_PRINT);

        return view('admin/merchandise/show',[
            'parent_id'=>$parent_id,
            'merchandise'=>$merchandise,
            'parent'=>$parent,
            'display'=>$display,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchandise $merchandise)
    {
        return view('admin/merchandise/edit',[
            'merchandise'=>$merchandise,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchandise $merchandise)
    {
        $this->validate($request, [
            'merchandise_no' => 'required|between:10,10',
            'name' => 'required|between:10,100',
            'name_en' => 'required|between:10,100',
            'logo' => 'file|image|max:1024',
            'price' => 'required',
            'brand_id' => 'required',
            'vendor_id' => 'required',

        ],[
            'merchandise_no.between'=>'Must be equal 10 digits',
        ]);
        $logo_relative_path=null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logo_file = $request->file('logo');
            $logo_extension = $logo_file->extension();
            $logo_name = $request->input('merchandise_no') . '.' . $logo_extension;
            $logo_relative_path = 'images/logo/merchandise/' . $logo_name;
            $logo_result = Image::make($logo_file)->resize(122, 138.5, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_relative_path);
        }else{
            $logo_relative_path = $merchandise->logo;
        }
        $input = $request->all();
        $input['logo'] = $logo_relative_path;
        $merchandise->update($input);
        return redirect('admin/merchandise/'.$merchandise->parent_id.'/show/1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchandise $merchandise)
    {
        $merchandise->display = '0';
        $merchandise->update();

        Category::where('id', $merchandise->parent_id)
                    ->decrement('sub_qty',1);
        return redirect()->back();
    }
    public function restore(Merchandise $merchandise){
        // dd($merchandise);
        $merchandise->update([
            'display'=>'1',
        ]);

        Category::where('id', $merchandise->parent_id)
                    ->increment('sub_qty',1);
        return redirect('admin/merchandise/'.$merchandise->parent_id.'/show/1');
    }
}
