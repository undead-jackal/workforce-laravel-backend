@extends('layouts.app', ['viewComposer' => $coordinatorComposer])

@section('content')
    <h4>Employer Invited You</h4>
    <jobs-invitaion :myinvites="{{json_encode($myinvites)}}"></jobs-invitaion>
@endsection
