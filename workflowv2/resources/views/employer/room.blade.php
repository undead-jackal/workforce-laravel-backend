@extends('layouts.app', ['viewComposer' => $employerComposer])

@section('content')
    <room :job_id="{{$job}}"></room>
@endsection
