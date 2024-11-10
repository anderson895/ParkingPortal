<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Table</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr class="bg-gray-800 text-white text-left">
                    <th class="py-3 px-4">Car Owner's Name</th>
                    <th class="py-3 px-4">Car Type</th>
                    <th class="py-3 px-4">Car Plate</th>
                    <th class="py-3 px-4">Condo Unit No.</th>
                    <th class="py-3 px-4">RFID No.</th>
                    <th class="py-3 px-4">Time In</th>
                    <th class="py-3 px-4">Time Out</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <tr class="border-t border-gray-300 hover:bg-gray-100">
                    <td class="py-3 px-4">John Doe</td>
                    <td class="py-3 px-4">Sedan</td>
                    <td class="py-3 px-4">ABC1234</td>
                    <td class="py-3 px-4">12A</td>
                    <td class="py-3 px-4">RFID001</td>
                    <td class="py-3 px-4">08:00 AM</td>
                    <td class="py-3 px-4">05:00 PM</td>
                </tr>
                <tr class="border-t border-gray-300 hover:bg-gray-100">
                    <td class="py-3 px-4">Jane Smith</td>
                    <td class="py-3 px-4">SUV</td>
                    <td class="py-3 px-4">XYZ5678</td>
                    <td class="py-3 px-4">15B</td>
                    <td class="py-3 px-4">RFID002</td>
                    <td class="py-3 px-4">09:00 AM</td>
                    <td class="py-3 px-4">06:00 PM</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

</body>
</html>
