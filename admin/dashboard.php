<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARKING PORTAL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <!-- Header with Search, Table Toggle Buttons, and Logout -->
    <div class="flex items-center justify-between mb-4 space-x-4">
        <input type="text" placeholder="Search..." class="w-1/4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" id="searchInput" onkeyup="filterTable()">
        
        <!-- Buttons to Toggle Tables -->
        <div class="space-x-2">
            <button onclick="showTable('recordTable')" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Table Record</button>
            <button onclick="showTable('archivedTable')" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Table Archived</button>
        </div>
        
        <button onclick="location.href='logout.php';" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Logout</button>
    </div>

    <!-- Record Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4" id="recordTable">
        <h2 class="text-xl font-semibold mb-4">Record Table</h2>
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
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-600"><img src="https://getcarparkingmultiplayer.com/wp-content/uploads/2024/07/Car-Parking-multiplayer-with-Unlimited-money.webp" alt="Car Picture" class="w-12 h-12 object-cover"></td>
                    <td class="px-4 py-2 text-sm text-gray-600">John Doe</td>
                    <td class="px-4 py-2 text-sm text-gray-600">Toyota Corolla</td>
                    <td class="px-4 py-2 text-sm text-gray-600">ABC 123</td>
                    <td class="px-4 py-2 text-sm text-gray-600">Unit 205</td>
                    <td class="px-4 py-2 text-sm text-gray-600">RF123456</td>
                    <td class="px-4 py-2 text-sm text-gray-600">10:00 AM</td>
                    <td class="px-4 py-2 text-sm text-gray-600">5:00 PM</td>
                </tr>
                <!-- Add more rows as needed -->
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
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Archived Date</th>
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

    <!-- JavaScript for Table Toggle and Search Functionality -->
    <script>
        function showTable(tableId) {
            document.getElementById("recordTable").classList.add("hidden");
            document.getElementById("archivedTable").classList.add("hidden");
            document.getElementById(tableId).classList.remove("hidden");
        }

        function filterTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.getElementById("recordTable").classList.contains("hidden") ? 
                document.getElementById("archivedTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr") : 
                document.getElementById("recordTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                let rowText = rows[i].textContent.toLowerCase();
                rows[i].style.display = rowText.includes(input) ? "" : "none";
            }
        }

    </script>

</body>
</html>
