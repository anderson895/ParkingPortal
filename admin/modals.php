<!-- Modal -->
<div id="myModalAddCar" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center" style="display:none;">
    <div class="bg-white p-6 rounded-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-semibold mb-4">Add New Car</h3>
        <!-- Modal Content (form or content) -->
        <form id="frmCar">
            <label for="carName" class="block mb-2">Car Owner's Name:</label>
            <input type="text" id="carName" name="carName" class="border p-2 mb-4 w-full" placeholder="Enter car owner's name" required>
            
            <label for="carType" class="block mb-2">Car type:</label>
            <select id="carType" name="carType" class="border p-2 mb-4 w-full" required>
                <option value="" disabled selected>Select a car type</option>
                <option value="SUV">SUV</option>
                <option value="SEDAN">Sedan</option>
                <option value="Sports Car">Sports Car</option>
                <option value="COUPE">Coupe</option>
                <option value="HATCHBACK">Hatchback</option>
                <option value="VAN">Van</option>
            </select>


            <label for="plateNumber" class="block mb-2">Car plate:</label>
            <input type="text" id="plateNumber" name="plateNumber" class="border p-2 mb-4 w-full" placeholder="Enter Car plate number" required>
            
            <label for="condo" class="block mb-2">Condo Unit No:</label>
            <input type="text" id="condo" name="condo" class="border p-2 mb-4 w-full" placeholder="Enter Condo Unit" required>

            <label for="RFID" class="block mb-2">RFID No:</label>
            <input type="text" id="RFID" name="RFID" class="border p-2 mb-4 w-full" placeholder="Enter RFID No" required>
            
            <!-- Image Upload Field -->
            <label for="carImage" class="block mb-2">Upload Car Image:</label>
            <input type="file" id="carImage" name="carImage" class="border p-2 mb-4 w-full" required accept="image/*">

            <!-- Image Upload Field -->
            <label for="cctImage" class="block mb-2">Certificate of Title (CCT):</label>
            <input type="file" id="cctImage" name="cctImage" class="border p-2 mb-4 w-full" required accept="image/*">

            
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

            <label for="carName" class="block mb-2">Car ID:</label>
            <input type="text" hidden id="carId_update" name="carId"  required>

            <label for="carName" class="block mb-2">Car Owner's Name:</label>
            <input type="text" id="carName_update" name="carName" class="border p-2 mb-4 w-full" placeholder="Enter car owner's name" required>
            
            <label for="carType_update" class="block mb-2">Car type:</label>
            <select id="carType_update" name="carType" class="border p-2 mb-4 w-full" required>
                <option value="" disabled selected>Select a car type</option>
                <option value="SUV">SUV</option>
                <option value="SEDAN">Sedan</option>
                <option value="Sports Car">Sports Car</option>
                <option value="COUPE">Coupe</option>
                <option value="HATCHBACK">Hatchback</option>
                <option value="VAN">Van</option>
            </select>


            <label for="plateNumber" class="block mb-2">Car plate:</label>
            <input type="text" id="plateNumber_update" name="plateNumber" class="border p-2 mb-4 w-full" placeholder="Enter Car plate number" required>
            
            <label for="condo" class="block mb-2">Condo Unit No:</label>
            <input type="text" id="condo_update" name="condo" class="border p-2 mb-4 w-full" placeholder="Enter Condo Unit" required>

            <label for="RFID" class="block mb-2">RFID No:</label>
            <input type="text" id="RFID_update" name="RFID" class="border p-2 mb-4 w-full" placeholder="Enter RFID No" required>
            
           <!-- Image Upload Field -->
            <label for="carImage" class="block mb-2">Upload Car Image:</label>
            <input type="file" id="carImage_update" name="carImage" class="border p-2 mb-4 w-full" accept="image/*">

            <!-- Image Upload Field -->
            <label for="cctImage" class="block mb-2">Certificate of Title (CCT):</label>
            <input type="file" id="cctImage_update" name="cctImage" class="border p-2 mb-4 w-full" accept="image/*">

            <!-- Add more form fields as needed -->
            
            <div class="flex justify-end">
                <button type="button" class="closeModalBtn bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600">Save</button>
            </div>
        </form>
    </div>  
</div>








<!-- Modal -->
<div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-4 rounded-lg max-w-3xl w-full max-h-full flex items-center justify-center overflow-auto">
        <!-- Scrollable image container -->
        <div class="relative w-full h-full overflow-auto">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full rounded">
        </div>
        <!-- Close button -->
        <button id="closeModal" class="absolute top-0 right-0 m-4 text-white text-xl">&times;</button>
    </div>
</div>
