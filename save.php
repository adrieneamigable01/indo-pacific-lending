<?php
include 'config.php';

/* =========================
   BORROWER DATA
========================= */
$id = $_POST['id'] ?? '';

// Fallback logic for fields that might be missing or blank in the modal UI
$last_name = $_POST['last_name'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$middle_name = $_POST['middle_name'] ?? '';
$date_of_birth = $_POST['date_of_birth'] ?? null;
$civil_status = $_POST['civil_status'] ?? '';
$gender = $_POST['gender'] ?? '';
$place_of_birth = $_POST['place_of_birth'] ?? '';
$citizenship = $_POST['citizenship'] ?? '';
$tel_no = $_POST['tel_no'] ?? '';
$tin_no = $_POST['tin_no'] ?? '';
$id_presented = $_POST['id_presented'] ?? '';
$mobile_no = $_POST['mobile_no'] ?? '';
$id_no = $_POST['id_no'] ?? '';
$email_address = $_POST['email_address'] ?? '';
$home_address = $_POST['home_address'] ?? '';

$company_school = $_POST['company_school'] ?? '';
$employer_name = $_POST['employer_name'] ?? '';
$company_address = $_POST['company_address'] ?? '';
$employment_date = $_POST['employment_date'] ?? null;
$position_name = $_POST['position_name'] ?? '';
$basic_salary = !empty($_POST['basic_salary']) ? $_POST['basic_salary'] : 0;
$annual_income = !empty($_POST['annual_income']) ? $_POST['annual_income'] : 0;

$spouse_name = $_POST['spouse_name'] ?? '';

$loan_type = $_POST['loan_type'] ?? '';
$loan_amount = !empty($_POST['loan_amount']) ? $_POST['loan_amount'] : 0;
$loan_purpose = $_POST['loan_purpose'] ?? '';
$loan_terms = $_POST['loan_terms'] ?? '';
$collateral = $_POST['collateral'] ?? '';
$interest_rate = !empty($_POST['interest_rate']) ? $_POST['interest_rate'] : 0;

$primary_card_name = $_POST['primary_card_name'] ?? '';
$primary_card_number = $_POST['primary_card_number'] ?? '';
$secondary_card_name = $_POST['secondary_card_name'] ?? '';
$secondary_card_number = $_POST['secondary_card_number'] ?? '';

// Sanitize regular string variables to protect against basic SQL breakages
$last_name = $conn->real_escape_string($last_name);
$first_name = $conn->real_escape_string($first_name);
$middle_name = $conn->real_escape_string($middle_name);
$civil_status = $conn->real_escape_string($civil_status);
$gender = $conn->real_escape_string($gender);
$tin_no = $conn->real_escape_string($tin_no);
$id_presented = $conn->real_escape_string($id_presented);
$mobile_no = $conn->real_escape_string($mobile_no);
$email_address = $conn->real_escape_string($email_address);
$home_address = $conn->real_escape_string($home_address);
$spouse_name = $conn->real_escape_string($spouse_name);
$company_school = $conn->real_escape_string($company_school);
$employer_name = $conn->real_escape_string($employer_name);
$position_name = $conn->real_escape_string($position_name);
$loan_type = $conn->real_escape_string($loan_type);
$loan_terms = $conn->real_escape_string($loan_terms);
$collateral = $conn->real_escape_string($collateral);
$loan_purpose = $conn->real_escape_string($loan_purpose);
$primary_card_name = $conn->real_escape_string($primary_card_name);
$primary_card_number = $conn->real_escape_string($primary_card_number);
$secondary_card_name = $conn->real_escape_string($secondary_card_name);
$secondary_card_number = $conn->real_escape_string($secondary_card_number);

/* =========================
   INSERT / UPDATE BORROWER
========================= */

if ($id == '') {
    // New Record Setup
    $sql = "INSERT INTO loan_applications (
        last_name, first_name, middle_name, date_of_birth, civil_status, gender,
        place_of_birth, citizenship, tel_no, tin_no, id_presented, mobile_no, id_no, 
        email_address, home_address, company_school, employer_name, company_address, 
        employment_date, position_name, basic_salary, annual_income, spouse_name, 
        loan_type, loan_amount, loan_purpose, loan_terms, collateral, interest_rate, 
        primary_card_name, primary_card_number, secondary_card_name, secondary_card_number
    ) VALUES (
        '$last_name', '$first_name', '$middle_name', '$date_of_birth', '$civil_status', '$gender',
        '$place_of_birth', '$citizenship', '$tel_no', '$tin_no', '$id_presented', '$mobile_no', '$id_no', 
        '$email_address', '$home_address', '$company_school', '$employer_name', '$company_address', 
        '$employment_date', '$position_name', '$basic_salary', '$annual_income', '$spouse_name', 
        '$loan_type', '$loan_amount', '$loan_purpose', '$loan_terms', '$collateral', '$interest_rate', 
        '$primary_card_name', '$primary_card_number', '$secondary_card_name', '$secondary_card_number'
    )";

    $conn->query($sql);
    $loan_id = $conn->insert_id;

} else {
    // Update Record Execution
    $id = intval($id);
    $sql = "UPDATE loan_applications SET
        last_name='$last_name', first_name='$first_name', middle_name='$middle_name',
        date_of_birth='$date_of_birth', civil_status='$civil_status', gender='$gender',
        place_of_birth='$place_of_birth', citizenship='$citizenship', tel_no='$tel_no',
        tin_no='$tin_no', id_presented='$id_presented', mobile_no='$mobile_no', id_no='$id_no',
        email_address='$email_address', home_address='$home_address', company_school='$company_school',
        employer_name='$employer_name', company_address='$company_address', employment_date='$employment_date',
        position_name='$position_name', basic_salary='$basic_salary', annual_income='$annual_income',
        spouse_name='$spouse_name', loan_type='$loan_type', loan_amount='$loan_amount',
        loan_purpose='$loan_purpose', loan_terms='$loan_terms', collateral='$collateral',
        interest_rate='$interest_rate', primary_card_name='$primary_card_name', 
        primary_card_number='$primary_card_number', secondary_card_name='$secondary_card_name',
        secondary_card_number='$secondary_card_number'
        WHERE id='$id'";

    $conn->query($sql);
    $loan_id = $id;
}

