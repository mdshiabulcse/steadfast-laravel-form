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


    public function adminDashboard(){
        $data['registerMember']=EventMemberRegistration::where('status',1)->with(['category','organizer'])->get();
        $data['organizer']=Organization::all();
        $data['category']=Category::all();
        return view('admin-dashboard',$data);
    }
}
