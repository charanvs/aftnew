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

function showFlashMessage(containerId, message) {
    var container = document.getElementById(containerId);
    var flashMessage = document.createElement("div");
    flashMessage.className = "flash-message error";
    flashMessage.innerText = message;
    container.innerHTML = "";
    container.appendChild(flashMessage);
    setTimeout(function () {
        container.innerHTML = "";
    }, 3000);
}

$(document).ready(function () {
    function clearTableContents() {
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
                $(`#${tableId} tbody`).empty();
                $(`#${tableId} thead`).empty();
                $(`#${tableId} tfoot`).empty();

                // Remove any existing record count display
                $(".record-count").remove();

                if (response.data.length === 0) {
                    var noDataRow = `<tr><td colspan="5" class="text-center text-primary fw-bold">${noDataMessage}</td></tr>`;
                    $(`#${tableId} tbody`).append(noDataRow);
                } else {
                    var head = '<tr class="text-center">';
                    headers.forEach((header) => {
                        head += `<th class="header-cell">${header}</th>`;
                    });
                    head += "</tr>";
                    $(`#${tableId} thead`).append(head);

                    $.each(response.data, function (index, item) {
                        var row = "<tr>";
                        row += `<td class="index-cell">${
                            response.from + index
                        }</td>`;
                        row += rowBuilder(item);
                        row += "</tr>";
                        $(`#${tableId} tbody`).append(row);
                    });

                    // Display the count of filtered records
                    var recordCount = `<p class="record-count">Showing ${response.from} to ${response.to} of ${response.total} records</p>`;
                    $(`#${paginationId}`).before(recordCount);

                    // Generate and display pagination links
                    var paginationLinks = "";
                    $.each(response.links, function (index, link) {
                        if (link.url === null) {
                            paginationLinks +=
                                '<li class="page-item disabled"><span class="page-link">' +
                                link.label +
                                "</span></li>";
                        } else {
                            var filteredUrl = new URL(
                                link.url,
                                window.location.origin
                            );
                            Object.keys(filters).forEach((key) => {
                                if (filters[key]) {
                                    filteredUrl.searchParams.set(
                                        key,
                                        filters[key]
                                    );
                                }
                            });
                            paginationLinks +=
                                '<li class="page-item' +
                                (link.active ? " active" : "") +
                                '"><a class="page-link" href="' +
                                filteredUrl.href +
                                '">' +
                                link.label +
                                "</a></li>";
                        }
                    });
                    $(`#${paginationId}`).html(paginationLinks);

                    $(".page-link").click(function (event) {
                        event.preventDefault();
                        if ($(this).attr("href") !== undefined) {
                            fetchJudgements(
                                $(this).attr("href"),
                                tableId,
                                noDataMessage,
                                paginationId,
                                filters,
                                headers,
                                rowBuilder
                            );
                        }
                    });

                    // Attach click event handler for modalData buttons
                    $(".modalData").click(handleModalDataClick);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    function handleModalDataClick() {
        var id = $(this).data("id");

        if (!id) {
            // Display a proper message if ID is not available
            var modalTitle = "Error";
            var modalBody =
                "<p>Unable to display case details as the ID is not available.</p>";
            var modalFooter = "Click away to close this.";

            // Populate modal with data
            $("#myModalLabel").text(modalTitle);
            $(".modal-body").html(modalBody);
            $("#modal_footer").text(modalFooter);

            // Open modal
            $("#myModal").modal("show");

            return; // Exit the function early
        }

        // Perform AJAX request to fetch data for the specific ID
        $.ajax({
           // url: "/diary/search/show/" + id, // Adjust this URL according to your route
            url : showUrl + "?id=" + id,
            type: "GET",
            dataType: "json",
            success: function (detailData) {
                console.log(detailData);

                var modalTitle = "Case Details"; // Set modal title
                var modalFooter = "Click away to close this.";

                var modalBody = '<div class="container">';
                modalBody += '<div class="row">';
                modalBody += '<div class="col-md-12">';
                modalBody += "<h5>Basic Information</h5>";
                modalBody += '<table class="table table-striped">';
                modalBody +=
                    "<tr><td><strong>Diary No:</strong></td><td>" +
                    detailData.diaryno +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Nature of Document:</strong></td><td>" +
                    detailData.nature_of_doc +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Presented By:</strong></td><td>" +
                    detailData.presented_by +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Reviewed By:</strong></td><td>" +
                    detailData.reviewed_by +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Associated With:</strong></td><td>" +
                    detailData.associated_with +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Date of Presentation:</strong></td><td>" +
                    detailData.date_of_presentation +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Nature of Grievance:</strong></td><td>" +
                    detailData.nature_of_grievance +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Subject:</strong></td><td>" +
                    detailData.subject +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Result:</strong></td><td>" +
                    detailData.result +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Section Officer's Remark:</strong></td><td>" +
                    detailData.so_remark +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Deputy Registrar's Remark:</strong></td><td>" +
                    detailData.dr_remark +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Registrar's Remark:</strong></td><td>" +
                    detailData.pr_remark +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>Not Completed Observations:</strong></td><td>" +
                    detailData.nc_observations +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>No. of Applicants:</strong></td><td>" +
                    detailData.no_of_applicants +
                    "</td></tr>";
                modalBody +=
                    "<tr><td><strong>No. of Respondents:</strong></td><td>" +
                    detailData.no_of_respondents +
                    "</td></tr>";
                modalBody += "</table>";
                modalBody += "</div>";
                modalBody += "</div>"; // End of row

                // Display Defects
                modalBody += '<div class="row">';
                modalBody += '<div class="col-md-12">';
                modalBody += "<h5>Defects</h5>";
                modalBody += '<table class="table table-striped">';
                modalBody += "<thead>";
                modalBody += "<tr>";
                modalBody += "<th>Defect</th>";
                modalBody += "<th>Rectified By</th>";
                modalBody += "<th>Nature</th>";
                modalBody += "<th>Time Granted</th>";
                modalBody += "<th>Rectified</th>";
                modalBody += "</tr>";
                modalBody += "</thead>";
                modalBody += "<tbody>";

                $.each(
                    detailData.notifications,
                    function (index, notification) {
                        // Trim and check if defect has more than 5 characters
                        var defectValue = notification.defect
                            ? notification.defect.trim()
                            : "";
                        if (defectValue.length > 5) {
                            modalBody += "<tr>";
                            modalBody += "<td>" + notification.defect + "</td>";
                            modalBody +=
                                "<td>" +
                                (notification.rectified_by || "N/A") +
                                "</td>";
                            modalBody +=
                                "<td>" +
                                (notification.nature || "N/A") +
                                "</td>";
                            modalBody +=
                                "<td>" +
                                (notification.time_granted || "N/A") +
                                "</td>";
                            modalBody +=
                                "<td>" +
                                (notification.rectified || "N/A") +
                                "</td>";
                            modalBody += "</tr>";
                        }
                    }
                );
                modalBody += "</tbody>";
                modalBody += "</table>";
                modalBody += "</div>";
                modalBody += "</div>"; // End of row

                modalBody += "</div>"; // End of container

                $(".modal-body").html(modalBody); // Adjust fields according to your data structure

                // Populate modal with data
                $("#myModalLabel").text(modalTitle);
                $("#modal_footer").text(modalFooter);

                // Open modal
                $("#myModal").modal("show");

                // Close Modal
                $("#closeModalButton").click(function () {
                    $("#myModal").modal("hide");
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    $("#filterButtonCaseNo").click(function () {
        var caseno = $("#caseno").val();
        if (!caseno) {
            showFlashMessage(
                "flash-message-container-CaseNo",
                "Please give search value?"
            );
            return;
        }
        var filters = {};
        filters.caseno = $("#caseno").val();
        var url = baseUrl + "?caseno=" + filters.caseno;
       // var url = `/diary/search/all?caseno=${filters.caseno}`;
        var headers = ["S No", "Case No", "Diary No", "Associated", "Action"];
        // Updated rowBuilder function
        var rowBuilder = function (item) {
            return `
        <td class="regno-cell">${item.registration_no}</td>
        <td class="year-cell">${
            item.diary_no !== undefined && item.diary_no !== ""
                ? item.diary_no
                : "Not registered yet"
        }</td>
        <td class="petitioner-cell">${item.associated_with}</td>
        <td><button class="btn btn-primary btn-sm modalData" data-id="${
            item.id ? item.id : ""
        }" ${!item.id ? "disabled" : ""}>View</button></td>
    `;
        };
        fetchJudgements(
            url,
            "dataTableCaseNo",
            "No data available for given search.",
            "paginationLinksCaseNo",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonDiaryNo").click(function () {
        var diaryno = $("#diaryno").val();
        if (!diaryno) {
            showFlashMessage(
                "flash-message-container-DiaryNo",
                "Please give Diary No?"
            );
            return;
        }
        var filters = {};
        filters.diaryno = $("#diaryno").val();
        var url = baseUrl + "?diaryno=" + filters.diaryno;
       // var url = `/diary/search/all?diaryno=${filters.diaryno}`;
        var headers = ["S No", "Diary No", "Applicant", "Action"];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.diary_no}</td>
                <td class="applicant-cell">${item.name}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button>
                   </td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableDiaryNo",
            "No data available for given search.",
            "paginationLinksDiaryNo",
            filters,
            headers,
            rowBuilder
        );
    });

    $("#filterButtonApplicant").click(function () {
        var applicant = $("#applicant").val();
        if (!applicant) {
            showFlashMessage(
                "flash-message-container-Applicant",
                "Please give Applicant?"
            );
            return;
        }
        var filters = {};
        filters.applicant = $("#applicant").val();
        var url = baseUrl + "?applicant=" + filters.applicant;
      //  var url = `/diary/search/all?applicant=${filters.applicant}`;
        var headers = ["S No", "Diary No", "Applicant", "Associated", "Action"];
        var rowBuilder = function (item) {
            return `
                <td class="regno-cell">${item.diary_no}</td>
                <td class="petitioner-advocate-cell">${truncateText(
                    item.name,
                    30
                )}</td>
                <td class="regno-cell">${item.associated_with}</td>
                <td><button class="btn btn-primary btn-sm modalData" data-id="${
                    item.id
                }">View</button>
                </td>
            `;
        };
        fetchJudgements(
            url,
            "dataTableApplicant",
            "No data available for given search.",
            "paginationLinksApplicant",
            filters,
            headers,
            rowBuilder
        );
    });

});
