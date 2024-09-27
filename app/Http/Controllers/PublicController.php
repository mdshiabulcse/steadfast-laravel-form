<?php

namespace App\Http\Controllers;

use App\Models\EventMemberRegistration;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function memberProfile($memberId,$memberName)
    {
        $data['member_profile']=EventMemberRegistration::where(['id'=>$memberId,'first_name'=>$memberName])->with(['category','organizer'])->first();
        return view('member-profile',$data);
    }


}
