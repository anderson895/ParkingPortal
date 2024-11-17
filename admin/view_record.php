<?php
include('../backend/class.php');
include "component/header.php";


$db = new global_class();


?>
<div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
    <table class="min-w-full table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Date</th>
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
        <?php include "../backend/endpoints/view_history.php"; ?>
    </tbody>
    </table>
</div>







    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?php include "modals.php"; ?>

    <script src="../js/dashboard.js"></script>
</body>
</html>
