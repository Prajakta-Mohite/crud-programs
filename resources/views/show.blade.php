@extends('app')

@section('content')
    <div class="card m-3">
        <div class="row">
            <div class="col-3 mt-2">
                <a class="btn btn-primary" href="{{ route('add-program') }}">Add Pragram</a>
                <a class="btn btn-primary update_program" >Update</a>
                <a class="btn btn-danger delete_program" >Delete</a>
            </div>
            <div class="col-9"></div>
        </div>
        
        <div class="card-body">
            <table id="program_table" class="table table-bordered student_table">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Program Title</th>
                        <th>Type</th>
                        <th>Activity</th>
                        <th>Brief</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')

<script>
        $(document).ready(function () {
            $('#program_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('show-program') }}",
                columns: [
                    { data: "checkbox" },
                    { data: "count" },
                    { data: "image" },
                    { data: "program_title" },
                    { data: "type" },
                    { data: "activities" },
                    { data: "brief_intro" },
                    { data: "action" },
                ]
            });
        });

        var checkedArray = [];
        $(document).on('change', '.checkbox-input', function() {
            var checked = $(this).is(':checked');
            var value = parseInt($(this).val());

            if (checked) {
                checkedArray.push(value);
            } else {
                var index = checkedArray.indexOf(value);
                if (index > -1) {
                    checkedArray.splice(index, 1);
                }
            }
            
        });

        $(document).on('click', '.update_program', function() {

            console.log("checkedArray",checkedArray)
            if(checkedArray.length > 0 )
            {
                window.location.href = '/edit-program?checkedArray=' + checkedArray.join(',');

               
            }else{
                toastr.error("Select the checkbox  you want to update");
            }


        });
       


        $(document).on('click', '.delete_program', function() {

            console.log("checkedArray",checkedArray)
            if(checkedArray.length > 0 )
            {
                let url = "delete-program";
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': csrfToken
                    },
                    url: url,
                    type: 'POST',
                    data: { checkedArray: checkedArray },
                    success: function(response) {
                        if(response.statuscode == 200)
                        {
                                toastr.success(response.message);
                                window.location.href = "/";
                                setTimeout(() => {
                                            location.reload();
                                }, 5000);   
                        }
                    
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                         
                    }
                });

            }else{
                toastr.error("Select the checkbox  you want to delete");
            }

   
        });

      

    </script>

@endsection

