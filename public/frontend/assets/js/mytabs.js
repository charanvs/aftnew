var truncateText = function (text, maxLength) {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + "...";
    } else {
        return text;
    }
};

function openPdf(pdfUrl) {
    window.open(pdfUrl, "_blank");
}

$(document).ready(function () {
    function clearTableContents() {
        // Destroy any existing DataTable instance
        if ($.fn.DataTable.isDataTable(".table")) {
            $(".table").DataTable().clear().destroy();
        }
        $(".table tbody").empty();
        $(".table thead").empty();
        $(".table tfoot nav").empty();
        $(".record-count").remove();
    }

    // Add event listeners to tab buttons
    $(".tab ul.tabs li a").click(function (event) {
        clearTableContents();
    });

    // Event listener for search buttons
    $(".default-btn.btn-bg-three.border-radius-5").click(function (event) {
        clearTableContents();
    });

    function fetchJudgements(
        baseUrl,
        tableId,
        noDataMessage,
        paginationId,
        filters,
        headers,
        rowBuilder
    ) {
        var url = new URL(baseUrl, window.location.origin);
        Object.keys(filters).forEach((key) => {
            if (filters[key]) {
                url.searchParams.set(key, filters[key]);
            }
        });

        $.ajax({
            url: url.href,
            type: "GET",
            dataType: "json",
            success: function (response) {
                // Clear any previous table contents
                $(`#${tableId} tbody`).empty();
                $(`#${tableId} thead`).empty();
                $(`#${tableId} tfoot`).empty();

                // Remove any existing record count display
                $(".record-count").remove();

                if (response.data.length === 0) {
                    var noDataRow = `<tr><td colspan="5" class="text-center text-primary fw-bold">${noDataMessage}</td></tr>`;
                    $(`#${tableId} tbody`).append(noDataRow);
                } else {
                    // Generate table headers
                    var head = '<tr class="text-center">';
                    headers.forEach((header) => {
                        head += `<th class="header-cell">${header}</th>`;
                    });
                    head += "</tr>";
                    $(`#${tableId} thead`).append(head);

                    // Append table rows with fetched data
                    $.each(response.data, function (index, item) {
                        var row = "<tr>";
                        row += `<td class="index-cell">${response.from + index}</td>`;
                        row += rowBuilder(item);
                        row += "</tr>";
                        $(`#${tableId} tbody`).append(row);
                    });

                    // Display the count of filtered records
                    var recordCount = `<p class="record-count">Showing ${response.from} to ${response.to} of ${response.total} records</p>`;
                    $(`#${paginationId}`).before(recordCount);

                    // Initialize DataTable
                    $(`#${tableId}`).DataTable({
                        "paging": true, // Enable pagination
                        "searching": true, // Enable search
                        "ordering": true, // Enable sorting
                        "info": true, // Show table info
                        "destroy": true // Ensure reinitialization on every fetch
                    });

                    // Attach click event handler for modalData buttons
                    $(".modalData").click(handleModalDataClick);
                    $(".modalDataPDF").click(handleModalDataPDFClick);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    function handleModalDataClick() {
        var id = $(this).data("id");

        // Perform AJAX request to fetch data for the specific ID
        $.ajax({
            url: showUrl + "?id=" + id,
            type: "GET",
            dataType: "json",
            success: function (detailData) {
                var modalTitle = "Case Details"; // Set modal title
                var modalBody = '<div class="container theme-dark-two">';
                modalBody += '<div class="row">';
                modalBody += '<div class="col-md-6">';
                modalBody += "<h5>Basic Information</h5>";
                modalBody += "<p><strong>Reg No:</strong> " + detailData.regno + "</p>";
                modalBody += "<p><strong>Year:</strong> " + detailData.year + "</p>";
                modalBody += "<p><strong>Department:</strong> " + detailData.deptt + "</p>";
                modalBody += "<p><strong>Associated:</strong> " + detailData.associated + "</p>";
                modalBody += "<p><strong>DOR:</strong> " + detailData.dor + "</p>";
                modalBody += "</div>";
                modalBody += '<div class="col-md-6">';
                modalBody += "<h5>Advocates</h5>";
                modalBody += "<p><strong>Petitioner Advocate:</strong> " + detailData.padvocate + "</p>";
                modalBody += "<p><strong>Respondent Advocate:</strong> " + detailData.radvocate + "</p>";
                modalBody += "</div>";
                modalBody += "</div>"; // End of row
                modalBody += '<div class="row">';
                modalBody += '<div class="col-md-12">';
                modalBody += "<p><strong>Subject:</strong> " + detailData.subject + "</p>";
                modalBody += "</div>";
                modalBody += "</div>";
                modalBody += '<div class="row">';
                modalBody += '<div class="col-md-6">';
                modalBody += "<h5>Case Information</h5>";
                modalBody += "<p><strong>Petitioner:</strong> " + detailData.petitioner + "</p>";
                modalBody += "<p><strong>Respondent:</strong> " + detailData.associated + "</p>";
                modalBody += "</div>";
                modalBody += '<div class="col-md-6">';
                modalBody += "<h5>Court Information</h5>";
                modalBody += "<p><strong>Court No:</strong> " + detailData.court_no + "</p>";
                modalBody += "<p><strong>Corum:</strong> " + detailData.corum_descriptions.join(", ") + "</p>";
                modalBody += "<p><strong>Remarks:</strong> " + detailData.remarks + "</p>";
                modalBody += "</div>";
                modalBody += "</div>"; // End of row

                $(".modal-body").html(modalBody);
                $("#myModal").modal("show");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    function handleModalDataPDFClick() {
        var id = $(this).data("id");

        // Perform AJAX request to fetch data for the specific ID
        $.ajax({
            url: pdfUrl + "?id=" + id,
            type: "GET",
            dataType: "json",
            success: function (detailData) {
                var year = detailData.dod.split("-")[2];
                var case_type = detailData.case_type;
                var baseUrl = "https://aftdelhi.nic.in/assets/judgement/" + year + "/" + case_type + "/";
                var pdfUrl = baseUrl + encodeURIComponent(detailData.dpdf.trim());

                var newWindow = window.open(pdfUrl, "_blank");
                if (!newWindow || newWindow.closed || typeof newWindow.closed == "undefined") {
                    alert("The PDF could not be opened. Please check your browser settings.");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while trying to open the PDF. Please try again later.");
            },
        });
    }

    // Make sure to attach the event handler to the PDF buttons
    $(document).on("click", ".modalDataPDF", handleModalDataPDFClick);

    function getFilters() {
        return {
            fileno: $("#fileno").val(),
            partyname: $("#partyname").val(),
            advocate: $("#advocate").val(),
            casetype: $("#casetype").val(),
            casedate: $("#casedate").val(),
            subject: $("#subject").val(),
            judges: $("#judges").val(),
        };
    }


    $("#filterButtonFileNumber").click(function () {
        var filters = {};
        filters.fileno = $("#fileno").val();
        // filters.year = $("#year").val();
        //  var url = baseUrl + "?fileno=" + filters.fileno + "&year="+filters.year;
        var url = baseUrl + "?fileno=" + filters.fileno;
        // alert(url);
        //  var url = `{{ route('judgements.search.all') }}?fileno=${filters.fileno}&year=${filters.year}`;
        var headers = ["S No", "Reg No", "Year", "Petitioner", "Action"];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.regno}</td>
                <td class="year-cell">${item.year}</td>
                <td class="petitioner-cell">${truncateText(
                    item.petitioner,
                    30
                )}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                    <button class="btn btn-secondary btn-sm modalDataPDF" data-id="${
                        item.id
                    }">PDF</button></td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableFileNumber",
            "No data available for given search.",
            "paginationLinksFileNumber",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonPartyName").click(function () {
        var filters = {};
        filters.partyname = $("#partyname").val();
        var url = baseUrl + "?partyname=" + filters.partyname;
        // var url = `{{ route('judgements.search.all') }}?partyname=${filters.partyname}`;
        var headers = ["S No", "Reg No", "Applicant", "Action"];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.regno}</td>
                <td class="applicant-cell">${truncateText(
                    item.petitioner,
                    30
                )}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                    <button class="btn btn-secondary btn-sm modalDataPDF" data-id="${
                        item.id
                    }">PDF</button></td>
            `;
        };
        fetchJudgements(
            url,
            "dataTablePartyName",
            "No data available for given search.",
            "paginationLinksPartyName",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonAdvocate").click(function () {
        var filters = {};
        filters.advocate = $("#advocate").val();
        var url = baseUrl + "?advocate=" + filters.advocate;
        // var url = `{{ route('judgements.search.all') }}?advocate=${filters.advocate}`;
        var headers = [
            "S No",
            "Reg No",
            "Petitioner Advocate",
            "Respondent Advocate",
            "Action",
        ];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.regno}</td>
                <td class="petitioner-advocate-cell">${truncateText(
                    item.padvocate,
                    30
                )}</td>
                <td class="respondent-advocate-cell">${truncateText(
                    item.radvocate,
                    30
                )}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                    <button class="btn btn-secondary btn-sm modalDataPDF" data-id="${
                        item.id
                    }">PDF</button></td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableAdvocate",
            "No data available for given search.",
            "paginationLinksAdvocate",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonCaseType").click(function () {
        var filters = {};
        filters.casetype = $("#casetype").val();
        var url = baseUrl + "?casetype=" + filters.casetype;
        //var url = `{{ route('judgements.search.all') }}?casetype=${filters.casetype}`;
        var headers = ["S No", "Reg No", "Case Type", "Petitioner", "Action"];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.regno}</td>
                <td class="case-type-cell">${item.case_type}</td>
                <td class="petitioner-cell">${truncateText(
                    item.petitioner,
                    30
                )}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                    <button class="btn btn-secondary btn-sm modalDataPDF" data-id="${
                        item.id
                    }">PDF</button></td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableCaseType",
            "No data available for given search.",
            "paginationLinksCaseType",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonDate").click(function () {
        var filters = {};
        filters.casedate = $("#casedate").val();

        function formatInputDate(dateString) {
            if (typeof dateString !== "string") {
                return dateString;
            }
            var date = dateString.split("-");
            return date[2] + "-" + date[1] + "-" + date[0];
        }

        filters.casedate = formatInputDate(filters.casedate);
        var url = baseUrl + "?casedate=" + filters.casedate;
        // var url = `{{ route('judgements.search.all') }}?casedate=${filters.casedate}`;
        var headers = [
            "S No",
            "Reg No",
            "Date Decision",
            "Petitioner",
            "Action",
        ];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.regno}</td>
                <td class="case-type-cell">${item.dod}</td>
                <td class="petitioner-cell">${truncateText(
                    item.petitioner,
                    30
                )}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                    <button class="btn btn-secondary btn-sm modalDataPDF" data-id="${
                        item.id
                    }">PDF</button></td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableDate",
            "No data available for given search.",
            "paginationLinksDate",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonSubject").click(function () {
        var filters = {};
        filters.subject = $("#subject").val();
        var url = baseUrl + "?subject=" + filters.subject;
        // var url = `{{ route('judgements.search.all') }}?subject=${filters.subject}`;
        var headers = ["S No", "Reg No", "Subject", "Petitioner", "Action"];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.regno}</td>
                 <td class="petitioner-cell">${truncateText(
                     item.subject,
                     30
                 )}</td>
                <td class="petitioner-cell">${truncateText(
                    item.petitioner,
                    20
                )}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                    <button class="btn btn-secondary btn-sm modalDataPDF" data-id="${
                        item.id
                    }">PDF</button></td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableSubject",
            "No data available for given search.",
            "paginationLinksSubject",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonJudges").click(function () {
        var filters = {};
        filters.judges = $("#judges").val();
        var url = baseUrl + "?judges=" + filters.judges;
        // var url = `{{ route('judgements.search.all') }}?subject=${filters.subject}`;
        var headers = ["S No", "Reg No", "Corum", "Petitioner", "Action"];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.regno}</td>
                 <td class="petitioner-cell">${truncateText(
                     item.corum,
                     30
                 )}</td>
                <td class="petitioner-cell">${truncateText(
                    item.petitioner,
                    20
                )}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                    <button class="btn btn-secondary btn-sm modalDataPDF" data-id="${
                        item.id
                    }">PDF</button></td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableJudges",
            "No data available for given search.",
            "paginationLinksJudges",
            filters,
            headers,
            rowBuilder
        );
    });
    

    $(".modalDataPDF").click(handleModalDataPDFClick);
});

// Example function to toggle between light and dark modes
function toggleTheme(isDarkMode) {
    var modalContent = document.querySelector(".modal-body .container");
    if (isDarkMode) {
        modalContent.classList.remove("light-mode");
        modalContent.classList.add("dark-mode");
    } else {
        modalContent.classList.remove("dark-mode");
        modalContent.classList.add("light-mode");
    }
}

