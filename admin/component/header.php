<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARKING PORTAL</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- AlertifyJS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.css" integrity="sha512-MpdEaY2YQ3EokN6lCD6bnWMl5Gwk7RjBbpKLovlrH6X+DRokrPRAF3zQJl1hZUiLXfo2e9MrOt+udOnHCAmi5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js" integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

<?php 
$url = $_SERVER['REQUEST_URI']; 
$parsedUrl = parse_url($url);
$filename = basename($parsedUrl['path']);

if ($filename === "view_record.php") {
    $title = "View History";
    $icon = "<i class='material-icons mr-2'>arrow_back</i>";
    $buttons = ''; 
} else {
    $icon = '';
    $title = "Parking Portal";
    $buttons = '
    <li>
        <button onclick="showTable(\'recordTable\')" class="hover:text-blue-300">Record</button>
    </li>
    <li>
        <button onclick="showTable(\'archivedTable\')" class="hover:text-blue-300">Archived</button>
    </li>
    <li>
        <button onclick="location.href=\'logout.php\';" class="hover:text-blue-300">Logout</button>
    </li>
    ';
}
?>

<!-- Navigation Bar -->
<nav class="bg-blue-600 text-white p-4 mb-6 rounded-lg shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <!-- BackIcon with Material Icon -->
        <a href="dashboard.php" class="text-xl font-bold flex items-center">
            <?= $icon ?> <!-- Back icon -->
            <?= $title ?>
        </a>
        <ul class="flex space-x-6">
            <?= $buttons ?>
        </ul>
    </div>
</nav>


</body>
</html>
