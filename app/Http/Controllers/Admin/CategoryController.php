<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Category;
use Illuminate\Http\Request;
use Validator;
use DB;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('admin/category/0/show/1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id)
    {
        $layer = 0;
        if($parent_id!=0){
            $layer = Category::findOrFail($parent_id)->layer + 1;
        }
        return view('admin/category/create',[
            'parent_id'=>$parent_id,
            'layer'=>$layer,
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
            'category_no' => 'required|between:10,10',
            'name' => 'required|between:10,50',
            'name_en' => 'required|between:10,50',
            'logo' => 'file|image|max:1024',
        ],[
            'category_no.between'=>'Must be equal 10 digits',
        ]);
        $msg=null;
        if(Category::where('category_no',$request->category_no)->first()){
            $msg[]='編號已存在';
        }
        if(Category::where('name',$request->name)->first()){
            $msg[]='名稱已存在';
        }
        if(Category::where('name_en',$request->name_en)->first()){
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
            $logo_name = $request->input('category_no') . '.' . $logo_extension;
            $logo_relative_path = 'images/logo/category/' . $logo_name;
            $logo_result = Image::make($logo_file)->resize(122, 138.5, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_relative_path);
            // $logo_path = public_path($logo_relative_path);
        }
        $input = $request->all();
        $input['logo']=$logo_relative_path;
        Category::create($input); //try catch
        $parent_id = $input['parent_id'];
        if($parent_id != '0'){
            $count = Category::where('parent_id', $parent_id)
                                ->where('display','1')
                                ->count();
            Category::where('id', $parent_id)
                        ->update(['sub_qty' => $count]);
        }
        return redirect('admin/category/'.$parent_id.'/show/1');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($parent_id = 0,$display=1)
    {
        if($parent_id != '0'){ //暫時
            $count = Category::where('parent_id', $parent_id)
                                ->where('display','1')
                                ->count();
            Category::where('id', $parent_id)
                        ->update(['sub_qty' => $count]);
        }
        //新增商品時會更新該項子項目數量
        $parent=null;
        if( $parent_id > 0){
           $parent = Category::where('id',$parent_id)->first();
        }
        $category = Category::orderBy('updated_at', 'desc')
                    ->where( 'parent_id' , $parent_id)
                    ->where('display', $display)
                    ->get();
                    // ->toJson(JSON_PRETTY_PRINT);
        return view('admin/category/show',[
            'parent_id'=>$parent_id,
            'categorys'=>$category,
            'parent'=>$parent,
            'display'=>$display,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin/category/edit',[
            'category'=>$category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_no' => 'required|between:10,10',
            'name' => 'required|between:10,100',
            'name_en' => 'required|between:10,100',
            'logo' => 'file|image|max:1024',
        ],[
            'category_no.between'=>'Must be equal 10 digits',
        ]);
        $logo_relative_path=null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logo_file = $request->file('logo');
            $logo_extension = $logo_file->extension();
            $logo_name = $request->input('category_no') . '.' . $logo_extension;
            $logo_relative_path = 'images/logo/category/' . $logo_name;
            $logo_result = Image::make($logo_file)->resize(122, 138.5, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_relative_path);
        }else{
            $logo_relative_path = $category->logo;
        }
        $input = $request->all();
        $input['logo'] = $logo_relative_path;
        $category->update($input);
        return redirect('admin/category/'.$category->parent_id.'/show/1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //to do check sub items
        $count=0;
        if($category->layer < 2){
            $count=$this->countSubItems('categories','parent_id',$category->id);
        }else {
            $count=$this->countSubItems('merchandises','parent_id',$category->id); //******************** */
        }
        if($count > 0){
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'msg'=> ['存在子項目']
                    ]);
        }
        $category->display = '0';
        $category->update();

        Category::where('id', $category->parent_id)
                    ->decrement('sub_qty',1);
        return redirect()->back();
    }
    //
    private function countSubItems($table,$column,$id){
        return DB::table($table)
                    ->where( $column, $id)
                    ->where('display','1')
                    ->count();
    }
    //
    public function restore(Category $category){
        $category->update([
            'display'=>'1',
        ]);

        Category::where('id', $category->parent_id)
                    ->increment('sub_qty',1);
        return redirect('admin/category/'.$category->parent_id.'/show/1');
    }
}
