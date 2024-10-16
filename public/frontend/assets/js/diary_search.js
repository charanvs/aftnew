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

function showLoader() {
    $("#loader").show(); // Show the loader
}

function hideLoader() {
    $("#loader").hide(); // Hide the loader
}

$(document).ready(function () {
    function createTableHeader(tableId, headers) {
        $(tableId + ' thead').remove();
        var thead = `<thead><tr>`;
        headers.forEach(header => {
            thead += `<th>${header}</th>`;
        });
        thead += `</tr></thead>`;
        $(tableId).prepend(thead);
    }

    function clearTableContents(tableId) {
        if ($.fn.DataTable.isDataTable(tableId)) {
            $(tableId).DataTable().clear().destroy();
        }
        $(tableId + ' tbody').empty();
    }

    function fetchJudgements(
        baseUrl,
        table,
        noDataMessage,
        filters,
        rowBuilder
    ) {
        var url = new URL(baseUrl, window.location.origin);
        Object.keys(filters).forEach((key) => {
            if (filters[key]) {
                url.searchParams.set(key, filters[key]);
            }
        });
    
        showLoader(); // Show loader before the request starts
    
        $.ajax({
            url: url.href,
            type: "GET",
            dataType: "json",
            success: function (response) {
                table.clear().draw();
                if (response.data.length === 0) {
                    table.row.add(["", noDataMessage, "", "", ""]).draw();
                } else {
                    $.each(response.data, function (index, item) {
                        var row = rowBuilder(index, item);
                        table.row.add(row).draw();
                    });
                }
                hideLoader(); // Hide the loader once data is fetched
    
                // Ensure the click event is re-bound after the table rows are created
                $(".modalData").off('click').on('click', handleModalDataClick);
            },
            error: function (xhr) {
                hideLoader(); // Hide the loader even if there is an error
                console.error(xhr.responseText);
            },
        });
    }
    
    function handleModalDataClick() {
        var id = $(this).data("id");
        if (!id) {
            var modalTitle = "Error";
            var modalBody = "<p class='important-message'>Unable to display case details as the ID is not available.</p>";
            var modalFooter = "Click away to close this.";
    
            $("#myModalLabel").text(modalTitle);
            $(".modal-body").html(modalBody);
            $("#modal_footer").text(modalFooter);
            $("#myModal").modal("show");
            return;
        }
    
        $.ajax({
            url: showUrl + "?id=" + id,
            type: "GET",
            dataType: "json",
            success: function (detailData) {
                console.log(detailData); // Check the console for the returned data
                console.log("Url is: ",url);
                var modalTitle = "Case Details";
                var modalFooter = "Click away to close this.";
    
                // Always display the basic information
                var modalBody = '<div class="container">';
                modalBody += '<div class="row"><div class="col-md-12"><h5 class="modal-heading">Basic Information</h5>';
                modalBody += '<table class="table table-striped modal-table">';
                modalBody += "<tr><td><strong>Diary No:</strong></td><td>" + detailData.diaryno + "</td></tr>";
                modalBody += "<tr><td><strong>Nature of Document:</strong></td><td>" + detailData.nature_of_doc + "</td></tr>";
                modalBody += "<tr><td><strong>Presented By:</strong></td><td>" + detailData.presented_by + "</td></tr>";
                modalBody += "<tr><td><strong>Reviewed By:</strong></td><td>" + detailData.reviewed_by + "</td></tr>";
                modalBody += "<tr><td><strong>Associated With:</strong></td><td>" + (detailData.associated_with || "N/A") + "</td></tr>";
                modalBody += "<tr><td><strong>Date of Presentation:</strong></td><td>" + detailData.date_of_presentation + "</td></tr>";
                modalBody += "<tr><td><strong>Nature of Grievance:</strong></td><td>" + detailData.nature_of_grievance + "</td></tr>";
                
                // Add status information
                modalBody += "<tr><td><strong>Status:</strong></td><td>" + (detailData.status || "Pending") + "</td></tr>";
                modalBody += "</table></div></div>";
    
                // Check if there is a message and display it
                if (detailData.message) {
                    modalBody += '<div class="row">';
                    modalBody += '<div class="col-md-12">';
                    modalBody += '<p class="important-message" style="font-weight: bold; font-size: 16px; color: red;">';
                    modalBody += detailData.message;
                    modalBody += '</p>';
                    modalBody += '</div>';
                    modalBody += '</div>';
                } 
                // If there are defects/notifications, display them
                else if (detailData.notifications && detailData.notifications.length > 0) {
                    modalBody += '<div class="row"><div class="col-md-12"><h5 class="modal-heading">Defects</h5>';
                    modalBody += '<table class="table table-striped modal-table">';
                    modalBody += "<thead><tr><th>Defect</th><th>Rectified By</th><th>Nature</th><th>Time Granted</th><th>Rectified</th></tr></thead>";
                    modalBody += "<tbody>";
                    $.each(detailData.notifications, function (index, defect) {
                        modalBody += "<tr>";
                        modalBody += "<td>" + (defect.defect || 'N/A') + "</td>";
                        modalBody += "<td>" + (defect.rectified_by || 'N/A') + "</td>";
                        modalBody += "<td>" + (defect.nature || 'N/A') + "</td>";
                        modalBody += "<td>" + (defect.time_granted || 'N/A') + "</td>";
                        modalBody += "<td>" + (defect.rectified ? "Yes" : "No") + "</td>";
                        modalBody += "</tr>";
                    });
                    modalBody += "</tbody></table></div></div>"; // End of Defects Section
                }
    
                // Populate modal content
                $(".modal-body").html(modalBody);
                $("#myModalLabel").text(modalTitle);
                $("#modal_footer").text(modalFooter);
                $("#myModal").modal("show");
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }
     

    $("#filterButtonCaseNo").click(function () {
        var tableId = "#dataTableCaseNo";
        clearTableContents(tableId);

        createTableHeader(tableId, ["S No", "Case No", "Diary No", "Associated", "Action"]);

        var tableCaseNo = $(tableId).DataTable({
            responsive: true,
            autoWidth: false
        });

        var caseno = $("#caseno").val();
        if (!caseno) {
            showFlashMessage("flash-message-container-CaseNo", "Please provide a Case No.");
            return;
        }
        var filters = { caseno: caseno };

        fetchJudgements(baseUrl, tableCaseNo, "No data available for the given search.", filters, function (index, item) {
            return [
                index + 1,
                item.registration_no ? item.registration_no : "N/A",
                item.diary_no ? item.diary_no : "Not registered yet",
                item.associated_with ? item.associated_with : "N/A",
                `<button class="btn btn-primary btn-sm modalData" data-id="${item.id}" ${!item.id ? "disabled" : ""}>View</button>`
            ];
        });
    });

    $("#filterButtonDiaryNo").click(function () {
        var tableId = "#dataTableDiaryNo";
        clearTableContents(tableId);

        createTableHeader(tableId, ["S No", "Diary No", "Applicant", "Associated", "Action"]);

        var tableDiaryNo = $(tableId).DataTable({
            responsive: true,
            autoWidth: false
        });

        var diaryno = $("#diaryno").val();
        if (!diaryno) {
            showFlashMessage("flash-message-container-DiaryNo", "Please provide a Diary No.");
            return;
        }
        var filters = { diaryno: diaryno };

        fetchJudgements(baseUrl, tableDiaryNo, "No data available for the given search.", filters, function (index, item) {
            return [
                index + 1,
                item.diary_no,
                item.name ? item.name : "N/A",
                item.associated_with ? item.associated_with : "N/A",
                `<button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button>`
            ];
        });
    });

    $("#filterButtonApplicant").click(function () {
        var tableId = "#dataTableApplicant";
        clearTableContents(tableId);

        createTableHeader(tableId, ["S No", "Diary No", "Applicant", "Associated", "Action"]);

        var tableApplicant = $(tableId).DataTable({
            responsive: true,
            autoWidth: false
        });

        var applicant = $("#applicant").val();
        if (!applicant) {
            showFlashMessage("flash-message-container-Applicant", "Please provide an Applicant name.");
            return;
        }
        var filters = { applicant: applicant };

        fetchJudgements(baseUrl, tableApplicant, "No data available for the given search.", filters, function (index, item) {
            return [
                index + 1,
                item.diary_no,
                truncateText(item.name, 30),
                item.associated_with ? item.associated_with : "N/A",
                `<button class="btn btn-primary btn-sm modalData" data-id="${item.id}">View</button>`
            ];
        });
    });
});
