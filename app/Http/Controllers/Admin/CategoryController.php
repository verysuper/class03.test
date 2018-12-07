<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Category;
use Illuminate\Http\Request;
use Validator;
use DB;

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
            'category_no' => 'required|between:7,7',
            'name' => 'required|between:10,50',
            'name_en' => 'required|between:10,50',
            'image' => 'file|image|max:1024',
        ],[
            'category_no.between'=>'Must be equal 7 digits',
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
        $store_result=null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $extension = $image->extension();
            //$store_result = $photo->store('photo');
            $file=$request->input('category_no').'.'.$extension;
            $store_result = $image->storeAs('logo', $file, 'public_category');
        }
        $input = $request->all();
        $input['image'] = $store_result;
        Category::create($input); //try catch
        $parent_id = $input['parent_id'];
        if($parent_id != '0'){
            $count = Category::where('parent_id', $parent_id)
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
        $parent=null;
        if( $parent_id > 0){
           $parent = Category::where('id',$parent_id)->first();
        }
        $category = Category::orderBy('updated_at', 'desc')
                    ->where( 'parent_id' , $parent_id)
                    ->where('display', $display)
                    ->get();
                    // ->toJson(JSON_PRETTY_PRINT);
        //新增商品時會更新該項子項目數量
        return view('admin/category/show',[
            'parent_id'=>$parent_id,
            'categorys'=>$category,
            'parent'=>$parent,
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
            'category_no' => 'required|between:7,7',
            'name' => 'required|between:10,50',
            'name_en' => 'required|between:10,50',
            'image' => 'file|image|max:1024',
        ],[
            'category_no.between'=>'Must be equal 7 digits',
        ]);
        $store_result=null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $extension = $image->extension();
            //$store_result = $photo->store('photo');
            $file=$request->input('category_no').'.'.$extension;
            $store_result = $image->storeAs('logo', $file, 'public_category');
        }
        $input = $request->all();
        $input['image'] = $store_result;
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
            $count=$this->countSubItems('categories',$category->id);
        }else {
            $count=$this->countSubItems('merchandises',$category->id);
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
    private function countSubItems($table,$id){
        return DB::table($table)
                    ->where('parent_id',$id)
                    ->where('display','1')
                    ->count();
    }
    //
    public function restore(Category $category){
        // dd($category);
        $category->update([
            'display'=>'1',
        ]);

        Category::where('id', $category->parent_id)
                    ->increment('sub_qty',1);
        return redirect('admin/category/'.$category->parent_id.'/show/1');
    }
}
