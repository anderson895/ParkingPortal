<?php 
include "component/header.php";
?>

    <!-- Header with Search -->
    <div class="flex items-center justify-between mb-4 space-x-4">
        <input type="text" placeholder="Search..." class="w-1/4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" id="searchInput">
    </div>

    <!-- Record Table -->
<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Record</h2>
    <button id="openModalBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
        <span class="text-lg">+ </span> Add new
    </button>
</div>

<div class="overflow-x-auto bg-white shadow-md rounded-lg p-4" id="recordTable">
    <h2 class="text-xl font-semibold mb-4">List of Cars</h2>
    <table class="min-w-full table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Picture of Car</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Certificate of Title (CCT)</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Car Owner's Name</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Vehicle Model</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Plate Number</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Condo Unit Number</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">RFID Number</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Time In</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Time Out</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>


    <!-- Archived Table (Initially Hidden) -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4 hidden" id="archivedTable">
        <h2 class="text-xl font-semibold mb-4">Archived Table</h2>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Picture of Car</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Certificate of Title (CCT)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Car Owner's Name</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Vehicle Model</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Plate Number</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Condo Unit Number</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">RFID Number</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Time In</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Time Out</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?php include "modals.php"; ?>

    <script src="../js/dashboard.js"></script>
</body>
</html>
