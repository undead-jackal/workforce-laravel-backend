@extends('layouts.app', ['viewComposer' => $employerComposer])

@section('content')
<e-chat group="{{$group}}" :id="{{Auth::user()->id}}"></e-chat>
@endsection
