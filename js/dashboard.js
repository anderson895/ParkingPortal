$(document).ready(function() {
    // Initialize functions when document is ready
    initModalActions();
    initFormSubmission();
    fetchCars();
    setCarsAutoRefresh();
    bindTableFilter();
});

// Modal handling functions
function initModalActions() {
    $('#openModalBtn').click(function() {
        $('#myModal').fadeIn();
    });
    
    $('#closeModalBtn').click(function() {
        $('#myModal').fadeOut();
    });
    
    $(window).click(function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').fadeOut();
        }
    });
}

// Table show/hide functionality
function showTable(tableId) {
    $("#recordTable, #archivedTable").addClass("hidden");
    $("#" + tableId).removeClass("hidden");
}

// Table filtering functionality
function bindTableFilter() {
    $('#searchInput').on('input', function() {
        const input = $(this).val().toLowerCase();
        const rows = $("#recordTable").hasClass("hidden") ? $("#archivedTable tbody tr") : $("#recordTable tbody tr");
        
        rows.each(function() {
            let rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(input));
        });
    });
}

// Form submission for adding a new car
function initFormSubmission() {
    $('#frmCar').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('requestType', 'AddNewCar');
        
        $.ajax({
            url: '../backend/endpoints/controller.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                alert('Record saved successfully!');
            },
            error: function(xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    });
}

// Fetch car data from backend
function fetchCars() {
    $.ajax({
        type: "GET",
        url: '../backend/endpoints/controller.php',
        data: { requestType: 'GetAllCars' },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                console.log(response.data);
                displayCars(response.data);
            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX error: ' + error);
        }
    });
}

// Display car data in table
function displayCars(cars) {
    let tableBody = $('#recordTable tbody');
    tableBody.empty();
    cars.forEach(function(car) {
        let carRow = `
            <tr class="border-t">
                <td class="px-4 py-2 text-sm text-gray-600">
                    <img src="../CarImages/${car.CarImage}" alt="Car Picture" class="w-12 h-12 object-cover">
                </td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.carName}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.carType}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.plateNumber}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.condo}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.RFID}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.timeIn ? car.timeIn : 'No Time In'}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.timeOut ? car.timeOut : 'No Time Out'}</td>
                <td class="px-4 py-2 text-sm text-gray-600">
                    <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Archived
                    </button>
                </td>
            </tr>
        `;
        tableBody.append(carRow);
    });
}

// Automatically refresh car data every 10 seconds
function setCarsAutoRefresh() {
    setInterval(function() {
        fetchCars();
    }, 10000);
}
