@extends('layouts.app', ['viewComposer' => $employerComposer])

@section('content')
    <job-single-employer :job="{{json_encode($job['jobs'])}}"></job-single-employer>
@endsection
