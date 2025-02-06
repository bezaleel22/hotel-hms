$(document).ready(function() {
    // Set the default selected country code
    let selected_country = $('#country_selected').val();

    // Get the select element
    const countrySelect = document.getElementById('country');

    // Loop through all options and set the selected option
    for (let i = 0; i < countrySelect.options.length; i++) {
        if (countrySelect.options[i].value === selected_country) {
            countrySelect.options[i].selected = true;
            break; // Exit the loop once the selected option is set
        }
    }
});