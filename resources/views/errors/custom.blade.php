@extends('errors::illustrated-layout')

@section('title', 'Метод не может быть запущен')
@section('code')
  {{$code}}
@endsection
@section('message')
  {{$message}}
@endsection
