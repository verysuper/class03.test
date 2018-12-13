<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use App\Entity\Category;
use App\Entity\Merchandise;

class ShopController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id=0)
    {
        $parent = null;
        $child = null;
        $filter=[];
        $category = Category::where('display', '1')
                                    ->get();
        $collectCategory = $category->groupBy(function ($item, $key){
            return $item['parent_id'];
        });
        $found = $collectCategory->filter(function ($value, $key) use ($parent_id){
            return $key == $parent_id;
        })->all();
        if(count($found)>0){
            $parent = $found[$parent_id]->filter(function ($value, $key){
                return $value['sub_qty'] > 0;
            })->sortByDesc('updated_at');
            $parent->each(function ($item) use (&$filter) {
                $filter[]=$item->id;
            });
        }else{
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'msg'=> '暫無商品',
                    ]);
        }
        if($parent_id > 0){
            //商品
            $found = Merchandise::where('display', '1')
                                ->whereIn('parent_id', $filter)
                                ->orderBy('updated_at', 'desc')
                                ->get();
            if(count($found)>0){
                $child = $found;
            }else{
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'msg'=> '暫無商品',
                        ]);
            }
        }else{
            //類別
            $child = $category->whereIn('parent_id', $filter)
                                ->sortByDesc('updated_at');
        }
        return view('shop.index',[
            'parents'=>$parent,
            'childs'=>$child,
            'parent_id'=>$parent_id,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
