<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Owner;
use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view("items.index",compact('items'));
    }

    public function ssd()
    {
        $items = Item::query();
        return Datatables::of($items)
        ->setRowClass(function ($item) {
            return 'whitespace-nowrap';
        })
        ->editColumn('category_id',function($item){
            return $item->category->title;
        })
        ->editColumn('excerpt',function($item){
            return htmlDecode($item->excerpt);
        })
        ->editColumn('price',function($item){
            return "$".$item->price;
        })
        ->editColumn('owner_id',function($item){
            return $item->owner->name;
        })
        ->editColumn('status',function($item){
            $status_btn = '<div class="w-full mb-1">
                            <label for="status-btn" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" '. ($item->status == "1" ? "checked" : "") .' data-id="'. $item->id .'" name="status" id="status-btn" class="sr-only">
                                    <div class="block bg-gray-600 status-box rounded-full"></div>
                                    <div class="dot absolute status-dot bg-white w-4 h-4 rounded-full transition"></div>
                                </div>
                            </label>
                        </div>';
            return $status_btn;
        })
        ->addColumn('action', function ($item){
            $edit_btn='<a href="'.route('items.edit',$item->id).'" class="bg-violet-600 p-2 rounded">
            <i class="fa-regular fa-pen-to-square text-white text-sm"></i>
            </a>';

            $delete_btn='<a href="'.route('items.destroy',$item->id).'" data-id="'. $item->id .'" id="delete-btn" class="status-btn bg-red-600 p-2 rounded">
            <i class="fa-regular fa-trash-can text-white text-sm"></i>
            </a>';

            return '<div class="action-btn">' . $edit_btn . $delete_btn . '</div>';
        })
        ->rawColumns(["status","action"])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("items.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        // return $request;
        // return textFilter($request->description);

        DB::beginTransaction();
        try {
            $owner = new Owner();
            $owner->name = $request->owner_name;
            $owner->phone = $request->phone;
            $owner->address = $request->address;
            $owner->save();

            // return $owner->id;

            $item = new Item();
            $item->name = $request->name;
            $item->slug = Str::slug($request->name);
            $item->category_id = $request->category;
            $item->price = $request->price;
            $item->description = textFilter($request->description);
            $item->excerpt = Str::words(textFilter($request->description), 10, ' .....');
            $item->item_condition = $request->condition;
            $item->item_type = $request->type;
            
            if ($request->status == "on") {
                $item->status = "1";
            }
            
            if ($request->hasFile('photo')) {
                $fileName = uniqid()."_item_image.".$request->photo->extension();
                $request->photo->storeAs("public",$fileName);
                $item->item_photo = $fileName;
            }
            
            $item->user_id = Auth::id();
            $item->owner_id = $owner->id;

            $item->save();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
        }
        return redirect()->route('items.create')->with('status',"New Item is created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return redirect()->route("items.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view("items.edit",compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        DB::beginTransaction();
        try {
            $owner = Owner::where("id",$item->owner->id)->first();
            $owner->name = $request->owner_name;
            $owner->phone = $request->phone;
            $owner->address = $request->address;
            $owner->save();

            // return $owner->id;
            $item->name = $request->name;
            $item->slug = Str::slug($request->name);
            $item->category_id = $request->category;
            $item->price = $request->price;
            $item->description = textFilter($request->description);
            $item->excerpt = Str::words(textFilter($request->description), 10, ' .....');
            $item->item_condition = $request->condition;
            $item->item_type = $request->type;
            
            if ($request->status == "on") {
                $item->status = "1";
            }else{
                $item->status = "0";
            }
            
            if ($request->hasFile('photo')) {
                $fileName = uniqid()."_item_image.".$request->photo->extension();
                $request->photo->storeAs("public",$fileName);
                $item->item_photo = $fileName;
            }
            
            $item->user_id = Auth::id();
            $item->owner_id = $owner->id;

            $item->update();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
        }
        return redirect()->route('items.index')->with('status',"Item is updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item_owner_id = $item->owner_id;
        $item->delete();
        $owner = Owner::where("id",$item_owner_id)->first();
        $owner->delete();
        return "success";
    }
}
