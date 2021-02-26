@extends('layouts.app', ['viewComposer' => $employerComposer])

@section('content')
    <job-posted :jobs="{{json_encode($jobs)}}"></job-posted>
@endsection
