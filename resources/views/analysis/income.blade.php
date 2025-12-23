@extends('layouts.app')
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Uang Masuk (Income)</h2>
    <div class="bg-white p-6 rounded shadow">
        <p class="text-lg">Total Uang Masuk: <span class="font-bold text-green-600">Rp {{ number_format($income,0,',','.') }}</span></p>
    </div>
</div>
@endsection
