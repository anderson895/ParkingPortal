<?php 

$carId=$_GET['carID'];
$fetch_all_logHistory = $db->fetch_all_logHistory($carId); 
foreach ($fetch_all_logHistory as $logs):
?>



            <tr>
                <td class="px-4 py-2 text-sm text-gray-600"><?=$logs['time_date']?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?=$logs['carName']?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?=$logs['carType']?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?=$logs['plateNumber']?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?=$logs['condo']?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?=$logs['RFID']?></td>
                <td class="px-4 py-2 text-sm text-gray-600"><?=$logs['time_in']?></td>
                <td class="px-4 py-2 text-sm text-gray-600">
                <?php 
                    if(!$logs['time_out']){
                        echo "No Time Out";
                    } else {
                        echo $logs['time_out'];
                    }
                    ?>
                </td>
            </tr>
        
    
<?php endforeach; ?>