<!-- Modal -->
<div id="myModalAddCar" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center" style="display:none;">
    <div class="bg-white p-6 rounded-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-semibold mb-4">Add New Car</h3>
        <!-- Modal Content (form or content) -->
        <form id="frmCar">
            <label for="carName" class="block mb-2">Car Owner's Name:</label>
            <input type="text" id="carName" name="carName" class="border p-2 mb-4 w-full" placeholder="Enter car owner's name" required>
            
            <label for="carType" class="block mb-2">Car type:</label>
            <input type="text" id="carType" name="carType" class="border p-2 mb-4 w-full" placeholder="Enter vehicle model" required>

            <label for="plateNumber" class="block mb-2">Car plate:</label>
            <input type="text" id="plateNumber" name="plateNumber" class="border p-2 mb-4 w-full" placeholder="Enter Car plate number" required>
            
            <label for="condo" class="block mb-2">Condo Unit No:</label>
            <input type="text" id="condo" name="condo" class="border p-2 mb-4 w-full" placeholder="Enter Condo Unit" required>

            <label for="RFID" class="block mb-2">RFID No:</label>
            <input type="text" id="RFID" name="RFID" class="border p-2 mb-4 w-full" placeholder="Enter RFID No" required>
            
            <!-- Image Upload Field -->
            <label for="carImage" class="block mb-2">Upload Car Image:</label>
            <input type="file" id="carImage" name="carImage" class="border p-2 mb-4 w-full" required>
            
            <!-- Add more form fields as needed -->
            
            <div class="flex justify-end">
                <button type="button" id="closeModalBtn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600">Save</button>
            </div>
        </form>
    </div>  
</div>




<!-- Modal -->
<div id="myModalUpdateCar" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center" style="display:none;">
    <div class="bg-white p-6 rounded-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-semibold mb-4">Update Car</h3>
        <!-- Modal Content (form or content) -->
        <form id="frmCar_update">
            <label for="carName" class="block mb-2">Car Owner's Name:</label>
            <input type="text" id="carName_update" name="carName" class="border p-2 mb-4 w-full" placeholder="Enter car owner's name" required>
            
            <label for="carType" class="block mb-2">Car type:</label>
            <input type="text" id="carType_update" name="carType" class="border p-2 mb-4 w-full" placeholder="Enter vehicle model" required>

            <label for="plateNumber" class="block mb-2">Car plate:</label>
            <input type="text" id="plateNumber_update" name="plateNumber" class="border p-2 mb-4 w-full" placeholder="Enter Car plate number" required>
            
            <label for="condo" class="block mb-2">Condo Unit No:</label>
            <input type="text" id="condo_update" name="condo" class="border p-2 mb-4 w-full" placeholder="Enter Condo Unit" required>

            <label for="RFID" class="block mb-2">RFID No:</label>
            <input type="text" id="RFID_update" name="RFID" class="border p-2 mb-4 w-full" placeholder="Enter RFID No" required>
            
            <!-- Image Upload Field -->
            <label for="carImage" class="block mb-2">Upload Car Image:</label>
            <input type="file" id="carImage_update" name="carImage" class="border p-2 mb-4 w-full" required>
            
            <!-- Add more form fields as needed -->
            
            <div class="flex justify-end">
                <button type="button" class="closeModalBtn bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600">Save</button>
            </div>
        </form>
    </div>  
</div>
