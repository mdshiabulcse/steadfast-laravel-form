<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EventMemberRegistration;
use App\Models\Organization;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function adminDashboard()
    {
        $data['registerMember'] = EventMemberRegistration::where('status', 1)->with(['category', 'organizer'])->get();
        $data['organizer'] = Organization::all();
        $data['category'] = Category::all();
        return view('admin-dashboard', $data);
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,name|string|max:255',
            'category_status' => 'required',
        ]);

        $saveData = new Category();
        $saveData->name = $request->category_name;
        $saveData->description = $request->category_description;
        $saveData->status = $request->category_status ?? 0;
        $saveData->save();
        return redirect()->back()->with('success', 'Category save Successfully');
    }

    public function categoryUpdate(Request $request,$id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,name|string|max:255',
            'category_status' => 'required',
        ]);

        $saveData = Category::find($id);
        $saveData->name = $request->category_name;
        $saveData->description = $request->category_description;
        $saveData->status = $request->category_status ?? 0;
        $saveData->save();
        return redirect()->back()->with('success', 'Category save Successfully');
    }


    public function organizerStore(Request $request)
    {
        $request->validate([
            'organizer_name' => 'required|unique:organizations,name|string|max:255',
            'organizer_status' => 'required',
        ]);

        $saveData = new Organization();
        $saveData->name = $request->category_name;
        $saveData->description = $request->organizer_description;
        $saveData->status = $request->organizer_status ?? 0;
        $saveData->save();
        return redirect()->back()->with('success', 'Category save Successfully');
    }

    public function organizerUpdate(Request $request,$id)
    {
        $request->validate([
            'organizer_name' => 'required|unique:organizations,name|string|max:255',
            'organizer_status' => 'required',
        ]);

        $saveData = Organization::find($id);
        $saveData->name = $request->category_name;
        $saveData->description = $request->organizer_description;
        $saveData->status = $request->organizer_status ?? 0;
        $saveData->save();
        return redirect()->back()->with('success', 'Category save Successfully');
    }
}
