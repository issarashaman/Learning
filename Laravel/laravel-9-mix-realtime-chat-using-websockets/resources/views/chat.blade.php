@extends('layouts.app')

@section('content')
<chat-component :user="{{ Auth::user() }}"/>
@endsection
