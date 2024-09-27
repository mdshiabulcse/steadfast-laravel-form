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
                                            <button class="btn btn-secondary">Share Url</button>
                                        </div>
                                    </td>
                                <tr>
                                    @empty
                                        <p>No Data found.</p>
                                    @endforelse

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <br><br>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="register-area">
                            <div class="container">
                                <form id="memberCategoryForm" class="register-form-area">
                                    @csrf
                                    <h3 class="event-name">Category</h3>
                                    <input type="hidden" value="" id="category_id" name="category_id">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="category_name">Category Name*</label>
                                                <input type="text" name="category_name" id="category_name"
                                                       class="form-control" placeholder="Category Name"
                                                       value="{{ old('category_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="category_description">Description*</label>
                                                <input type="text" name="category_description" id="category_description"
                                                       class="form-control" placeholder="Description"
                                                       value="{{ old('category_description') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="category_status">Status*</label>
                                                <select id="category_status" name="category_status" class="form-select">
                                                    <option selected disabled>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12 mt-3">
                                            <button class="btn btn-primary" id="saveButton">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <h4>Category List</h4>
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($category as $catValue)
                                <tr>
                                    <th scope="row">{{$loop->iteration }}</th>
                                    <td>{{$catValue->name}}</td>
                                    <td>{{$catValue->description}}</td>
                                    <td>{{$catValue->status == 1 ? 'Active':'Inactive'}}</td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <button class="btn btn-secondary"
                                                    onclick="editMemberCategory({{$catValue->id}})"> Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>No Data found.</p>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="register-area">
                            <div class="container">
                                <form id="memberOrganizerForm" class="register-form-area">
                                    @csrf
                                    <h3 class="event-name">Organizer</h3>
                                    <input type="hidden" value="" id="organizer_id" name="organizer_id">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="organizer_name">Organizer Name*</label>
                                                <input type="text" name="organizer_name" id="organizer_name"
                                                       class="form-control" placeholder="Organizer Name"
                                                       value="{{ old('organizer_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="organizer_description">Description*</label>
                                                <input type="text" name="organizer_description"
                                                       id="organizer_description" class="form-control"
                                                       placeholder="Description"
                                                       value="{{ old('organizer_description') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="organizer_status">Status*</label>
                                                <select id="organizer_status" name="organizer_status"
                                                        class="form-select">
                                                    <option selected disabled>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12 mt-3">
                                            <button class="btn btn-primary" id="saveOrganizer">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <h4>Organization List</h4>
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($organizer as $orgValue)
                                <tr>
                                    <th scope="row">{{$loop->iteration }}</th>
                                    <td>{{$orgValue->name}}</td>
                                    <td>{{$orgValue->description}}</td>
                                    <td>{{$orgValue->status == 1 ? 'Active':'Inactive'}}</td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <button onclick="editMemberOrganizer({{$orgValue->id}})"
                                                    class="btn btn-secondary"> Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>No Data found.</p>
                            @endforelse


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#saveOrganizer').on('click', function (e) {
                e.preventDefault();
                let formData = $('#memberOrganizerForm').serialize();
                let url;
                let method;
                let organizerId = $('#organizer_id').val();
                if (organizerId) {
                    url = '{{route('organizer-update',':id')}}'.replace(':id', organizerId),
                        method = 'PUT'
                } else {
                    url = "{{route('organizer-store')}}";
                    method = 'POST';
                }
                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function (response) {
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            Object.values(xhr.responseJSON.errors).forEach(function (error) {
                                toastr.error(error[0]);
                            })
                        } else {
                            toastr.error('Something went wrong!');
                        }

                    }
                })
            })
        })
        $(document).ready(function () {
            $('#saveButton').on('click', function (e) {
                e.preventDefault();
                let formData = $('#memberCategoryForm').serialize();
                let url;
                let method;
                let categoryId = $('#category_id').val();
                if (categoryId) {
                    url = '{{route('category-update',':id')}}'.replace(':id', categoryId),
                        method = 'PUT'
                } else {
                    url = "{{route('category-store')}}";
                    method = 'POST';
                }
                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function (response) {
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            Object.values(xhr.responseJSON.errors).forEach(function (error) {
                                toastr.error(error[0]);
                            })
                        } else {
                            toastr.error('Something went wrong!');
                        }

                    }
                })
            })

        })


        function editMemberCategory(id) {
            console.log(id)
            $.ajax({
                url: "/category-show/" + id,
                type: 'GET',
                success: function (response) {
                    let data = response.data;
                    $('#category_id').val(data.id);
                    $('#category_name').val(data.name);
                    $('#category_description').val(data.description);
                    $('#category_status').val(data.status);
                }
            })
        }

        function editMemberOrganizer(id) {
            console.log(id)
            $.ajax({
                url: "/organizer-show/" + id,
                type: 'GET',
                success: function (response) {
                    let data = response.data;
                    $('#organizer_id').val(data.id);
                    $('#organizer_name').val(data.name);
                    $('#organizer_description').val(data.description);
                    $('#organizer_status').val(data.status);
                }
            })
        }
    </script>
@endsection
