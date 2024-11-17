<?php
include('../backend/class.php');
include "component/header.php";

$db = new global_class();
$carId = $_GET['carID'];

?>

<div class="flex justify-end mb-4">
    <form method="GET" action="../function/export_report.php">

    <input hidden type="text" name="carID" value="<?=$carId?>">

        <select name="report_type" class="px-4 py-2">

            <option value="daily">Daily Report</option>
            <option value="weekly">Weekly Report</option>
            <option value="monthly">Monthly Report</option>
            <option value="yearly">Yearly Report</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Export to Excel</button>
    </form>
</div>

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
        <?php 
           
            $fetch_all_logHistory = $db->fetch_all_logHistory($carId); 
            foreach ($fetch_all_logHistory as $logs):
        ?>
            <tr>
                <td class="px-4 py-2 text-sm text-gray-600"><?= $logs['time_date'] ?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?= $logs['carName'] ?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?= $logs['carType'] ?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?= $logs['plateNumber'] ?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?= $logs['condo'] ?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?= $logs['RFID'] ?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?= $logs['time_in'] ?></td>
                <td class="px-4 py-2 text-sm text-gray-600">
                    <?= $logs['time_out'] ? $logs['time_out'] : 'No Time Out' ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>

<?php include "modals.php"; ?>

<script src="../js/dashboard.js"></script>
</body>
</html>
