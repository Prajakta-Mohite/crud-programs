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
                <form id="quickForm" action="{{route('store-program')}}" method="POST" accept-charset="utf-8"
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
                                    <input type="text" name="title[]" 
                                        class="form-control program_title" autocomplete="off" placeholder="Program Title">
                                </td>
                                <td>
                                    <input type="text" name="type[]"
                                        class="form-control program_type" autocomplete="off" placeholder="Program Type">
                                </td>
                                <td>
                                    <input type="text" name="activities[]" class="form-control program_activities"
                                         autocomplete="off"
                                        placeholder="Program Activities">
                                </td>
                                <td>
                                    <input type="file" name="images[]" class="form-control mb-3 program_image">
                                </td>
                                <td>
                                    <textarea class="form-control mb-3 program_brief"  name="brief[]"></textarea>
                                    
                                </td>
                                <td>
                                    
                                </td>
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
            addValidationRules();
            ++i;

            $("#dynamicTable").append(
                `   <tr>
                                <td>
                                    <input type="text" name="title[]" 
                                        class="form-control program_title" autocomplete="off" placeholder="Program Title">
                                </td>
                                <td>
                                    <input type="text" name="type[]"
                                        class="form-control program_type" autocomplete="off" placeholder="Program Type">
                                </td>
                                <td>
                                    <input type="text" name="activities[]" class="form-control program_activities"
                                         autocomplete="off"
                                        placeholder="Program Activities">
                                </td>
                                <td>
                                    <input type="file" name="images[]" class="form-control mb-3 program_image">
                                </td>
                                <td>
                                    <textarea class="form-control mb-3 program_brief"  name="brief[]"></textarea>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>`
            );
           
        });
        
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    });

 
        function addValidationRules(){
            $('.program_title').each((i,e)=>{
                $(e).rules("add",{required:true})
            });  
            $('.program_type').each((i,e)=>{
                $(e).rules("add",{required:true})
            });  
            $('.program_activities').each((i,e)=>{
                $(e).rules("add",{required:true})
            });  
            $('.program_image').each((i,e)=>{
                $(e).rules("add",{required:true,extension: "jpg|jpeg|png"})
            });   
            $('.program_brief').each((i,e)=>{
                $(e).rules("add",{required:true})
            });  
        }
        $('#quickForm').validate();
        addValidationRules();
       
    
   
   </script>

    @endsection