<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Merchandise;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function show($category_id = 0)
    {
        $merchandise = Merchandise::orderBy('updated_at', 'desc')
                    ->where('category_id', $category_id)
                    ->where('display', '1')
                    ->get();
                    // ->toJson(JSON_PRETTY_PRINT);
        //新增商品時會更新該項子項目數量
        return view('admin/merchandise/show',[
            'category_id'=>$category_id,
            'merchandise'=>$merchandise,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchandise $merchandise)
    {
        //
    }
}
