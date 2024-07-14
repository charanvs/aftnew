$(document).ready(function () {
    const searchBaseUrl = "/search/case"; // Update this to match your route for search
    const detailBaseUrl = "/cases/search/show"; // Update this to match your route for details
    const truncateLength = 30;

    function handleModalDataClick() {
        const id = $(this).data("id");
        const fullUrl = `${detailBaseUrl}/${id}`;

        $.ajax({
            url: fullUrl,
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

    function displayModal(detailData) {
        const statusValue = parseInt(detailData.status, 10);
        const statusText = statusValue === 1 ? "Pending" : "Disposed";
        const modalTitle = "Case Details";

        let modalBody = `
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Basic Information</h5>
                        <p><strong>Reg No:</strong> ${
                            detailData.registration_no
                        }</p>
                        <p><strong>Year:</strong> ${detailData.year}</p>
                        <p><strong>Department:</strong> ${
                            detailData.diaryno
                        }</p>
                        <p><strong>Associated:</strong> ${
                            detailData.case_type
                        }</p>
                        <p><strong>DOR:</strong> ${detailData.dor}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Advocates</h5>
                        <p><strong>Petitioner Advocate:</strong> ${
                            detailData.padvocate
                        }</p>
                        <p><strong>Respondent Advocate:</strong> ${
                            detailData.radvocate
                        }</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Subject:</strong> ${detailData.location}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Case Information</h5>
                        <p><strong>Petitioner:</strong> ${
                            detailData.applicant
                        }</p>
                        <p><strong>Respondent:</strong> ${
                            detailData.respondent
                        }</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Court Information</h5>
                        ${detailData.case_dependencies
                            .map((dependency) => {
                                const dolDate = new Date(
                                    dependency.dol
                                        .split("-")
                                        .reverse()
                                        .join("-")
                                );
                                return `<p><strong>Date Hearing:</strong> ${dolDate.toLocaleDateString()}</p>`;
                            })
                            .join("")}
                        <p><strong>Status:</strong> ${statusText}</p>
                        <p><strong>Remarks:</strong> ${detailData.reopened}</p>
                    </div>
                </div>
            </div>`;

        const modalFooter =
            '<button id="printButton" class="btn btn-primary">Print</button> Click away to close this.';
        $(".modal-body").html(modalBody);
        $("#modal_footer").html(modalFooter);
        $("#myModalLabel").text(modalTitle);
        $("#myModal").modal("show");

        $("#printButton").click(printModalContent);
        $("#closeModalButton").click(closeModal);
    }

    function printModalContent() {
        const printWindow = window.open("", "_blank");
        printWindow.document.write(`
            <html>
            <head>
                <title>Print</title>
                <style>body { text-align: center; } .container { margin: 0 auto; width: 80%; }</style>
            </head>
            <body>
                <h1>${$("#myModalLabel").text()}</h1>
                ${document.querySelector("#myModal .modal-body").innerHTML}
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

    function closeModal() {
        $("#myModal").modal("hide");
    }

    function fetchJudgements(url, tableId, searchKey, truncateLength = 30) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (response) {
                updateTable(response, tableId, searchKey, truncateLength);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    function updateTable(response, tableId, searchKey, truncateLength) {
        const tableBody = $(`${tableId} tbody`).empty();
        const tableHead = $(`${tableId} thead`).empty();

        if (response.data.length === 0) {
            tableBody.append(
                '<tr><td colspan="5" class="text-center text-primary">No data available for given search.</td></tr>'
            );
        } else {
            let headContent = "";
            let rowContent = "";

            if (searchKey === "partyname") {
                headContent = `
                    <tr class="text-center">
                        <th class="header-cell">Reg No</th>
                        <th class="header-cell">Applicant</th>
                        <th class="header-cell">Action</th>
                    </tr>`;
                response.data.forEach((item) => {
                    const truncatedApplicant =
                        item.applicant.length > truncateLength
                            ? `${item.applicant.substring(
                                  0,
                                  truncateLength
                              )}...`
                            : item.applicant;
                    rowContent += `
                        <tr>
                            <td class='regno-cell'>${item.registration_no}</td>
                            <td class='applicant-cell'>${truncatedApplicant}</td>
                            <td><button class='btn btn-primary btn-sm modalData' data-id='${item.id}'>View Details</button></td>
                        </tr>`;
                });
            } else if (searchKey === "advocate") {
                headContent = `
                    <tr class="text-center">
                        <th class="header-cell">Reg No</th>
                        <th class="header-cell">Petitioner Advocate</th>
                        <th class="header-cell">Respondent Advocate</th>
                        <th class="header-cell">Action</th>
                    </tr>`;
                response.data.forEach((item) => {
                    rowContent += `
                        <tr>
                            <td class='regno-cell'>${item.registration_no}</td>
                            <td class='padvocate-cell'>${
                                item.padvocate.length > 25
                                    ? item.padvocate.substring(0, 25) + "..."
                                    : item.padvocate
                            }</td>
                            <td class='radvocate-cell'>${
                                item.radvocate.length > 25
                                    ? item.radvocate.substring(0, 25) + "..."
                                    : item.radvocate
                            }</td>
                            <td><button class='btn btn-primary btn-sm modalData' data-id='${
                                item.id
                            }'>View Details</button></td>
                        </tr>`;
                });
            } else if (searchKey === "casedate") {
                headContent = `
                    <tr class="text-center">
                        <th class="header-cell">Reg No</th>
                        <th class="header-cell">Last Date Hearing</th>
                        <th class="header-cell">Applicant</th>
                        <th class="header-cell">Action</th>
                    </tr>`;
                response.data.forEach((item) => {
                    rowContent += `
                        <tr>
                            <td class='regno-cell'>${item.registration_no}</td>
                            <td class='regno-cell'>${item.dol}</td>
                            <td class='radvocate-cell'>${
                                item.applicant.length > 25
                                    ? item.applicant.substring(0, 25) + "..."
                                    : item.applicant
                            }</td>
                            <td><button class='btn btn-primary btn-sm modalData' data-id='${
                                item.id
                            }'>View Details</button></td>
                        </tr>`;
                });
            } else {
                headContent = `
                    <tr class="text-center">
                        <th class="header-cell">S No</th>
                        <th class="header-cell">Reg No</th>
                        <th class="header-cell">Petitioner</th>
                        <th class="header-cell">Action</th>
                    </tr>`;
                response.data.forEach((item, index) => {
                    const truncatedApplicant =
                        item.applicant.length > truncateLength
                            ? `${item.applicant.substring(
                                  0,
                                  truncateLength
                              )}...`
                            : item.applicant;
                    rowContent += `
                        <tr>
                            <td class='index-cell'>${response.from + index}</td>
                            <td class='regno-cell'>${item.registration_no}</td>
                            <td class='padvocate-cell'>${truncatedApplicant}</td>
                            <td><button class='btn btn-primary btn-sm modalData' data-id='${
                                item.id
                            }'>View Details</button></td>
                        </tr>`;
                });
            }

            tableHead.append(headContent);
            tableBody.append(rowContent);

            $("#paginationLinks").html(response.links);
            $("#paginationLinks .page-link").click(function (event) {
                event.preventDefault();
                if ($(this).attr("href") !== undefined) {
                    fetchJudgements(
                        $(this).attr("href"),
                        tableId,
                        searchKey,
                        truncateLength
                    );
                }
            });

            $(".modalData").click(handleModalDataClick);
        }
    }

    function setupFilterButton(
        buttonId,
        queryParams,
        tableId,
        searchKey,
        length = truncateLength
    ) {
        $(buttonId).click(function () {
            let queryStr = "";
            queryParams.forEach((param, index) => {
                let paramValue = $(param).val();
                // Format date if the parameter is 'casedate'
                if (param === "#casedate") {
                    paramValue = formatDate(paramValue);
                }
                queryStr += `${param.substring(1)}=${paramValue}`;
                if (index < queryParams.length - 1) {
                    queryStr += "&";
                }
            });
            fetchJudgements(
                `${searchBaseUrl}?${queryStr}`,
                tableId,
                searchKey,
                length
            );
        });
    }

    function formatDate(dateString) {
        if (typeof dateString !== "string") {
            return dateString;
        }
        var date = dateString.split("-");
        return date[2] + "-" + date[1] + "-" + date[0];
    }

    setupFilterButton(
        "#filterButtonFile",
        ["#fileno", "#year"],
        "#dataTableFile",
        "fileno"
    );
    setupFilterButton(
        "#filterButtonPartyName",
        ["#partyname"],
        "#dataTablePartyName",
        "partyname",
        40
    );
    setupFilterButton(
        "#filterButtonAdvocate",
        ["#advocate"],
        "#dataTableAdvocate",
        "advocate",
        15
    );
    setupFilterButton(
        "#filterButtonCaseType",
        ["#casetype"],
        "#dataTableCaseType",
        "casetype"
    );
    setupFilterButton(
        "#filterButtonCaseDate",
        ["#casedate"],
        "#dataTableCaseDate",
        "casedate",
        30
    );
    setupFilterButton(
        "#filterButtonSubject",
        ["#subject"],
        "#dataTableSubject",
        "subject"
    );

    $(document).on("click", ".modalData", handleModalDataClick);
});
