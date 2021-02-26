@extends('layouts.app', ['viewComposer' => $freelancerComposer])

@section('content')
<f-chat  :group="{{$group}}" :id="{{Auth::user()->id}}" :type="{{Auth::user()->type}}"></f-chat>

@endsection