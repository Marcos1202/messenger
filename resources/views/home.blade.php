@extends('layouts.app')

@section('content')
 <messenger-component :user="{{auth()->user()}}">
     
 </messenger-component>
@endsection
