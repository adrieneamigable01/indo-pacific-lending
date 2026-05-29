<?php
include 'config.php';

$list = $conn->query("SELECT * FROM loan_applications ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Indo Pacific Lending System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

            <input type="text" id="search" class="form-control w-25" placeholder="Search Borrower">
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

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Create Loan Application</h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="save.php">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label>Last Name</label>
                            <input type="text"
                                name="last_name"
                                class="form-control"
                                required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>First Name</label>
                            <input type="text"
                                name="first_name"
                                class="form-control"
                                required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Middle Name</label>
                            <input type="text"
                                name="middle_name"
                                class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Date of Birth</label>
                            <input type="date"
                                   name="date_of_birth"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Civil Status</label>
                             <select name="civil_status" class="form-control">
                                <option>Single</option>
                                <option>Married</option>
                                <option>Widowed</option>
                                <option>Separated</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Gender</label>

                            <select name="gender" class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Mobile Number</label>
                            <input type="text"
                                   name="mobile_no"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>TIN Number</label>
                            <input type="text"
                                   name="tin_no"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>ID Presented</label>
                            <input type="text"
                                   name="id_presented"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email Address</label>
                            <input type="email"
                                   name="email_address"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Home Address</label>
                            <textarea name="home_address"
                                      class="form-control"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Company / School</label>
                            <input type="text"
                                   name="company_school"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Employer Name</label>
                            <input type="text"
                                   name="employer_name"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Position</label>
                            <input type="text"
                                   name="position_name"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Basic Salary</label>
                            <input type="number"
                                   step="0.01"
                                   name="basic_salary"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Annual Income</label>
                            <input type="number"
                                   step="0.01"
                                   name="annual_income"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Spouse Name</label>
                            <input type="text"
                                   name="spouse_name"
                                   class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label><strong>Collateral</strong></label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>PRIMARY CARD TYPE</label>
                                <select name="primary_card_name" class="form-control">
                                    <option value="Development Bank of the Philippines (DBP)">Development Bank of the Philippines (DBP)</option>
                                    <option value="LAND BANK OF THE PHILIPPINES ( UMID )">LAND BANK OF THE PHILIPPINES ( UMID )</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>PRIMARY CARD NUMBER</label>
                                <input type="text"
                                    name="primary_card_number"
                                    class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>PRIMARY CARD TYPE</label>
                                <select name="secondary_card_name" class="form-control">
                                    <option value="Development Bank of the Philippines (DBP)">Development Bank of the Philippines (DBP)</option>
                                    <option value="LAND BANK OF THE PHILIPPINES ( UMID )">LAND BANK OF THE PHILIPPINES ( UMID )</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>PRIMARY CARD NUMBER</label>
                                <input type="text"
                                    name="secondary_card_number"
                                    class="form-control">
                            </div>
                        </div>
                        <!-- ================= CO-MAKER DYNAMIC SECTION ================= -->

                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label><strong>Co-Maker Information</strong></label>

                                <button type="button" id="addCoMaker" class="btn btn-sm btn-primary">
                                    + Add Co-Maker
                                </button>
                            </div>

                            <div id="coMakerContainer">

                                <!-- DEFAULT CO-MAKER -->
                                <div class="co-maker-item border rounded p-3 mt-2">

                                    <div class="row">

                                        <div class="col-md-4 mb-2">
                                            <label>Co-Maker Name</label>
                                            <input type="text"
                                                name="cm_name[]"
                                                class="form-control"
                                                placeholder="Full Name">
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>Phone</label>
                                            <input type="text"
                                                name="cm_phone[]"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label>Address</label>
                                            <input type="text"
                                                name="cm_address[]"
                                                class="form-control">
                                        </div>

                                    </div>

                                    <button type="button"
                                            class="btn btn-sm btn-danger removeCoMaker">
                                        Remove
                                    </button>

                                </div>

                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Loan Type</label>
                            <select name="loan_type" class="form-control">
                                <option value="LONG TERM LOAN">LONG TERM LOAN</option>
                                <option value="SHORT TERM LOAN">SHORT TERM LOAN</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Loan Amount</label>
                            <input type="number"
                                   step="0.01"
                                   name="loan_amount"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Loan Terms</label>
                            <input type="text"
                                   name="loan_terms"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Collateral</label>
                            <input type="text"
                                   name="collateral"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Interest Rate</label>
                             <select name="interest_rate" class="form-control">
                                <option value="1.482">1.482%</option>
                                <option value="3">3%</option>
                                <option value="2">2%</option>
                                <option value="1">1%</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Loan Purpose</label>

                            <textarea name="loan_purpose"
                                      class="form-control"></textarea>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                    <button class="btn btn-primary">
                        Save Application
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

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
$(document).ready(function(){

    // ADD CO-MAKER
    $("#addCoMaker").on("click", function(){

        let html = `
        <div class="co-maker-item border rounded p-3 mt-2">

            <div class="row">

                <div class="col-md-4 mb-2">
                    <label>Co-Maker Name</label>
                    <input type="text" name="cm_name[]" class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>Phone</label>
                    <input type="text" name="cm_phone[]" class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>Address</label>
                    <input type="text" name="cm_address[]" class="form-control">
                </div>

            </div>

            <button type="button" class="btn btn-sm btn-danger removeCoMaker">
                Remove
            </button>

        </div>`;

        $("#coMakerContainer").append(html);
    });

    // REMOVE CO-MAKER
    $(document).on("click", ".removeCoMaker", function(){
        $(this).closest(".co-maker-item").remove();
    });

});
</script>
</body>
</html>