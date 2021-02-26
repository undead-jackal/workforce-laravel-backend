@extends('layouts.app', ['viewComposer' => $freelancerComposer])

@section('content')
<job-freelancer :jobs="{{$jobs}}"></job-freelancer :jobs="{{$jobs}}">

@endsection