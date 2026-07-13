@extends('user.layout')

@section('title', 'Beranda | UAB Portal')

@section('content')
<div style="display:flex;align-items:center;justify-content:center;min-height:calc(100vh - 140px);text-align:center;">
    <div>
        <img src="{{ asset('logo/Logo UAB.png') }}" alt="Logo UAB" style="max-width:220px;width:100%;height:auto;margin:0 auto 24px;display:block;">
        <h1>Website Resmi UAB UB</h1>
    </div>
</div>
@endsection
