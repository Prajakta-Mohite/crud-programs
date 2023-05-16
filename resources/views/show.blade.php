@extends('app')

@section('content')
    <div class="card m-3">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-3"></div>
            <div class="col-3 mt-2"><a class="btn btn-primary" href="{{ route('add-program') }}">Add Pragram</a></div>
        </div>
        
        <div class="card-body">
            <table id="program_table" class="table table-bordered student_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Program Title</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Activity</th>
                        <th>Brief</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script>
   @section('slug')
    $(function () {
        alert("heloo");
    $('#program_table').DataTable({
    "order": [0, 'desc'],
    "processing": true,
    "serverSide": true,
    "searching": true,
    "ajax": "{{ route('show-program') }}",
    "columnDefs": [
    {
    "targets": [ 0 ],
    "visible": false,
    "searchable": true
    },
    ],
    "columns":[
    { data: "id" },
    { data: "program_title" },
    { data: "program_title" },
    { data: "program_title" },
    { data: "program_title" },
    { data: "program_title" },
        ]
    });
    });
@endsection 
</script>
@endsection

