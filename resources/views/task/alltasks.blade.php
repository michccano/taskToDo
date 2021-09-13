@extends('layouts.app')

@section('title', "All Tasks")
@section('content')

<div id="app">
<alltasks-component :api-data="{{$api_data}}"></alltasks-component>
</div>

@endsection

