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
            <a href="dashboard.php" class="text-xl font-bold">Parking Portal</a>
            <ul class="flex space-x-6">
                <li><button onclick="showTable('recordTable')" class="hover:text-blue-300">Record</button></li>
                <li><button onclick="showTable('archivedTable')" class="hover:text-blue-300">Archived</button></li>
                <li><button onclick="location.href='logout.php';" class="hover:text-blue-300">Logout</button></li>
            </ul>
        </div>
    </nav>