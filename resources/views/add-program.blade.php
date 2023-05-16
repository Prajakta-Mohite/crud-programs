@extends('app')

@section('content')
<div class="card m-3">
    <div class="row">
        <div class="col-6"></div>
        <div class="col-3"></div>
        <div class="col-3 mt-2"></div>
    </div>

    <div class="card-body">
        <div class="">
            <a class="back-btn" href="{{ route('home') }}">Back</a>
            <h5 class="page-title mt-2">Add Pragram</h5>
            <div class="card p-3 mt-3">
                <div class="alert alert-warning">
                    All fields are required !
                </div>
              

                <div class="my-2">
                    <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                </div>
                <form id="quickForm" action="{{ route('store-program') }}" method="POST" accept-charset="utf-8"
                    enctype="multipart/form-data">
                    @csrf
                    <table id="gallery_table" class="table table-bordered student_table">
                        <thead>
                            <tr>
                                <th>Program Title</th>
                                <th>Type</th>
                                <th>Activity</th>
                                <th>Image</th>
                                <th>Brief</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamicTable">                          
                            <tr>
                                <td>
                                    <input type="text" name="program[0][title]" value="{{ old('program.0.title') }}"  class="form-control" autocomplete="off"
                                        placeholder="Program Title">
                                    @error('program.0.title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" name="program[0][type]"  value="{{ old('program.0.type') }}" class="form-control" autocomplete="off"
                                        placeholder="Program Type">
                                    @error('program.0.type')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" name="program[0][activities]" class="form-control"  value="{{ old('program.0.activities') }}"
                                        autocomplete="off" placeholder="Program Activities">
                                    @error('program.0.activities')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </td>
                                <td>
                                    <input type="file" name="program[0][images]" value="{{ old('program.0.images') }}" class="form-control mb-3">
                                    @error('program.0.images')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    
                                </td>
                                <td>
                                    <textarea class="form-control mb-3"  value="{{ old('program.0.brief') }}" name="program[0][brief]"></textarea>
                                    @error('program.0.brief')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </td>
                                <td></td>
                            </tr>
                            <!-- Rest of the code -->
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <!-- Rest of the code -->
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
    $(document).ready(function() {
        var i = 0;

        $("#add").click(function() {
            ++i;

            $("#dynamicTable").append(`<tr><td><input type="text" name="program[+i+][title]" value="{{ old('program.+i+.title') }}"  class="form-control" autocomplete="off" placeholder="Program Title">@error('program.+i+.title')<p class="text-danger">{{ 'title field is required' }}</p>@enderror</td><td><input type="text" name="program[+i+][type]"  value="{{ old('program.+i+.type') }}" class="form-control" autocomplete="off" placeholder="Program Type">@error('program.+i+.type')<p class="text-danger">{{ $message }}</p>@enderror</td><td><input type="text" name="program[+i+][activities]" class="form-control"  value="{{ old('program.+i+.activities') }}" autocomplete="off" placeholder="Program Activities">@error('program.+i+.activities')<p class="text-danger">{{ $message }}</p>@enderror</td><td><input type="file" name="program[+i+][images]" value="{{ old('program.+i+.images') }}" class="form-control mb-3">@error('program.+i+.images')<p class="text-danger">{{ $message }}</p>@enderror</td><td><textarea class="form-control mb-3"  value="{{ old('program.+i+.brief') }}" name="program[+i+][brief]"></textarea>@error('program.+i+.brief')<p class="text-danger">{{ $message }}</p>@enderror</td><td></td><td><button type="button"  class="btn btn-danger remove-tr btn-sm">Remove</button></td></tr>`
);

        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    });
    </script>

    @endsection