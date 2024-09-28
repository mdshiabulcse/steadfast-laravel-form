<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EventMemberRegistration;
use App\Models\Organization;
use App\Models\UrlShort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $member = EventMemberRegistration::query();
        if (!Auth::check() || (Auth::check() && !Auth::user()->existRole('admin'))) {
            $member->where('user_id', $user_id);
        }
        $data['registerMember'] = $member->with(['organizer', 'category'])->get();
        $data['category'] = Category::where('status', 1)->get();
        $data['organizer'] = Organization::where('status', 1)->get();
        $data['urlList'] = UrlShort::all();

        return view('home',$data);
    }


    public function eventMemberFormRegistration()
    {
        $user_id = Auth::user()->id;
        $member = EventMemberRegistration::query();
        if (!Auth::check() || (Auth::check() && !Auth::user()->existRole('admin'))) {
            $member->where('user_id', $user_id);
        }
        $data['registerMember'] = $member->with(['organizer', 'category'])->get();
        $data['category'] = Category::where('status', 1)->get();
        $data['organizer'] = Organization::where('status', 1)->get();
        $data['urlList'] = UrlShort::all();
        return view('event-member-registration', $data);
    }

    public function eventMemberFormRegistrationStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'dob' => 'required|date',
            'gender' => 'required',
            'member_category_id' => 'required',
        ]);

        $saveData = new EventMemberRegistration();
        $saveData->first_name = $request->first_name;
        $saveData->last_name = $request->last_name;
        $saveData->dob = $request->dob;
        $saveData->gender = $request->gender;
        $saveData->email = $request->email;
        $saveData->address = $request->address;
        $saveData->member_category_id = $request->member_category_id;
        $saveData->organizer_id = $request->organizer_id;
        $saveData->payment_transaction_id = $request->payment_transaction_id ?? null;
        $saveData->payment_method = $request->payment_method ?? null;
        $saveData->user_id = Auth::user()->id;
        $saveData->save();


        return redirect()->back()->with('success', 'Member Registration Successfully');
    }



    public function shortUrlStore(Request $request){
        $request->validate([
            'original_url' => 'required|unique:url_shorts,original_url|',
        ]);

        do {
            $shortUrl = Str::random(6);
        } while (UrlShort::where('short_url', $shortUrl)->exists());

        $saveData = new UrlShort();
        $saveData->original_url = $request->original_url;
        $saveData->short_url =$shortUrl;
        $saveData->user_id = Auth::user()->id;
        $saveData->save();
        return redirect()->back()->with('success', 'Save Successfully');
    }

    public function redirectToUrl($shortUrl)
    {
        $urlSort = UrlShort::where('short_url', $shortUrl)->firstOrFail();
        $urlSort->increment('count_click');
        return redirect()->to($urlSort->original_url);

    }


}
