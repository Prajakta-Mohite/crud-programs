@extends('app')

@section('content')
    <div class="card m-3">       
        <div class="card-body">
           
        <form action="{{ route('update-program') }}" method="post" >
                @csrf
            <table id="program_table" class="table table-bordered student_table">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Program Title</th>
                        <th>Type</th>
                        <th>Activity</th>
                        <th>Brief</th>
                    </tr>
                </thead>
                <tbody>
               
                    @foreach($data as $index => $item)
                    <tr>
                        <td>
                                                    <!-- <img src="{{ asset('Program/Image/' . $data->featured_image) }}" width="80" height="80" /> -->

                            {{$index + 1}}
                        </td>
                        <td>
                            <input type="hidden" name="program[{{$index}}][id]" value="{{ $item->id }}">
                            <input type="text" name="program[{{$index}}][title]" value="{{ $item->program_title }}">
                        </td>
                        <td>
                        <input type="text" name="program[{{$index}}][type]" value="{{ $item->type }}">    
                        </td>
                        <td>
                        <input type="text" name="program[{{$index}}][activities]" value="{{ $item->activities }}">       
                        </td>
                        <td>
                        <textarea name="program[{{$index}}][brief]" id="" cols="30" rows="4">{{ $item->brief_intro }}</textarea>    
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary">Submit</button>
        </form>
            
           
        </div>
    </div>
@endsection