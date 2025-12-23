@extends('layouts.app')
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Pelanggan Paling Aktif</h2>
    <div class="bg-white p-6 rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Jumlah Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topCustomers as $row)
                <tr>
                    <td>{{ $row->user_id }}</td>
                    <td>{{ $row->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
