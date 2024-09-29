
function printModalContent(modalId) {
    var modalContent = document.getElementById(modalId).getElementsByClassName('modal-content')[0];
    var printWindow = window.open('', '', 'height=800,width=800');

    printWindow.document.write('<html><head><title>Print Modal Content</title>');
    printWindow.document.write(
      '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">'
    ); // Add Bootstrap CSS if necessary
    printWindow.document.write('</head><body>');
    printWindow.document.write(modalContent.innerHTML);
    printWindow.document.write('</body></html>');

    printWindow.document.close();

    // Wait for the new window content to be fully loaded before triggering print
    printWindow.focus(); // Ensure the new window is in focus
    printWindow.onload = function() {
      printWindow.print(); // Trigger the print dialog
      printWindow.onafterprint = function() {
        printWindow.close(); // Close the print window after printing
      };
    };
  }

  