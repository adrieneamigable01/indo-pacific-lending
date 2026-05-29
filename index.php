<?php
include 'config.php';

$list = $conn->query("SELECT * FROM loan_applications ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Indo Pacific Lending System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        body{
            background:#f4f7fb;
        }

        .card{
            border:none;
            border-radius:18px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }

        .header{
            background:linear-gradient(45deg,#0d6efd,#4f8cff);
            color:white;
            padding:25px;
            border-radius:18px;
        }

        .modal-content{
            border-radius:20px;
        }
        .modal-body {
            max-height: 75vh;
            overflow-y: auto;
        }

        .co-maker-item {
            background: #f8f9fa;
        }
        .modal-body {
            max-height: 75vh;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        .select2-container--open {
            z-index: 9999999 !important;
        }

        .select2-dropdown {
            z-index: 9999999 !important;
        }
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default {
            width: 100% !important;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <div class="header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>INDO-PACIFIC LENDING CORP.</h2>
                <p class="mb-0">Loan Application Management System</p>
            </div>

            <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#borrowerModal">
                + Create Borrower
            </button>
        </div>
    </div>

    <div class="card p-4">

        <div class="d-flex justify-content-between mb-3">
            <h4>Loan Applications</h4>

        </div>

        <table class="table table-hover" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Borrower</th>
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Mobile</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = $list->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td>
                        <?= $row['last_name']; ?>,
                        <?= $row['first_name']; ?>
                        <?= $row['middle_name']; ?>
                    </td>
                    <td><?= $row['loan_type']; ?></td>
                    <td>₱<?= number_format($row['loan_amount'],2); ?></td>
                    <td><?= $row['mobile_no']; ?></td>

                    <td>
                        <!-- <a href="delete.php?id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this record?')">
                           Delete
                        </a> -->

                        <a href="print.php?id=<?= $row['id']; ?>"
                           target="_blank"
                           class="btn btn-success btn-sm">
                           Print
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<!-- CREATE BORROWER MODAL -->
<div class="modal fade" id="borrowerModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-sm">

            <!-- Header -->
            <div class="modal-header bg-primary text-white border-bottom-0 py-3">
                <h5 class="modal-title fw-semibold">Create Loan Application</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="save.php">
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3">

                        <!-- Profile Lookup -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm p-3">
                                <label class="form-label text-muted small fw-bold">FROM BPLC BORROWER</label>
                                <select id="bplc_borrower" class="form-control">
                                    <!-- Original selector kept exactly as is -->
                                </select>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm p-4">
                                <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">Personal Information</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">First Name</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Middle Name</label>
                                        <input type="text" name="middle_name" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">Civil Status</label>
                                        <select name="civil_status" class="form-control">
                                            <option>Single</option>
                                            <option>Married</option>
                                            <option>Widowed</option>
                                            <option>Separated</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">Mobile Number</label>
                                        <input type="text" name="mobile_no" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">TIN Number</label>
                                        <input type="text" name="tin_no" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">ID Presented</label>
                                        <input type="text" name="id_presented" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Email Address</label>
                                        <input type="email" name="email_address" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Home Address</label>
                                        <textarea name="home_address" class="form-control" rows="1"></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Spouse Name</label>
                                        <input type="text" name="spouse_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Employment Information -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm p-4">
                                <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">Employment & Income Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Company / School</label>
                                        <input type="text" name="company_school" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Employer Name</label>
                                        <input type="text" name="employer_name" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Position</label>
                                        <input type="text" name="position_name" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Basic Salary</label>
                                        <input type="number" step="0.01" name="basic_salary" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Annual Income</label>
                                        <input type="number" step="0.01" name="annual_income" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Collateral Details -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm p-4">
                                <div class="mb-3">
                                    <label class="form-label m-0"><strong>Collateral</strong></label>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">PRIMARY CARD TYPE</label>
                                        <select name="primary_card_name" class="form-control">
                                            <option value="Development Bank of the Philippines (DBP)">Development Bank of the Philippines (DBP)</option>
                                            <option value="LAND BANK OF THE PHILIPPINES ( UMID )">LAND BANK OF THE PHILIPPINES ( UMID )</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label text-muted small fw-semibold">PRIMARY CARD NUMBER</label>
                                        <input type="text" name="primary_card_number" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-muted small fw-semibold">SECONDARY CARD TYPE</label>
                                        <select name="secondary_card_name" class="form-control">
                                            <option value="Development Bank of the Philippines (DBP)">Development Bank of the Philippines (DBP)</option>
                                            <option value="LAND BANK OF THE PHILIPPINES ( UMID )">LAND BANK OF THE PHILIPPINES ( UMID )</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label text-muted small fw-semibold">SECONDARY CARD NUMBER</label>
                                        <input type="text" name="secondary_card_number" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Co-Maker Section -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="m-0"><strong>Co-Maker Information</strong></label>
                                    <button type="button" id="addCoMaker" class="btn btn-sm btn-primary px-3 rounded-pill">
                                        + Add Co-Maker
                                    </button>
                                </div>
                                <div id="coMakerContainer">
                                    <!-- DEFAULT CO-MAKER CONTAINER BLANK AS PROVIDED -->
                                    <div class="co-maker-item border rounded p-3 mt-2"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Loan Specifications -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm p-4">
                                <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">Loan Terms & Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Loan Type</label>
                                        <select name="loan_type" class="form-control">
                                            <option value="LONG TERM LOAN">LONG TERM LOAN</option>
                                            <option value="SHORT TERM LOAN">SHORT TERM LOAN</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Loan Amount</label>
                                        <input type="number" step="0.01" name="loan_amount" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted small fw-semibold">Loan Terms</label>
                                        <input type="text" name="loan_terms" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Collateral</label>
                                        <input type="text" name="collateral" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-semibold">Interest Rate</label>
                                        <select name="interest_rate" class="form-control">
                                            <option value="1.428">1.428%</option>
                                            <option value="3">3%</option>
                                            <option value="2">2%</option>
                                            <option value="1">1%</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label text-muted small fw-semibold">Loan Purpose</label>
                                        <textarea name="loan_purpose" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer bg-white border-top-0 p-3">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary px-4">Save Application</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/lz-string@1.4.4/libs/lz-string.min.js"></script>
<script>
$("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();

    $("#myTable tbody tr").filter(function() {
        $(this).toggle(
            $(this).text().toLowerCase().indexOf(value) > -1
        )
    });
});
</script>
<script>
let borrowerList = [];
let cacheKey = "borrower_list";
let isFetching = false;
$(document).ready(function(){
    
    initBorrowers();
    $('#myTable').DataTable({
        pageLength: 10,
        responsive: true,
        order: [[0, 'desc']], // sort by ID descending
        language: {
            search: "Search borrower:",
            emptyTable: "No records found"
        }
    });
    let html = `
    <div class="co-maker-item border rounded p-3 mt-2">

        <div class="d-flex justify-content-between mb-2">
            <strong>Co-Maker</strong>

            <label>
                <input type="checkbox" class="toggleBorrowerSelect">
                Use Borrower List
            </label>
        </div>

        <div class="row">

            <div class="col-md-4 mb-2 borrower-select-wrapper d-none">
                <label>Select Borrower</label>

                <select class="form-control coMakerSelect select2">
                    <option value="">SELECT CO-MAKER</option>
                </select>
            </div>

            <div class="col-md-4 mb-2">
                <label>Name</label>
                <input type="text" name="cm_name[]" class="form-control cm_name">
            </div>

            <div class="col-md-4 mb-2">
                <label>Phone</label>
                <input type="text" name="cm_phone[]" class="form-control cm_phone">
            </div>

            <div class="col-md-4 mb-2">
                <label>Address</label>
                <input type="text" name="cm_address[]" class="form-control cm_address">
            </div>

        </div>

        <button type="button" class="btn btn-sm btn-danger removeCoMaker mt-2">
            Remove
        </button>

    </div>
    `;



    function initBorrowers() {

        let cached = localStorage.getItem(cacheKey);

        if (cached) {

            try {
                borrowerList = JSON.parse(
                    LZString.decompressFromUTF16(cached)
                );

                fillBorrowerDropdown(borrowerList);

            } catch (e) {
                console.log("Cache corrupted");
                localStorage.removeItem(cacheKey);
            }
        }

        // Always refresh once (NO LOOP)
        fetchBorrower();
    }

    function fetchBorrower() {
      
        if (isFetching == true) return;
        isFetching = true;
        $.ajax({
            url: 'https://bplcapi.doitcebutech.com/borrower/all?is_active=1',
            type: 'GET',
            dataType: 'json',
            success: function (response) {

                let newData = response.all;
                
                borrowerList = newData;

                let compressed = LZString.compressToUTF16(
                    JSON.stringify(newData)
                );

                let oldCache = localStorage.getItem(cacheKey);

                // only update if changed
                if (oldCache !== compressed) {
                    localStorage.setItem(cacheKey, compressed);

                    fillBorrowerDropdown(newData);
                }

            },
            complete: function () {
                isFetching = false;
            },
            error: function () {
                console.log("API failed");
            }
        });
    }

    function fillDrodown(data){
                
       
        $.each(data,function(k,v){
            $("#bplc_borrower").append(
                $("<option>")
                .data({
                    'lastname':v.lastname,
                    'firstname':v.firstname,
                    'middlename':v.middlename,
                    'mobile':v.mobile,
                    'email':v.email,
                    'present_address':v.present_address,
                    'birthdate':v.birthdate,
                    'income':v.income,
                    'gender':v.gender,
                    'position_type':v.position_type,
                })
                .text(
                    v.fullname
                )
            );
        })

        
    }

    function fillBorrowerDropdown(data) {

        let $select = $("#bplc_borrower");

        $select.empty();

        $select.append(`
            <option value="">SELECT A BORROWER</option>
        `);

        $.each(data, function (k, v) {

            let fullName = `${v.firstname || ''} ${v.lastname || ''}`;

            $select.append(`
                <option
                    value="${v.borrower_id}"
                    data-lastname="${v.lastname}"
                    data-firstname="${v.firstname}"
                    data-middlename="${v.middlename}"
                    data-mobile="${v.mobile}"
                    data-email="${v.email}"
                    data-present_address="${v.present_address}"
                    data-birthdate="${v.birthdate}"
                    data-income="${v.income}"
                    data-gender="${v.gender}"
                    data-position_type="${v.position_type}">
                    ${fullName}
                </option>
            `);
        });
        $("#bplc_borrower").select2({
            width: 'resolve',
            dropdownParent: $("#borrowerModal"),
            placeholder: "Search borrower...",
            allowClear: true
        });
    }

    $("#bplc_borrower").on("change", function () {

        let selected = $(this).find("option:selected");

        // Example:
        // <option 
        //    value="1"
        //    data-last_name="DOE"
        //    data-first_name="JOHN"
        //    data-middle_name="SMITH">
        // </option>

        let lastname = selected.data("lastname") || "";
        let firstname = selected.data("firstname") || "";
        let middlename = selected.data("middlename") || "";
        let mobile = selected.data("mobile") || "";
        let email = selected.data("email") || "";
        let present_address = selected.data("present_address") || "";
        let birthdate = selected.data("birthdate") || "";
        let income = selected.data("income") || "";
        let annual_income = parseFloat(selected.data("income")) * 12 || "";
        let gender = selected.data("gender")|| "";
        let position_type = selected.data("position_type");

        $("input[name='last_name']").val(lastname);
        $("input[name='first_name']").val(firstname);
        $("input[name='middle_name']").val(middlename);
        $("input[name='mobile_no']").val(mobile);
        $(":input[name='home_address']").val(present_address);
        $("input[name='email_address']").val(email);
        $(":input[name='date_of_birth']").val(birthdate);
        $(":input[name='basic_salary']").val(income);
        $(":input[name='annual_income']").val(annual_income);
        $(":input[name='gender']").val(gender);
    });


    // ADD CO-MAKER
    /* =========================================
    ADD CO-MAKER
    ========================================= */
    $("#addCoMaker").on("click", function(){
       
        let html = `
        <div class="co-maker-item border rounded p-3 mt-2">

            <div class="d-flex justify-content-between mb-2">
                <strong>Co-Maker</strong>

                <label>
                    <input type="checkbox" class="toggleBorrowerSelect">
                    Use Borrower List
                </label>
            </div>

            <div class="row">

                <div class="col-md-4 mb-2 borrower-select-wrapper d-none">
                    <label>Select Borrower</label>

                    <select class="form-control coMakerSelect select2">
                        ${buildBorrowerOptions()}
                    </select>
                </div>

                <div class="col-md-4 mb-2">
                    <label>Name</label>
                    <input type="text" name="cm_name[]" class="form-control cm_name">
                </div>

                <div class="col-md-4 mb-2">
                    <label>Phone</label>
                    <input type="text" name="cm_phone[]" class="form-control cm_phone">
                </div>

                <div class="col-md-4 mb-2">
                    <label>Address</label>
                    <input type="text" name="cm_address[]" class="form-control cm_address">
                </div>

            </div>

            <button type="button" class="btn btn-sm btn-danger removeCoMaker mt-2">
                Remove
            </button>

        </div>`;
         let $html = $(html);
        $("#coMakerContainer").append(html);
        $html.find(".coMakerSelect").select2({
            width: '100%',
            placeholder: "Select Co-Maker",
            dropdownParent: $('#borrowerModal')
        });


    });

    function buildBorrowerOptions() {

        let options = `<option value="">SELECT CO-MAKER</option>`;
    
        $.each(borrowerList, function(k, v){

            let fullName = (v.firstname || '') + ' ' + (v.lastname || '');

            options += `
                <option
                    value="${v.borrower_id}"
                    data-name="${fullName}"
                    data-phone="${v.mobile || ''}"
                    data-address="${v.present_address || ''}">
                    ${fullName}
                </option>
            `;
        });

        return options;
    }

    /* =========================================
    SELECT CO-MAKER
    ========================================= */
    $(document).on("change", ".coMakerSelect", function(){

        let selected = $(this).find("option:selected");

        let parent = $(this).closest(".co-maker-item");

        parent.find(".cm_name").val(selected.data("name") || "");
        parent.find(".cm_phone").val(selected.data("phone") || "");
        parent.find(".cm_address").val(selected.data("address") || "");

    });



    // REMOVE CO-MAKER
    $(document).on("click", ".removeCoMaker", function(){
        $(this).closest(".co-maker-item").remove();
    });

    $(document).on("change", ".toggleBorrowerSelect", function(){

    let parent = $(this).closest(".co-maker-item");

    let wrapper = parent.find(".borrower-select-wrapper");

    if($(this).is(":checked")){

        wrapper.removeClass("d-none");

        wrapper.find("select").select2({
            width: '100%',
            placeholder: 'SELECT CO-MAKER'
        });

    } else {

        wrapper.addClass("d-none");

        // reset values
        parent.find(".cm_name").val("");
        parent.find(".cm_phone").val("");
        parent.find(".cm_address").val("");
    }

});
});
</script>
</body>
</html>