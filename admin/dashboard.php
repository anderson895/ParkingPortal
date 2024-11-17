<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARKING PORTAL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.css" integrity="sha512-MpdEaY2YQ3EokN6lCD6bnWMl5Gwk7RjBbpKLovlrH6X+DRokrPRAF3zQJl1hZUiLXfo2e9MrOt+udOnHCAmi5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js" integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body class="bg-gray-100 p-6">

    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white p-4 mb-6 rounded-lg shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-xl font-bold">Parking Portal</a>
            <ul class="flex space-x-6">
                <li><button onclick="showTable('recordTable')" class="hover:text-blue-300">Record</button></li>
                <li><button onclick="showTable('archivedTable')" class="hover:text-blue-300">Archived</button></li>
                <li><button onclick="location.href='logout.php';" class="hover:text-blue-300">Logout</button></li>
            </ul>
        </div>
    </nav>

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
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-600"><img src="https://carwow-uk-wp-0.imgix.net/18015-MC20BluInfinito-scaled-e1666008987698-600x338.jpg?auto=format&cs=tinysrgb&fit=crop&h=&ixlib=rb-1.1.0&q=60&w=1600" alt="Car Picture" class="w-12 h-12 object-cover"></td>
                    <td class="px-4 py-2 text-sm text-gray-600">Jane Smith</td>
                    <td class="px-4 py-2 text-sm text-gray-600">Honda Civic</td>
                    <td class="px-4 py-2 text-sm text-gray-600">XYZ 789</td>
                    <td class="px-4 py-2 text-sm text-gray-600">Unit 101</td>
                    <td class="px-4 py-2 text-sm text-gray-600">RF654321</td>
                    <td class="px-4 py-2 text-sm text-gray-600">2024-10-01</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?php include "modals.php"; ?>

    <script src="../js/dashboard.js"></script>
</body>
</html>
