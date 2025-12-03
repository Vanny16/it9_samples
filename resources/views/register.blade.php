<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-toggle {
            text-align: center;
            margin-top: 10px;
        }

        .form-toggle a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .form-toggle a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>


    <div class="container mt-5 bg-danger">

        <h2>Create Account</h2>
        <form method="POST" action="{{ route('save_user') }}"enctype="multipart/form-data">
            @csrf
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>


            <label>Date of Birth:</label>
            <input type="date" name="dob" required>

            <label>Contact:</label>
            <input type="number" name="contact_no" required>

            <label>Age:</label>
            <input type="nummber" name="age" required>



            <label for="region">Region
                <span class="text-red">*</span>
            </label>
            <select id="region" name="region" class="custom-select">
                <option value="">-- SELECT REGION --</option>
                @foreach ($regions as $r)
                    <option value="{{ $r->reg_id }}">{{ $r->reg_name }}</option>
                @endforeach
            </select>

            <label for="province">Province
                <span class="text-red">*</span>
            </label>
            <select id="province" name="province" class="custom-select" disabled>
                <option value="">-- SELECT PROVINCE --</option>
            </select>

            <label for="municipality">Municipality
                <span class="text-red">*</span>
            </label>
            <select id="municipality" name="municipality" class="custom-select" disabled>
                <option value="">-- SELECT MUNICIPALITY --</option>
            </select>

            <label for="barangay">Barangay
                <span class="text-red">*</span>
            </label>
            <select id="barangay" name="barangay" class="custom-select" disabled>
                <option value="">-- SELECT BARANGAY --</option>
            </select>


            <button type="submit">Register</button>
            <input type="hidden" id="selected_region" name="region_id">
            <input type="hidden" id="selected_province" name="province_id">
            <input type="hidden" id="selected_municipality" name="municipality_id">
            <input type="hidden" id="selected_barangay" name="barangay_id">
        </form>
        <div class="form-toggle">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>

    <script>
        // Ensure DOM is fully loaded before executing script
        document.addEventListener('DOMContentLoaded', function() {
            // Check if elements exist in the DOM
            const regionSel = document.getElementById('region');
            const provSel = document.getElementById('province');
            const muniSel = document.getElementById('municipality');
            const brgySel = document.getElementById('barangay');

            const regionInput = document.getElementById('selected_region');
            const provInput = document.getElementById('selected_province');
            const muniInput = document.getElementById('selected_municipality');
            const brgyInput = document.getElementById('selected_barangay');

            // Exit if elements don't exist to avoid errors
            if (!regionSel || !provSel || !muniSel || !brgySel) {
                console.error("One or more dropdown elements not found in the DOM");
                return;
            }

            // Try to get CSRF token
            let csrfToken = '';
            const csrfElement = document.querySelector('meta[name="csrf-token"]');
            if (csrfElement) {
                csrfToken = csrfElement.getAttribute('content');
            } else {
                console.warn("CSRF token meta tag not found. AJAX requests might fail.");
            }

            // Get base URL for API requests
            const baseUrl = window.location.origin;

            /**
             * Reset a select element to its initial state
             */
            function resetSelect(el, placeholder) {
                console.log(`Resetting dropdown: ${el.id} with placeholder: ${placeholder}`);
                el.innerHTML = `<option value="">${placeholder}</option>`;
                el.disabled = true;
            }

            /**
             * Load options into a select element via AJAX
             */
            async function loadOptions(el, endpoint, textKey, valueKey, placeholder) {
                resetSelect(el, placeholder);
                if (!endpoint) return;

                const url = `${baseUrl}${endpoint}`;
                console.log(`Loading options from: ${url}`);

                // Add loading indicator
                el.innerHTML = '<option value="">Loading...</option>';

                try {
                    const response = await fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin', // Include cookies
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    const data = await response.json();
                    console.log(`Data received for ${el.id}:`, data);

                    // Reset with placeholder
                    el.innerHTML = `<option value="">${placeholder}</option>`;

                    // Add options from response
                    if (data && data.length > 0) {
                        data.forEach(item => {
                            el.insertAdjacentHTML('beforeend',
                                `<option value="${item[valueKey]}">${item[textKey]}</option>`);
                        });
                        el.disabled = false;
                    } else {
                        console.warn(`No data received for ${el.id}`);
                        el.innerHTML = `<option value="">No options available</option>`;
                    }
                } catch (error) {
                    console.error(`Error loading data for ${el.id}:`, error);
                    el.innerHTML = `<option value="">Error loading data</option>`;
                }
            }

            /**
             * Event listeners for dropdowns
             */

            // Region change event
            regionSel.addEventListener('change', function() {
                const regionId = this.value;
                regionInput.value = regionId; // Set the selected region ID
                console.log("Region selected:", regionId);

                // Reset dependent dropdowns
                resetSelect(provSel, '-- SELECT PROVINCE --');
                resetSelect(muniSel, '-- SELECT MUNICIPALITY --');
                resetSelect(brgySel, '-- SELECT BARANGAY --');

                if (regionId) {
                    loadOptions(provSel, `/locations/${regionId}/provinces`, 'prov_name', 'prov_id',
                        '-- SELECT PROVINCE --');
                }
            });

            // Province change event
            provSel.addEventListener('change', function() {
                const provinceId = this.value;
                provInput.value = provinceId; // Set the selected province ID
                console.log("Province selected:", provinceId);

                // Reset dependent dropdowns
                resetSelect(muniSel, '-- SELECT MUNICIPALITY --');
                resetSelect(brgySel, '-- SELECT BARANGAY --');

                if (provinceId) {
                    loadOptions(muniSel, `/locations/${provinceId}/municipalities`, 'mun_name', 'mun_id',
                        '-- SELECT MUNICIPALITY --');
                }
            });

            // Municipality change event
            muniSel.addEventListener('change', function() {
                const muniId = this.value;
                muniInput.value = muniId; // Set the selected municipality ID
                console.log("Municipality selected:", muniId);

                // Reset dependent dropdown
                resetSelect(brgySel, '-- SELECT BARANGAY --');

                if (muniId) {
                    loadOptions(brgySel, `/locations/${muniId}/barangays`, 'brg_name', 'brg_id',
                        '-- SELECT BARANGAY --');
                }
            });

            brgySel.addEventListener('change', function() {
                const brgyId = this.value;
                brgyInput.value = brgyId; // Set the selected barangay ID
            });

            // Optional: Initialize with console message to confirm script loaded
            console.log("Location dropdown script initialized successfully");
        });

        function checkOtherReligion() {
            var selectBox = document.getElementById("religion_id");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var otherReligionInput = document.getElementById("otherReligionInput");

            if (selectedValue === "other") {
                otherReligionInput.style.display = "block";
            } else {
                otherReligionInput.style.display = "none";
            }
        }
    </script>

</body>




</html>
