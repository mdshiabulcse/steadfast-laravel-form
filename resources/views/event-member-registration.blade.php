@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Category</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Transaction</th>
                                <th scope="col">Method</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($registerMember as $member)
                                <tr>
                                    <th scope="row">{{$loop->iteration }}</th>
                                    <td>{{$member->first_name}}</td>
                                    <td>{{$member->last_name}}</td>
                                    <td>{{$member->dob}}</td>
                                    <td>{{$member->gender}}</td>
                                    <td>{{$member->email}}</td>
                                    <td>{{$member->address}}</td>
                                    <td>{{$member->category->name}}</td>
                                    <td>{{@$member->organizer->name}}</td>
                                    <td>{{$member->payment_transaction_id}}</td>
                                    <td>{{$member->payment_method}}</td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <a class="btn btn-warning" href="{{route('member-profile',['memberId' => $member->id, 'memberName' => $member->first_name])}}"> View</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No data found</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <br><br>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="register-area">
                            <div class="container">

                                <form id="register-form" class="register-form-area" method="POST"
                                      action="{{route('member-registration-store')}}">
                                    @csrf
                                    <h3 class="event-name">Event Member Registration</h3>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="f-name">First Name*</label>
                                                <input type="text" name="first_name" id="f-name" class="form-control"
                                                       placeholder="First Name" value="{{ old('first_name') }}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="l-name">Last Name*</label>
                                                <input type="text" name="last_name" id="l-name" class="form-control"
                                                       placeholder="Last Name" value="{{ old('last_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="email">Email*</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                       placeholder="Your Email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="dob">Date Of Birth*</label>
                                                <input type="date" id="dob" name="dob" class="form-control"
                                                       value="{{ old('dob') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <p class="form-label">Gendar*</p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                           id="inlineRadio1"
                                                           value="male">
                                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                           id="inlineRadio2"
                                                           value="female">
                                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                           id="inlineRadio3"
                                                           value="other">
                                                    <label class="form-check-label" for="inlineRadio3">Other</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="address">Address*</label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                       placeholder="Address" value="{{ old('address') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <p class="form-label">Member Category*</p>
                                                <select name="member_category_id" class="form-select"
                                                        aria-label="Default select example">
                                                    <option selected disabled>Select Category</option>
                                                    @foreach($category as $value)
                                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <p class="form-label">Member Category</p>
                                                <select name="organizer_id" class="form-select"
                                                        aria-label="Default select example">
                                                    <option selected disabled>Select Organizer</option>
                                                    @foreach($organizer as $value)
                                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="transaction-id">Transaction ID*</label>
                                                <input type="text" name="payment_transaction_id" id="transaction-id"
                                                       class="form-control" value="{{ old('payment_transaction_id') }}"
                                                       placeholder="Transaction ID">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="payment-method">Payment Method*</label>
                                                <select id="payment-method" name="payment_method" class="form-select"
                                                        aria-label="Select Payment Method">
                                                    <option selected disabled>Select Payment Method</option>
                                                    <option value="card">Credit Card</option>
                                                    <option value="paypal">Bkash</option>
                                                    <option value="bank">Bank Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12 mt-3">
                                            <button class="btn btn-primary" type="submit">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="register-area">
                            <div class="container">

                                <form action="{{route('short-url-store')}}" method="POST">
                                    @csrf
                                    <div class="col-lg-12 col-sm-12 col-12 mt-3 form-group">
                                        <label for="original_url">Original URL</label>
                                        <input type="url" class="form-control" name="original_url" required>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-12 mt-3">
                                        <button class="btn btn-primary" type="submit">SHORT URL</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Orginal URL</th>
                                <th scope="col">Short url</th>
                                <th scope="col">Count</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($urlList as $urlValue)
                                <tr>
                                <tr>
                                    <td>{{ $urlValue->original_url }}</td>
                                    <td><a href="{{ url($urlValue->short_url) }}">{{ url($urlValue->short_url) }}</a></td>
                                    <td>{{ $urlValue->click_count }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td>No data found</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
