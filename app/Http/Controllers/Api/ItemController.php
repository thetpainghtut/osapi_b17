<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    public function __construct($value='')
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'status' => 'ok',
            'totalResults' => count($items),
            'items' => ItemResource::collection($items)
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
        // dd($request);

        // Validation
        $request->validate([
            "codeno" => 'required|min:4',
            "name" => 'required',
            "price" => 'required',
            "discount" => 'required',
            "description" => 'required',
            "photo" => 'required',
            "brand" => 'required',
            "subcategory" => 'required'
        ]);

    
        // If include file, upload file
        $imageName = time().'.'.$request->photo->extension();

        $request->photo->move(public_path('backend/itemimg'),$imageName);

        $path = 'backend/itemimg/'.$imageName;
        // Data insert
        $item = new Item;
        $item->codeno = $request->codeno;
        $item->name = $request->name;
        $item->photo = $path;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->description = $request->description;
        $item->brand_id = $request->brand;
        $item->subcategory_id = $request->subcategory;
        $item->save();

        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        // dd($request);

        // validation
        $request->validate([
            "codeno" => 'required|min:4',
            "name" => 'required',
            "price" => 'required',
            "discount" => 'required',
            "description" => 'required',
            "photo" => 'sometimes',
            "oldphoto" => 'required',
            "brand" => 'required',
            "subcategory" => 'required'
        ]);

        // file upload, if data
        if ($request->hasFile('photo')) {
           $imageName = time().'.'.$request->photo->extension();

            $request->photo->move(public_path('backend/itemimg'),$imageName);

            $path = 'backend/itemimg/'.$imageName; 
        }else{
            $path = $request->oldphoto;
        }

        // data update
        $item->codeno = $request->codeno;
        $item->name = $request->name;
        $item->photo = $path;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->description = $request->description;
        $item->brand_id = $request->brand;
        $item->subcategory_id = $request->subcategory;
        $item->save();

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return new ItemResource($item);
    }
}
