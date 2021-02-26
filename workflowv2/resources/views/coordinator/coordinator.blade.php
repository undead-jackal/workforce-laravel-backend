@extends('layouts.app', ['viewComposer' => $coordinatorComposer])

@section('content')
    <h4>My Jobs</h4>
    <jobs-coordinator :jobs="{{json_encode($jobs)}}"></jobs-coordinator>
@endsection