/* =========================
   CO-MAKER SYNC SECTION (CLEANEST METHOD)
========================= */

// Step 1: Collect tracking IDs for rows currently submitted to find deletes
$keep_ids = [];

if (!empty($_POST['cm_name'])) {
    $count = count($_POST['cm_name']);

    for ($i = 0; $i < $count; $i++) {
        $name    = $conn->real_escape_string($_POST['cm_name'][$i] ?? '');
        $phone   = $conn->real_escape_string($_POST['cm_phone'][$i] ?? '');
        $address = $conn->real_escape_string($_POST['cm_address'][$i] ?? '');
        
        // Grab tracking item ID if it exists (from loadCoMakers AJAX generation)
        $cm_id   = !empty($_POST['comaker_id'][$i]) ? intval($_POST['comaker_id'][$i]) : 0;

        if (trim($name) == '') continue;

        if ($cm_id > 0) {
            // Row exists in db -> UPDATE it
            $conn->query("UPDATE co_makers SET 
                            name = '$name', 
                            phone = '$phone', 
                            address = '$address' 
                          WHERE id = '$cm_id' AND loan_application_id = '$loan_id'");
            $keep_ids[] = $cm_id;
        } else {
            // New dynamic field row -> INSERT it
            $conn->query("INSERT INTO co_makers (loan_application_id, name, phone, address) 
                          VALUES ('$loan_id', '$name', '$phone', '$address')");
            $keep_ids[] = $conn->insert_id;
        }
    }
}

// Step 2: Delete any co-maker items that were removed by the user inside the updated modal
if ($id != '') {
    if (!empty($keep_ids)) {
        $ids_to_string = implode(',', $keep_ids);
        $conn->query("DELETE FROM co_makers WHERE loan_application_id = '$loan_id' AND id NOT IN ($ids_to_string)");
    } else {
        // If they removed all co-makers, drop all rows associated with this app ID
        $conn->query("DELETE FROM co_makers WHERE loan_application_id = '$loan_id'");
    }
}

header("Location: index.php");
exit;
?>