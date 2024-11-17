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
        $('#myModalAddCar').fadeIn();
    });
    
    $('#closeModalBtn').click(function() {
        $('#myModalAddCar').fadeOut();
    });
    
    $(window).click(function(event) {
        if ($(event.target).is('#myModalAddCar')) {
            $('#myModalAddCar').fadeOut();
        }
    });
}


function setCarsAutoRefresh() {
    setInterval(function() {
        fetchCars();
    }, 2000);
}






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
                alertify.success('Record saved successfully!');
                $('#myModalAddCar').fadeOut();
                // location.reload();
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
                // console.log(response.data);
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
                    <button class="btnArchiveCar bg-blue-600 hover:bg-gray-300 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
                    data-carID=${car.car_id }
                    >
                        Archived
                    </button>
                </td>
            </tr>
        `;
        tableBody.append(carRow);
    });
}



$(document).on('click', '.btnArchiveCar', function() {
    let carID = $(this).data('carid'); // Get the car ID from the button

    console.log(carID)
    // Confirm the action with the user
    if (!confirm('Are you sure you want to archive this car?')) {
        return;
    }

    // AJAX call to update car status
    $.ajax({
        url: '../backend/endpoints/controller.php', // API endpoint
        method: 'POST',         // HTTP method
        data: {
            carID: carID,
            requestType: 'ArchivedCar'   // The status to update
        },
        success: function(response) {
            console.log(response);
            if (response=="success") {
                alertify.success('Car status updated successfully!');
                
            } else {
                alertify.error('Failed to update car status. Please try again.');
            }
        },
        error: function(error) {
            console.error('Error updating car status:', error);
            alert('An error occurred while updating the car status.');
        }
    });
});