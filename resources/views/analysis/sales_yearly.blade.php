@extends('layouts.app')
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Grafik Penjualan Tahunan</h2>
    <div class="bg-white p-6 rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $row)
                <tr>
                    <td>{{ $row->year }}</td>
                    <td>Rp {{ number_format($row->total,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
