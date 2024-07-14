<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use App\Models\Category;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $profile = Company::where('user_id', auth()->id())->first();
        return view('company_profile.index', compact('profile'));
    }


    public function create()
    {
        $profile = Company::where('user_id', auth()->id())->first();
        $categories = Category::all();
        if ($profile !== null) {
            return view('company_profile.index', compact('profile', 'categories'));
        } else {
            return view('company_profile.create', compact('categories'));
        }
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'tagline' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'founded_date' => 'nullable|date',
            'headquarters_location' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|integer',
            'website_url' => 'nullable|url|max:255',
            'email_address' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'overview' => 'nullable|string',
            'history' => 'nullable|string',
            'core_values' => 'nullable|string',
            'category_id' => 'nullable|integer',
        ]);

        // if ($request->hasFile('logo')) {
        //     $image = $request->file('logo');
        //     $fileNameToStore = 'post_image_' . md5((uniqid())) . time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $fileNameToStore);
        // }
        if ($image = $request->file('logo')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }


        // Add the current user's ID to the data array
        $data['user_id'] = auth()->id();

        Company::create($data);

        return redirect()->route('company_profile.index');
    }

    public function edit(Company $companyProfile)
    {
        $categories = Category::all();
        return view('company_profile.edit', compact('companyProfile', 'categories'));
    }


    public function update(Request $request, Company $companyProfile)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'logo' => 'nullable|image|max:2048',
            'tagline' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'founded_date' => 'nullable|date',
            'headquarters_location' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|integer',
            'website_url' => 'nullable|url|max:255',
            'email_address' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'overview' => 'nullable|string',
            'history' => 'nullable|string',
            'core_values' => 'nullable|string',
        ]);

        // Initialize $fileNameToStore with the current logo to handle cases where no new logo is uploaded
        $fileNameToStore = $companyProfile->logo;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileNameToStore = 'post_image_' . md5(uniqid()) . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images'), $fileNameToStore);

            // Update the logo attribute only if a new file is uploaded
            $companyProfile->logo = $fileNameToStore;
        }

        // Save changes to the company profile
        $companyProfile->save();

        // Update the company profile with the validated data
        $companyProfile->update($data);

        return redirect()->route('company_profile.index');
    }
    public function feedback($id)
    {
        $company = Company::with('feedbacks.employee')->findOrFail($id);
        return view('company_profile.feedback', compact('company'));
    }
}
