// datepicker.js
$(document).ready(function(){
    $('#expiry_date').datepicker({
        format: 'yyyy-mm-dd', // Date format
        autoclose: true // Close the Datepicker when a date is selected
    });
});

