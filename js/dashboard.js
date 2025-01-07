$(document).ready(function () {
    // Initialize functions when document is ready
    initModalActions();
    initFormSubmission();
    fetchCars();
    fetchArchivedCars();
    setCarsAutoRefresh();
    bindTableFilter();
    get_auto_archive();
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
        get_auto_archive();
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
                // console.log(response);
                alertify.success('Record saved successfully!');
                $('#carName').val('')
                $('#carType').val('')
                $('#plateNumber').val('')
                $('#condo').val('')
                $('#RFID').val('')
                $('#carImage').val('')
                $('#cctImage').val('')
                
                
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

                $('#carImage_update').val('')
                $('#cctImage_update').val('')

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
function get_auto_archive() {
    $.ajax({
        type: "GET",
        url: '../backend/endpoints/controller.php',
        data: { requestType: 'GetAutoArchive' },
        success: function (response) {
            console.log(response);
            
        },
        error: function (xhr, status, error) {
            console.log('AJAX error: ' + error);  // Log any error with the AJAX request
        }
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

            // console.log(response)

            if (response.status === 'success') {
                displayCars(response.data, '#recordTable tbody');
            } else {
                // console.log(response.message);
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
                // console.log(response.message);
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
                    <img 
                        src="../CarImages/${car.CarImage ? car.CarImage : 'pngtree-no-image-available.jpg'}" 
                        alt="${car.CarImage ? 'Car Picture' : 'No Image Available'}" 
                        class="w-12 h-12 object-cover cursor-pointer carImage"
                        data-large-image="../CarImages/${car.CarImage ? car.CarImage : 'pngtree-no-image-available.jpg'}"
                        onerror="this.src='pngtree-no-image-available.jpg'; this.alt='No Image Available';"
                    >
                </td>
                <td class="px-4 py-2 text-sm text-gray-600">
                    <img 
                        src="../cctImages/${car.cctImage ? car.cctImage : 'pngtree-no-image-available.jpg'}" 
                        alt="${car.cctImage ? 'Car Picture' : 'No Image Available'}" 
                        class="w-12 h-12 object-cover cursor-pointer cctImage"
                        data-large-image="../cctImages/${car.cctImage ? car.cctImage : 'pngtree-no-image-available.jpg'}"
                        onerror="this.src='pngtree-no-image-available.jpg'; this.alt='No Image Available';"
                    >
                </td>

                <!-- Other table data -->
                <td class="px-4 py-2 text-sm text-gray-600">${car.carName}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.carType}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.plateNumber}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.condo}</td>
                <td class="px-4 py-2 text-sm text-gray-600">${car.RFID}</td>
                <td class="px-4 py-2 text-sm text-gray-600">
                    ${car.time_in ? new Date(car.time_in).toLocaleTimeString() : 'No Time In'}
                </td>
                <td class="px-4 py-2 text-sm text-gray-600">
                    ${car.time_out ? new Date(car.time_out).toLocaleTimeString() : 'No Time Out'}
                </td>

                <td class="px-4 py-2 text-sm text-gray-600">
                    <div class="flex space-x-2 overflow-x-auto scrollbar-hidden">
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

                            <button class="btnViewCar bg-yellow-600 hover:bg-gray-300 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400"
                            onclick="location.href='view_record.php?carID=${car.car_id}'">
                                View
                            </button>
                    </div>
                </td>
            </tr>
        `;
        tableBody.append(carRow);
    });

    // Add event listener for the car image click
    $('.carImage').click(function() {
        var largeImage = $(this).data('large-image');
        $('#modalImage').attr('src', largeImage);
        $('#imageModal').removeClass('hidden');
    });

    // Add event listener for the cct image click
    $('.cctImage').click(function() {
        var largeImage = $(this).data('large-image');
        $('#modalImage').attr('src', largeImage);
        $('#imageModal').removeClass('hidden');
    });

    // Close the modal
    $('#closeModal').click(function() {
        $('#imageModal').addClass('hidden');
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
            // console.log(response);
            if (response === "success") {
                alertify.success('Car Restore successfully!');
                location.reload();
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
            // console.log(response);
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
    $('#carId_update').val($(this).attr('data-carID'))
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


