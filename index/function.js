
$(document).ready(function() {
    // Check if the email parameter is present in the URL
    var emailParam = "<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>";
    console.log("Email parameter from URL: " + emailParam);

    // Check if emailParam is not empty before showing the modal
    if (emailParam) {
        $("#verificationModal").modal("show"); // Show the verification modal
    }
});

    // Function to check the URL parameters
    function getURLParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Check if the 'verified' parameter is set to 1
    const verifiedParam = getURLParameter('verified');
    if (verifiedParam === '1') {
        $(document).ready(function() {
            $("#verifiedModal").modal("show"); // Show the 'verifiedModal'
        });
    }

