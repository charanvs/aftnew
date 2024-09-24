function printModalContent(modalId) {
    // Get the modal content by modalId
    var modalElement = document.getElementById(modalId);
    if (!modalElement) {
        console.error("Modal not found for modalId:", modalId);
        return;
    }

    var modalContent = modalElement.getElementsByClassName('modal-content')[0];
    if (!modalContent) {
        console.error("Modal content not found for modalId:", modalId);
        return;
    }

    // Open a new window for printing
    var printWindow = window.open('', '', 'height=800,width=800');

    // Write the basic structure of the print window
    printWindow.document.write('<html><head><title>Print Modal Content</title>');

    // Include Bootstrap CSS or any custom CSS
    printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">');

    // Optionally, add custom styles to format the printed content
    printWindow.document.write('<style>body { font-family: Arial, sans-serif; }</style>');

    // Close the head and start body
    printWindow.document.write('</head><body>');

    // Insert the modal content (this includes all inner HTML of the modal)
    printWindow.document.write(modalContent.innerHTML);

    // Close body and HTML
    printWindow.document.write('</body></html>');

    // Ensure the print content is fully loaded before printing
    printWindow.document.close();

    // Trigger the print functionality
    printWindow.onload = function () {
        printWindow.focus(); // Focus on the new window
        printWindow.print(); // Trigger the print dialog
        printWindow.onafterprint = function () {
            printWindow.close(); // Close the print window after printing
        };
    };
}