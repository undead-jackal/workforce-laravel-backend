@extends('layouts.app', ['viewComposer' => $coordinatorComposer])

@section('content')
    <coor-room :job_id={{$job}}></coor-room>
@endsection
