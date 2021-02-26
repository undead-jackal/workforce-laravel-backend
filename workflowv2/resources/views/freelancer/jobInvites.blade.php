@extends('layouts.app', ['viewComposer' => $freelancerComposer])

@section('content')
    <invites :invites="{{$invites}}" :user="{{auth()->user()->id}}"></invites>
@endsection
