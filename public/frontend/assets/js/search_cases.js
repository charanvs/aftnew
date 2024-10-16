var truncateText = function (text, maxLength) {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + "...";
    } else {
        return text;
    }
};

function getCaseType(caseType) {
    switch (caseType) {
        case "1":
            return "OA";
        case "2":
            return "TA";
        case "3":
            return "AT";
        case "4":
            return "CA";
        case "5":
            return "RA";
        case "7":
            return "MA";
        default:
            return "Unknown";
    }
}

function openPdf(pdfUrl) {
    window.open(pdfUrl, "_blank");
}

$(document).ready(function () {
    function clearTableContents() {
        $(".table tbody").empty();
        $(".table thead").empty();
        $(".record-count").remove();
    }

    // Show loader function
    function showLoader() {
        $("#loader").show();
    }

    // Hide loader function
    function hideLoader() {
        $("#loader").hide();
    }

    // Add event listeners to tab buttons
    $(".tab ul.tabs li a").click(function () {
        clearTableContents();
    });

    // Event listener for search buttons
    $(".default-btn.btn-bg-three.border-radius-5").click(function () {
        clearTableContents();
    });

    function fetchJudgements(url, table_id, no_data_message, filters, headers, row_builder) {
        // Show loader before making AJAX request
        showLoader();
    
        $.ajax({
            url: url + "&t=" + new Date().getTime(), // Cache-busting
            type: "GET",
            dataType: "json",
            data: filters, // Pass updated filters
            success: function (response) {
                // Clear the table body and header
                $(`#${table_id} tbody`).empty();
                $(`#${table_id} thead`).empty();
    
                // Remove any existing record count display
                $(".record-count").remove();
    
                // Check if there's no data
                if (response.data.length === 0) {
                    var no_data_row = `<tr><td colspan="5" class="text-center text-primary fw-bold">${no_data_message}</td></tr>`;
                    $(`#${table_id} tbody`).append(no_data_row);
                } else {
                    // Rebuild the table header
                    var head = '<tr class="text-center">';
                    headers.forEach((header) => {
                        head += `<th class="header-cell">${header}</th>`;
                    });
                    head += "</tr>";
                    $(`#${table_id} thead`).append(head);
    
                    // Populate the table body with new rows
                    $.each(response.data, function (index, item) {
                        var row = "<tr>";
                        row += `<td class="index-cell">${response.from + index}</td>`;
                        row += row_builder(item);
                        row += "</tr>";
                        $(`#${table_id} tbody`).append(row);
                    });
    
                    // Ensure DataTable is properly destroyed and re-initialized
                    if ($.fn.DataTable.isDataTable(`#${table_id}`)) {
                        $(`#${table_id}`).DataTable().destroy(); // Destroy DataTable before reinitialization
                    }
    
                    // Reinitialize DataTable with the updated data
                    $(`#${table_id}`).DataTable({
                        responsive: true, // Make the table responsive
                        pageLength: 10, // Show 10 entries per page
                        lengthChange: true,  // Show entries dropdown
                        searching: true,  // Enable search input
                        paging: true,  // Enable pagination
                        info: true,  // Show "Showing X of Y entries"
                        ordering: true,  // Enable column sorting
                        columnDefs: [
                            { responsivePriority: 1, targets: 0 },  // First column priority
                            { responsivePriority: 2, targets: -1 }  // Last column priority (View button)
                        ],
                        initComplete: function () {
                            hideLoader();  // Hide the loader when table is initialized
                        }
                    });
    
                    // Attach click event handler for modalData buttons
                    $(document).on("click", ".modalData", handleModalDataClick);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                hideLoader(); // Hide loader in case of error
            }
        });
    }
    

    function handleModalDataClick() {
        var id = $(this).data("id");

        // Perform AJAX request to fetch data for the specific ID
        $.ajax({
            // url: "/cases/search/show/" + id, // Adjust this URL according to your route
            url: showUrl + "?id=" + id,
            type: "GET",
            dataType: "json",
            success: function (detailData) {
                displayModal(detailData);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    // Modal display function
    function displayModal(detailData) {
        const statusText = detailData.status == 1 ? "Pending" : "Disposed";
        const modalTitle = "Case Details";

        let modalBody = `
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Basic Information</h5>
                        <p><strong>Reg No:</strong> ${detailData.registration_no}</p>
                        <p><strong>Year:</strong> ${detailData.year}</p>
                        <p><strong>Diary No:</strong> ${detailData.diaryno}</p>
                        <p><strong>DOR:</strong> ${detailData.dor}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Advocates</h5>
                        <p><strong>Petitioner Advocate:</strong> ${detailData.padvocate}</p>
                        <p><strong>Respondent Advocate:</strong> ${detailData.radvocate}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Case Information</h5>
                        <p><strong>Petitioner:</strong> ${detailData.applicant}</p>
                        <p><strong>Respondent:</strong> ${detailData.respondent}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>PDF Documents</h5>
                        ${detailData.interim_judgements
                            .map((judgement) => {
                                let case_type = detailData.registration_no ? detailData.registration_no.slice(0, 2) : ""; 
                                var year = detailData.dor.split("-")[2];
                                var baseUrl = "https://aftdelhi.nic.in/assets/pending_cases/" + year + "/" + case_type + "/";
                                var pdfUrl = baseUrl + encodeURIComponent(judgement.pdfname.trim());
                                return `<button onclick="openPdf('${pdfUrl}')" class="btn btn-sm btn-success mb-2">View Order Dated: (${judgement.dol})</button>`;
                            }).join("")}
                        <p><strong>Status:</strong> ${statusText}</p>
                        <p><strong>Remarks:</strong> ${detailData.reopened}</p>
                    </div>
                </div>
            </div>`;

        const modalFooter = `<button id="printButton" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>`;

        $(".modal-body").html(modalBody);
        $(".modal-footer").html(modalFooter);
        $("#myModalLabel").text(modalTitle);
        $("#myModal").modal("show");

        $("#printButton").click(printModalContent);
    }
    
   // Filter by File Number
$("#filterButtonFileNumber").click(function () {
    var filters = { fileno: $("#fileno").val() };
    var url = baseUrl + "?fileno=" + filters.fileno;
    var headers = ["S No", "Reg No", "Year", "Petitioner", "Action"];
    var rowBuilder = function (item) {
        return `
            <td class="regno-cell">${item.registration_no}</td>
            <td class="year-cell">${item.year}</td>
            <td class="petitioner-cell">${truncateText(item.applicant, 30)}</td>
            <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View Details</button></td>
        `;
    };
    fetchJudgements(url, "dataTableFileNumber", "No data available for given search.", filters, headers, rowBuilder);
});
$("#filterButtonPartyName").click(function () {
    var filters = { partyname: $("#partyname").val() };
    var url = baseUrl + "?partyname=" + filters.partyname;
    var headers = ["S No", "Reg No", "Year", "Petitioner", "Action"];
    var rowBuilder = function (item) {
        return `
            <td class="regno-cell">${item.registration_no}</td>
            <td class="petitioner-cell">${item.year}</td>
            <td class="petitioner-cell">${truncateText(item.applicant, 30)}</td>

            <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View Details</button></td>
        `;
    };
    fetchJudgements(url, "dataTablePartyName", "No data available for given search.", filters, headers, rowBuilder);
});



// Filter by Advocate
$("#filterButtonAdvocate").click(function () {
    var filters = { advocate: $("#advocate").val() };
    var url = baseUrl + "?advocate=" + filters.advocate;
    var headers = ["S No", "Reg No", "Petitioner Advocate", "Respondent Advocate", "Action"];
    var rowBuilder = function (item) {
        return `
            <td class="regno-cell">${item.registration_no}</td>
            <td class="petitioner-advocate-cell">${truncateText(item.padvocate, 30)}</td>
            <td class="respondent-advocate-cell">${truncateText(item.radvocate, 30)}</td>
            <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button></td>`;
    };
    fetchJudgements(url, "dataTableAdvocate", "No data available for given search.", filters, headers, rowBuilder);
});

// Filter by Case Type
$("#filterButtonCaseType").click(function () {
    var filters = { casetype: $("#casetype").val() };
    var url = baseUrl + "?casetype=" + filters.casetype;
    var headers = ["S No", "Reg No", "Case Type", "Petitioner", "Action"];
    var rowBuilder = function (item) {
        return `
            <td class="regno-cell">${item.registration_no}</td>
            <td class="case-type-cell">${item.registration_no.substring(0,2)}</td>
            <td class="petitioner-cell">${truncateText(item.applicant, 30)}</td>
            <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button></td>`;
    };
    fetchJudgements(url, "dataTableCaseType", "No data available for given search.", filters, headers, rowBuilder);
});

// Filter by Date
$("#filterButtonDate").click(function () {
    var filters = { casedate: $("#casedate").val() };
    var url = baseUrl + "?casedate=" + filters.casedate;
    var headers = ["S No", "Reg No", "Next Date", "Petitioner", "Action"];
    var rowBuilder = function (item) {
        return `
            <td class="regno-cell">${item.registration_no}</td>
            <td class="case-type-cell">${item.dol}</td>
            <td class="petitioner-cell">${truncateText(item.applicant, 30)}</td>
            <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button></td>`;
    };
    fetchJudgements(url, "dataTableDate", "No data available for given search.", filters, headers, rowBuilder);
});

 // Filter by Search Date (DOL)
 $("#filterButtonByDate").click(function () {
    var filters = { searchdate: $("#searchdate").val() };
    var url = baseUrl + "?searchdate=" + filters.searchdate;
    var headers = ["S No", "Reg No", "Date Order", "Petitioner", "Action"];
    
    var rowBuilder = function (item) {
        // Assuming item.interim_judgements is an array of judgements, we will use the first interim judgement for displaying purposes
        var interimJudgement = item.interim_judgements.length > 0 ? item.interim_judgements[0] : null;

        // If interimJudgement is available, display the details
        if (interimJudgement) {
            return `
                <td class="regno-cell">${item.registration_no}</td>
                <td class="case-type-cell">${interimJudgement.dol}</td> <!-- Display dol from interim_judgements -->
                <td class="petitioner-cell">${truncateText(item.applicant, 30)}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button></td>`;
        } else {
            return `
                <td class="regno-cell">${item.registration_no}</td>
                <td class="case-type-cell">N/A</td> <!-- No interim judgement available -->
                <td class="petitioner-cell">${truncateText(item.applicant, 30)}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button></td>`;
        }
    };
    
    fetchJudgements(url, "dataTableByDate", "No data available for given search.", filters, headers, rowBuilder);
});


});
