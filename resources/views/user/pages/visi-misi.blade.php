@extends('user.layout')

@section('title', 'Visi & Misi | UAB Portal')

@section('content')
    @include('shared.visi-misi-content', ['content' => $content ?? []])
@endsection
