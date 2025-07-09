@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 mt-1">Berikut adalah ringkasan sistem Anda hari ini.</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Users -->
            <div class="bg-white shadow-md rounded-lg p-6 flex items-center">
                <div class="p-4 bg-blue-100 text-blue-600 rounded-full">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $userCount }}</p>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-white shadow-md rounded-lg p-6 flex items-center">
                <div class="p-4 bg-green-100 text-green-600 rounded-full">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0l-8 8-8-8" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $productCount }}</p>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Grafik Ringkasan</h2>
            <canvas id="summaryChart" height="100"></canvas>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('summaryChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Pengguna', 'Produk'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [{{ $userCount }}, {{ $productCount }}],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.6)', // blue
                            'rgba(34, 197, 94, 0.6)' // green
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(34, 197, 94, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
