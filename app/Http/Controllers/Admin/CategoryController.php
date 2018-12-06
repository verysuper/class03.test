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
        return redirect('admin/category/0');
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
    public function store(Request $request)//待改成 $this->validate()
    {
        $this->validate($request, [
            'category_no' => 'required|between:7,7',
            'name' => 'required|between:10,50',
            'name_en' => 'required|between:10,50',
            'image' => 'file|image|max:10240',
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
        Category::create($input); //try catch
        return redirect('admin/category/'.$input['parent_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($parent_id = 0)
    {
        $category = Category::orderBy('updated_at', 'desc')
                    ->where('parent_id', $parent_id)
                    ->where('display', '1')
                    ->get();
                    // ->toJson(JSON_PRETTY_PRINT);

        return view('admin/category/show',[
            'parent_id'=>$parent_id,
            'categorys'=>$category,
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
            'image' => 'file|image|max:10240',
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
        return redirect('admin/category/'.$category->parent_id);
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
        return redirect()->back();
    }
    private function countSubItems($table,$id){
        $count=DB::table($table)
                ->where('parent_id',$id)
                ->where('display','1')
                ->count();
        return $count;
    }
}
