@extends('layouts.app', ['viewComposer' => $freelancerComposer])

@section('content')
<h5>My Jobs</h5>
<my-job-list :jobs="{{json_encode($data)}}"></my-job-list>

@endsection