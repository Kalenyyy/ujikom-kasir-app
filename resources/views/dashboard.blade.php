@extends('layouts.template')

@section('content')
    @if (Auth::user()->role == 'Admin')
        <div class="flex justify-center items-center">
            <div class="flex flex-nowrap my-2 w-full">
                <div class="w-1/3 p-2">
                    <a href="">
                        <div class="flex items-center flex-row w-full bg-[#FF9100] rounded-md p-3">
                            <div
                                class="flex text-[#FF9100] items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                                    stroke="currentColor" class="object-scale-down transition duration-500">
                                    <path strokeLinecap="round" strokeLinejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </div>
                            <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                                <div class="text-xs whitespace-nowrap">
                                    Total User
                                </div>
                                <div class="">
                                    {{ $users_count }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="w-1/3 p-2">
                    <a href="">
                        <div class="flex items-center flex-row w-full bg-[#FF9100] rounded-md p-3">
                            <div
                                class="flex text-[#FF9100] items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                                    stroke="currentColor" class="object-scale-down transition duration-500 ">
                                    <path strokeLinecap="round" strokeLinejoin="round"
                                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                                <div class="text-xs whitespace-nowrap">
                                    Stock Product
                                </div>
                                <div class="">
                                    {{ $products_count }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="w-1/3 p-2">
                    <a href="">
                        <div class="flex items-center flex-row w-full bg-[#FF9100] rounded-md p-3">
                            <div
                                class="flex text-[#FF9100] items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                                    stroke="currentColor" class="object-scale-down transition duration-500">
                                    <path strokeLinecap="round" strokeLinejoin="round"
                                        d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                                </svg>
                            </div>
                            <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                                <div class="text-xs whitespace-nowrap">
                                    Laporan Terjual Hari Ini
                                </div>
                                <div class="">
                                    {{ $orders_today }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <h1 class="text-center font-bold text-xl mt-5">Laporan Diagram</h1>
        <div class="px-10 flex gap-5">
            <div class="w-[70%] mt-5 border-2 rounded-xl h-[500px] p-4">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="font-semibold text-lg">Total Penjualan Harian</h2>
                </div>
                <canvas id="BarChart"></canvas>
            </div>
            <div class="w-[30%] mt-5 border-2 rounded-xl h-[500px] p-4 flex flex-col items-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Penjualan Produk</h3>
                <canvas id="PieChart"></canvas>
            </div>
        </div>
    @endif


    @if (Auth::user()->role == 'Petugas')
        <div class="flex justify-center items-start bg-gray-100 p-6">
            <div class="bg-white p-10 rounded-3xl shadow-xl text-center w-full max-w-xl ">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Total Penjualan Hari Ini
                </h1>
                <div class="text-green-500 text-5xl md:text-6xl font-extrabold mb-2">
                    Rp {{ number_format($total_penjualan_hari_ini, 0, ',', '.') }}
                </div>
                <p class="text-gray-500 text-lg">
                    Total penjualan hari ini dari semua produk yang terjual di WarungDoMie.
                </p>

                <div class="mt-6 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 1.567-3 3.5S10.343 15 12 15s3-1.567 3-3.5S13.657 8 12 8zM12 3v1m0 16v1m8.485-8.485l-.707.707M4.222 4.222l-.707.707m16.97 12.728l-.707.707M4.222 19.778l-.707.707M21 12h1M2 12H1" />
                    </svg>
                </div>
            </div>
        </div>
    @endif
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil data dari Laravel ke JavaScript
        const barLabels = @json($dates);
        const barData = @json($salesPerDay);


        // Buat Bar Chart
        const barCtx = document.getElementById("BarChart").getContext("2d");
        if (barCtx) {
            new Chart(barCtx, {
                type: "bar",
                data: {
                    labels: barLabels,
                    datasets: [{
                        label: "Total Penjualan Per Hari",
                        data: barData,
                        backgroundColor: [
                            "rgba(75, 192, 192, 0.5)", "rgba(54, 162, 235, 0.5)",
                            "rgba(255, 206, 86, 0.5)", "rgba(231, 76, 60, 0.5)"
                        ],
                        borderColor: [
                            "rgb(75, 192, 192)", "rgb(54, 162, 235)",
                            "rgb(255, 206, 86)", "rgb(231, 76, 60)"
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        } else {
            console.error("Canvas BarChart tidak ditemukan!");
        }

        // Buat Pie Chart
        const pieCtx = document.getElementById("PieChart").getContext("2d");
        if (pieCtx) {
            new Chart(pieCtx, {
                type: "pie",
                data: {
                    labels: @json($productLabels),
                    datasets: [{
                        label: 'Penjualan Produk',
                        data: @json($productQuantities),
                        backgroundColor: [
                            "rgba(75, 192, 192, 0.5)", "rgba(255, 159, 64, 0.5)",
                            "rgba(153, 102, 255, 0.5)", "rgba(255, 99, 132, 0.5)",
                            "rgba(54, 162, 235, 0.5)"
                        ],
                        borderColor: [
                            "rgb(75, 192, 192)", "rgb(255, 159, 64)",
                            "rgb(153, 102, 255)", "rgb(255, 99, 132)",
                            "rgb(54, 162, 235)"
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        } else {
            console.error("Canvas PieChart tidak ditemukan!");
        }
    });
</script>
