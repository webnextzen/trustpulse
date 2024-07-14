<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        //$categories = Category::all();
        return view('category.create');
    }

    public function store(Request $request)
    {
       //return $request;
        // dd($request->all());
        $request->validate([
            'category_name' => 'required|string',
        ]);
        $user = Auth::user();
       


        //$user = Auth::user()->admin;
        // dd($user);
        if ($user->type==1) {

            Category::create([
                'category_name' => $request->category_name,
                        ]);

            return redirect()->route('admin.all_category')->with('success', 'Category added successfully.');

        }
        else{
            return redirect()->route('employee_profile.create')->withErrors('Employee profile not found.');
        }


    }
}
