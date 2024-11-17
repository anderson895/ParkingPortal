$(document).ready(function () {
    // Initialize functions when document is ready
    initModalActions();
    initFormSubmission();
    fetchCars();
    fetchArchivedCars();
    setCarsAutoRefresh();
    bindTableFilter();
});

// Modal handling functions
function initModalActions() {
    $('#openModalBtn').click(function () {
        $('#myModalAddCar').fadeIn();
    });

    $('#closeModalBtn').click(function () {
        $('#myModalAddCar').fadeOut();
    });

    $(window).click(function (event) {
        if ($(event.target).is('#myModalAddCar')) {
            $('#myModalAddCar').fadeOut();
        }
    });




   


    // myModalUpdateCar
}

// Auto-refresh function for car tables
function setCarsAutoRefresh() {
    setInterval(function () {
        fetchCars();
        fetchArchivedCars();
    }, 2000);
}

// Toggle table visibility
function showTable(tableId) {
    $("#recordTable, #archivedTable").addClass("hidden");
    $("#" + tableId).removeClass("hidden");
}

// Table filtering functionality
function bindTableFilter() {
    $('#searchInput').on('input', function () {
        const input = $(this).val().toLowerCase();
        const rows = $("#recordTable").hasClass("hidden") ? $("#archivedTable tbody tr") : $("#recordTable tbody tr");

        rows.each(function () {
            let rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(input));
        });
    });
}

// Form submission for adding a new car
function initFormSubmission() {
    $('#frmCar').on('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('requestType', 'AddNewCar');

        $.ajax({
            url: '../backend/endpoints/controller.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                alertify.success('Record saved successfully!');
                $('#carName').val('')
                $('#carType').val('')
                $('#plateNumber').val('')
                $('#condo').val('')
                $('#RFID').val('')
                // location.reload();
            },
            error: function (xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    });



    $('#frmCar_update').on('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append('requestType', 'UpdateCar');

        $.ajax({
            url: '../backend/endpoints/controller.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                alertify.success('Record saved successfully!');
                $('#myModalUpdateCar').fadeOut();
                // location.reload();
            },
            error: function (xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    });

}

// Fetch car data for active cars
function fetchCars() {
    $.ajax({
        type: "GET",
        url: '../backend/endpoints/controller.php',
        data: { requestType: 'GetAllCars' },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                displayCars(response.data, '#recordTable tbody');
            } else {
                console.log(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.log('AJAX error: ' + error);
        }
    });
}

// Fetch car data for archived cars
function fetchArchivedCars() {
    $.ajax({
        type: "GET",
        url: '../backend/endpoints/controller.php',
        data: { requestType: 'GetAllArchiveCars' },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                displayCars(response.data, '#archivedTable tbody');
            } else {
                console.log(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.log('AJAX error: ' + error);
        }
    });
}

// Display car data in specified table
function displayCars(cars, tableSelector) {
    let tableBody = $(tableSelector);
    tableBody.empty();
    cars.forEach(function (car) {
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
                    ${tableSelector === '#recordTable tbody' ? `
                        <button class="btnArchiveCar bg-blue-600 hover:bg-gray-300 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
                        data-carID=${car.car_id}>
                            Archive
                        </button>
                        <button class="btnUpdateCar bg-green-600 hover:bg-gray-300 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
                        data-carID=${car.car_id}
                        data-carName="${car.carName}"
                        data-carType="${car.carType}"
                        data-plateNumber="${car.plateNumber}"
                        data-condo="${car.condo}"
                        data-RFID="${car.RFID}"
                        >
                            Update
                        </button>
                        
                        ` : `
                        <button class="btnRestoreCar bg-green-600 hover:bg-gray-300 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
                        data-carID=${car.car_id}>
                            Restore
                        </button>`}
                </td>

            </tr>
        `;
        tableBody.append(carRow);
    });
}

// Handle archiving a car

$(document).on('click', '.btnRestoreCar', function () {
    let carID = $(this).data('carid'); // Get the car ID from the button

    if (!confirm('Are you sure you want to restore this car?')) {
        return;
    }

    $.ajax({
        url: '../backend/endpoints/controller.php',
        method: 'POST',
        data: {
            carID: carID,
            requestType: 'restoreCar'
        },
        success: function (response) {
            console.log(response);
            if (response === "success") {
                alertify.success('Car Restore successfully!');
                fetchCars();
                fetchArchivedCars();
            } else {
                alertify.error('Failed to update car status. Please try again.');
            }
        },
        error: function (error) {
            console.error('Error updating car status:', error);
            alert('An error occurred while updating the car status.');
        }
    });
});


$(document).on('click', '.btnArchiveCar', function () {
    let carID = $(this).data('carid'); // Get the car ID from the button

    if (!confirm('Are you sure you want to archive this car?')) {
        return;
    }

    $.ajax({
        url: '../backend/endpoints/controller.php',
        method: 'POST',
        data: {
            carID: carID,
            requestType: 'ArchivedCar'
        },
        success: function (response) {
            console.log(response);
            if (response === "success") {
                alertify.success('Car Archived successfully!');
                fetchCars();
                fetchArchivedCars();
            } else {
                alertify.error('Failed to update car status. Please try again.');
            }
        },
        error: function (error) {
            console.error('Error updating car status:', error);
            alert('An error occurred while updating the car status.');
        }
    });
});





$(document).on('click', '.btnUpdateCar', function () {
    
    $('#carName_update').val($(this).attr('data-carName'))
    $('#carType_update').val($(this).attr('data-carType'))
    $('#plateNumber_update').val($(this).attr('data-plateNumber'))
    $('#condo_update').val($(this).attr('data-condo'))
    $('#RFID_update').val($(this).attr('data-RFID'))
    $('#myModalUpdateCar').fadeIn();

});

$(document).on('click', '.closeModalBtn', function () {
        $('#myModalUpdateCar').fadeOut();

});


