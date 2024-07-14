<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;
use App\Models\feedback;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('welcome', compact('categories'));
        //return view('welcome');
    }


    public function companylist($id)
    {
         //return $id;
         $companies = Company::where('category_id', $id)->get();

         return view('companies', compact('companies'));
    }

    public function reviws($id)
    {

        $companydetails = Company::where('id', $id)->first();
        $feedbacks = Feedback::where('company_id', $id)->with('employee')->get();
        $categorydetails = Category::where('id', $companydetails->category_id)->first();

         return view('reviws', compact('companydetails', 'feedbacks', 'categorydetails'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
