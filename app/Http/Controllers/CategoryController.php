<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("categories.index");
    }

    public function ssd()
    {
        $categories = Category::query();
        return Datatables::of($categories)
        ->editColumn('status',function($category){
            $status_btn = '<div class="w-full mb-1">
                            <label for="status-btn" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" '. ($category->status == "1" ? "checked" : "") .' data-id="'. $category->id .'" name="status" id="status-btn" class="sr-only">
                                    <div class="block bg-gray-600 status-box rounded-full"></div>
                                    <div class="dot absolute status-dot bg-white w-4 h-4 rounded-full transition"></div>
                                </div>
                            </label>
                        </div>';
            return $status_btn;
        })
        ->addColumn('action', function ($category){
            $edit_btn='<a href="'.route('categories.edit',$category->id).'" class="bg-violet-600 p-2 rounded">
            <i class="fa-regular fa-pen-to-square text-white text-sm"></i>
            </a>';

            $delete_btn='<a href="'.route('categories.destroy',$category->id).'" data-id="'. $category->id .'" id="delete-btn" class="bg-red-600 p-2 rounded">
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
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        // return $request->status;

        DB::beginTransaction();
        try {

            // return $request;
            // Store category to the database
            $category = new Category();

            $category->title = $request->title;
            $category->user_id = Auth::id();
            if ($request->hasFile('photo')) {
                $fileName = uniqid()."_category_image.".$request->photo->extension();
                $request->photo->storeAs("public",$fileName);

                $category->photo = $fileName;
            }
            if ($request->status) {
                $category->status = "1";
            }
            $category->slug = Str::slug($request->title);

            $category->save();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
        }

        return redirect()->route('categories.create')->with('status',"New Category is created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("categories.edit",compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // return $request;
        DB::beginTransaction();
        try {
            // Update category to the database
            $category->title = $request->title;
            $category->user_id = Auth::id();
            if ($request->hasFile('photo')) {
                $fileName = uniqid()."_category_image.".$request->photo->extension();
                $request->photo->storeAs("public",$fileName);

                $category->photo = $fileName;
            }
            if ($request->status) {
                $category->status = "1";
            }else{
                $category->status = "0";
            }
            $category->slug = Str::slug($request->title);

            $category->update();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
        }

        return redirect()->route('categories.index')->with('status',"Category is updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // return $category;
        $category->delete();
        return "success";
    }
}
