<?php

namespace App\Http\Controllers;

use App\Models\categeryMaster;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Products::paginate(20);
        $categories = categeryMaster::pluck('name', 'id');
        return view('products.list', compact(['data', 'data'],['categories','categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = categeryMaster::pluck('name', 'id');
        return view('products.create', compact('categories', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name'=>'required',
            'categery'=>'required',
            'price'=>'required',
            'qty'=>'required'
        ]);

        // print_r($data);exit;
        $obj = new Products();
        $obj->name = $request->post('name');
        $obj->categery = $request->post('categery');
        $obj->description = $request->post('description');
        $obj->price = $request->post('price');
        $obj->qty = $request->post('qty');
        $data = $obj->save();

        return redirect(config("base_url") . '/products')->with("msg", "Product added Successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Products::find($id);
        $categories = categeryMaster::pluck('name', 'id');

        return view('products.edit', compact(['data', 'data'],['categories','categories']));
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
        $data = $request->all();
        $request->validate([
            'name'=>'required',
            'categery'=>'required',
            'price'=>'required',
            'qty'=>'required'
        ]);

        // print_r($data);exit;
        $obj = Products::find($id);
        $obj->name = $request->post('name');
        $obj->categery = $request->post('categery');
        $obj->description = $request->post('description');
        $obj->price = $request->post('price');
        $obj->qty = $request->post('qty');
        $data = $obj->update();

        return redirect(config("base_url") . '/products')->with("msg", "Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Products::find($id)->delete();
        return redirect(config("base_url") . '/products')->with("msg", "Product deleted Successfully");

    }
}
