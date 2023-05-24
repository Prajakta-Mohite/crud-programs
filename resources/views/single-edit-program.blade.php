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
            <h5 class="page-title mt-2">Edit Program</h5>
            <div class="card p-3 mt-3">
                <form id="quickForm" action="{{route('single-update-program',$data->id)}}" method="POST" accept-charset="utf-8"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-3">
                            <input type="text" name="title" class="form-control program_title" autocomplete="off"
                             value="{{$data->program_title}}"   placeholder="Program Title">
                        </div>
                        <div class="col-12 mt-3"> <input type="text" name="type" class="form-control program_type"
                        value="{{$data->type}}"   autocomplete="off" placeholder="Program Type"></div>
                        <div class="col-12 mt-3"><input type="text" name="activities"
                        value="{{$data->activities}}"   class="form-control program_activities" autocomplete="off"
                                placeholder="Program Activities"></div>
                        <div class="col-12 mt-3"> 
                        <img src="{{ asset('Program/Image/' . $data->featured_image) }}" width="80" height="80" />
                            <input type="file" name="images" class="form-control mb-3 mt-2 program_image">
                        </div>
                        <div class="col-12 mt-3"> <textarea class="form-control mb-3 program_brief"
                                name="brief">{{$data->brief_intro}}</textarea></div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @endsection