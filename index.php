<?php
include 'config.php';

$list = $conn->query("SELECT * FROM loan_applications WHERE isActive = 1 ORDER BY id DESC");
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
       .select2-container--open,
.select2-dropdown {
    z-index: 999999 !important;
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
                        <button type="button" 
                            class="btn btn-primary btn-sm edit-borrower-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#borrowerModal"
                            data-id="<?= $row['id']; ?>"
                            data-last_name="<?= htmlspecialchars($row['last_name']); ?>"
                            data-first_name="<?= htmlspecialchars($row['first_name']); ?>"
                            data-middle_name="<?= htmlspecialchars($row['middle_name']); ?>"
                            data-date_of_birth="<?= $row['date_of_birth']; ?>"
                            data-civil_status="<?= $row['civil_status']; ?>"
                            data-gender="<?= $row['gender']; ?>"
                            data-tin_no="<?= htmlspecialchars($row['tin_no']); ?>"
                            data-id_presented="<?= htmlspecialchars($row['id_presented']); ?>"
                            data-mobile_no="<?= htmlspecialchars($row['mobile_no']); ?>"
                            data-email_address="<?= htmlspecialchars($row['email_address']); ?>"
                            data-home_address="<?= htmlspecialchars($row['home_address']); ?>"
                            data-company_school="<?= htmlspecialchars($row['company_school']); ?>"
                            data-employer_name="<?= htmlspecialchars($row['employer_name']); ?>"
                            data-position_name="<?= htmlspecialchars($row['position_name']); ?>"
                            data-basic_salary="<?= $row['basic_salary']; ?>"
                            data-annual_income="<?= $row['annual_income']; ?>"
                            data-spouse_name="<?= htmlspecialchars($row['spouse_name']); ?>"
                            data-loan_type="<?= $row['loan_type']; ?>"
                            data-loan_amount="<?= $row['loan_amount']; ?>"
                            data-loan_purpose="<?= htmlspecialchars($row['loan_purpose']); ?>"
                            data-loan_terms="<?= htmlspecialchars($row['loan_terms']); ?>"
                            data-collateral="<?= htmlspecialchars($row['collateral']); ?>"
                            data-interest_rate="<?= $row['interest_rate']; ?>"
                            data-primary_card_name="<?= htmlspecialchars($row['primary_card_name']); ?>"
                            data-primary_card_number="<?= htmlspecialchars($row['primary_card_number']); ?>"
                            data-secondary_card_name="<?= htmlspecialchars($row['secondary_card_name']); ?>"
                            data-secondary_card_number="<?= htmlspecialchars($row['secondary_card_number']); ?>">
                        Edit
                    </button>
                        <a href="print.php?id=<?= $row['id']; ?>"
                           target="_blank"
                           class="btn btn-success btn-sm">
                           Print
                        </a>
                        
                        <a href="delete.php?id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this record?')">
                           Delete
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
                        <input type="hidden" name="id" id="modal_id">
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
                                            <option value="UNION BANK OF THE PHILIPPINES ( UBP )">UNION BANK OF THE PHILIPPINES ( UBP )</option>
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
                                            <option value="UNION BANK OF THE PHILIPPINES ( UBP )">UNION BANK OF THE PHILIPPINES ( UBP )</option>
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
                                            <option value="INTEREST ONLY">INTEREST ONLY</option>
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
    $.fn.modal.Constructor.prototype._enforceFocus = function () {};
    initBorrowers();
    $(document).on('select2:open', function () {
        setTimeout(() => {
            document.querySelector('.select2-search__field')?.focus();
        }, 100);
    });
    $('#myTable').DataTable({
        pageLength: 10,
        responsive: true,
        order: [[0, 'asc']], // sort by ID descending
        language: {
            search: "Search borrower:",
            emptyTable: "No records found"
        },
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
            dropdownParent: $('#borrowerModal'),
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
    $("#addCoMaker").on("click", function () {

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

                <select class="form-control coMakerSelect">
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

    // ✔ append FIRST
    let $html = $(html);
    $("#coMakerContainer").append($html);

    // ✔ init select2 AFTER append
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
            placeholder: 'SELECT CO-MAKER',
            dropdownParent: $('#borrowerModal')
        });

    } else {

        wrapper.addClass("d-none");

        // reset values
        parent.find(".cm_name").val("");
        parent.find(".cm_phone").val("");
        parent.find(".cm_address").val("");
    }

    });
    // On clicking the edit button
    $('.edit-borrower-btn').on('click', function() {
        // Change Modal Header text to hint update context
        $('#borrowerModal .modal-title').text('Update Loan Application');
        
        // Grab all dataset properties into a variable
        var data = $(this).data();
        
        // Map database fields to input fields matching exact 'name' attributes
        $('#modal_id').val(data.id);
        $('input[name="last_name"]').val(data.last_name);
        $('input[name="first_name"]').val(data.first_name);
        $('input[name="middle_name"]').val(data.middle_name);
        $('input[name="date_of_birth"]').val(data.date_of_birth);
        $('select[name="civil_status"]').val(data.civil_status || 'Single');
        $('select[name="gender"]').val(data.gender || 'Male');
        $('input[name="mobile_no"]').val(data.mobile_no);
        $('input[name="tin_no"]').val(data.tin_no);
        $('input[name="id_presented"]').val(data.id_presented);
        $('input[name="email_address"]').val(data.email_address);
        $('textarea[name="home_address"]').val(data.home_address);
        $('input[name="spouse_name"]').val(data.spouse_name);
        
        // Employment & Income Details
        $('input[name="company_school"]').val(data.company_school);
        $('input[name="employer_name"]').val(data.employer_name);
        $('input[name="position_name"]').val(data.position_name);
        $('input[name="basic_salary"]').val(data.basic_salary);
        $('input[name="annual_income"]').val(data.annual_income);
        
        // Collateral Details
        $('select[name="primary_card_name"]').val(data.primary_card_name);
        $('input[name="primary_card_number"]').val(data.primary_card_number);
        $('select[name="secondary_card_name"]').val(data.secondary_card_name);
        $('input[name="secondary_card_number"]').val(data.secondary_card_number);
        
        // Loan Specs
        $('select[name="loan_type"]').val(data.loan_type || 'LONG TERM LOAN');
        $('input[name="loan_amount"]').val(data.loan_amount);
        $('input[name="loan_terms"]').val(data.loan_terms);
        $('input[name="collateral"]').val(data.collateral);
        $('select[name="interest_rate"]').val(data.interest_rate || '1.428');
        $('textarea[name="loan_purpose"]').val(data.loan_purpose);
        
        // Fetch Co-Makers matching this loan application ID
        loadCoMakers(data.id);
    });

    // Reset layout header and clear forms if modal is closed or opened via an "Add Application" route
    $('#borrowerModal').on('hidden.bs.modal', function () {
        $('#borrowerModal form')[0].reset();
        $('#modal_id').val('');
        $('#borrowerModal .modal-title').text('Create Loan Application');
        $('#coMakerContainer').html(`
            <div class="co-maker-item text-muted small text-center p-3 border border-dashed rounded bg-light">
                No Co-makers added yet. Click "+ Add Co-Maker" if needed.
            </div>`
        );
    });

    // Function to load and fill out Co-Maker information fields dynamically
    function loadCoMakers(loanApplicationId) {
    if (!loanApplicationId) return;

    $.ajax({
        url: 'get_comakers.php', 
        type: 'GET',
        data: { loan_application_id: loanApplicationId },
        dataType: 'json',
        success: function(response) {
            var container = $('#coMakerContainer');
            container.empty(); 

            if(response && response.length > 0) {
                $.each(response, function(index, comaker) {
                    
                    let uniqueId = 'loadedSwitch_' + comaker.id + '_' + index;

                    var html = `
                        <div class="co-maker-item border rounded p-3 mt-2 bg-white shadow-sm">
                            <input type="hidden" name="comaker_id[]" value="${comaker.id}">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="text-secondary small text-uppercase fw-bold">Co-Maker</strong>

                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input toggleBorrowerSelect" id="${uniqueId}">
                                    <label class="form-check-label small text-muted" for="${uniqueId}">Use Borrower List</label>
                                </div>
                            </div>

                            <div class="row g-2">

                                <div class="col-md-12 mb-2 borrower-select-wrapper d-none">
                                    <label class="form-label text-muted small fw-semibold">Select Borrower</label>
                                    <select class="form-select coMakerSelect">
                                        <option value="">-- Choose from registered borrowers --</option>
                                        ${buildBorrowerOptions()}
                                    </select>
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label class="form-label text-muted small fw-semibold">Name</label>
                                    <input type="text" name="cm_name[]" class="form-control cm_name" value="${comaker.name}">
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label class="form-label text-muted small fw-semibold">Phone</label>
                                    <input type="text" name="cm_phone[]" class="form-control cm_phone" value="${comaker.phone}">
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label class="form-label text-muted small fw-semibold">Address</label>
                                    <input type="text" name="cm_address[]" class="form-control cm_address" value="${comaker.address}">
                                </div>

                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger removeCoMaker mt-2 px-3 rounded-pill">
                                    Remove Co-Maker
                                </button>
                            </div>
                        </div>`;
                    
                    let $html = $(html);
                    
                    // --- DROPDOWN AUTO-MATCH LOGIC ---
                    // Search through the dropdown options to see if any option name matches the existing co-maker name
                    let matchedOption = $html.find(`.coMakerSelect option`).filter(function() {
                        return $(this).text().trim().toLowerCase() === comaker.name.trim().toLowerCase();
                    });

                    if (matchedOption.length > 0) {
                        // If a match is found in the borrower list, select it and turn on the toggle switch
                        matchedOption.prop('selected', true);
                        $html.find('.toggleBorrowerSelect').prop('checked', true);
                        $html.find('.borrower-select-wrapper').removeClass('d-none');
                    }

                    container.append($html);
                });
            } else {
                container.html(`
                    <div class="co-maker-item text-muted small text-center p-3 border border-dashed rounded bg-light">
                        No Co-makers found for this record.
                    </div>`
                );
            }
        },
        error: function() {
            console.log("Error loading Co-Makers.");
        }
    });
}
});
</script>
</body>
</html>