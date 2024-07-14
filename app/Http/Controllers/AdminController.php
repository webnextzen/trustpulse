<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\EmployeeProfile;
use App\Models\feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCompanyProfile()
    {
        $companyProfiles = Company::latest()->get();
        return view('admin.all_company', compact('companyProfiles'));
    }
    public function allCategory()
    {
        $categories = Category::latest()->get();
        return view('admin.all_category', compact('categories'));
    }

    public function allEmployeeProfile()
    {
        $employeeProfiles = EmployeeProfile::latest()->get();
        return view('admin.all_employee', compact('employeeProfiles'));
    }
    public function allfeedback(){
        $feedbacks = Feedback::with('employee', 'company')->get();
        return view('admin.all_feedback', compact('feedbacks'));
    }
}
