@extends('layouts.app', ['viewComposer' => $coordinatorComposer])

@section('content')
<c-chat :id="{{Auth::user()->id}}"></c-chat>
@endsection
