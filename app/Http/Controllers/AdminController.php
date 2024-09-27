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
        $validation = $request->validate([
            'category_name' => 'required|unique:categories,name|string|max:255',
            'category_status' => 'required',
        ]);

        try {

            $saveData = new Category();
            $saveData->name = $validation['category_name'];
            $saveData->description = $request->category_description;
            $saveData->status = $validation['category_status'];
            $saveData->save();
            return response()->json(['message' => 'Category added successfully!']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }

    }

    public function categoryShow($id)
    {
        $data = Category::find($id);
        return response()->json(['data' => $data]);
    }

    public function categoryUpdate(Request $request, $id)
    {
        $validation = $request->validate([
            'category_status' => 'required',
        ]);

        try {
            $saveData = Category::find($id);
            $saveData->name = $request->category_name;
            $saveData->description = $request->category_description;
            $saveData->status = $validation['category_status'];
            $saveData->save();
            return response()->json(['message' => 'Category update successfully!']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
    }


    public function organizerStore(Request $request)
    {

        $validation = $request->validate([
            'organizer_name' => 'required|unique:categories,name|string|max:255',
            'organizer_status' => 'required',
        ]);

        try {

            $saveData = new Organization();
            $saveData->name = $validation['organizer_name'];
            $saveData->description = $request->organizer_description;
            $saveData->status = $validation['organizer_status'];
            $saveData->save();
            return response()->json(['message' => 'Organizer added successfully!']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }

    }

    public function organizerShow($id)
    {
        $data = Organization::find($id);
        return response()->json(['data' => $data]);
    }

    public function organizerUpdate(Request $request, $id)
    {
        $validation = $request->validate([
            'organizer_status' => 'required',
        ]);

        try {
            $saveData = Organization::find($id);
            $saveData->name = $request->organizer_name;
            $saveData->description = $request->organizer_description;
            $saveData->status = $validation['organizer_status'];
            $saveData->save();
            return response()->json(['message' => 'Organizer update successfully!']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
    }
}
