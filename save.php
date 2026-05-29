<?php
include 'config.php';

/* =========================
   BORROWER DATA
========================= */

$id = $_POST['id'] ?? '';

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];

$date_of_birth = $_POST['date_of_birth'];
$civil_status = $_POST['civil_status'];
$gender = $_POST['gender'];
$place_of_birth = $_POST['place_of_birth'];
$citizenship = $_POST['citizenship'];
$tel_no = $_POST['tel_no'];
$tin_no = $_POST['tin_no'];
$id_presented = $_POST['id_presented'];
$mobile_no = $_POST['mobile_no'];
$id_no = $_POST['id_no'];
$email_address = $_POST['email_address'];
$home_address = $_POST['home_address'];

$company_school = $_POST['company_school'];
$employer_name = $_POST['employer_name'];
$company_address = $_POST['company_address'];
$employment_date = $_POST['employment_date'];
$position_name = $_POST['position_name'];
$basic_salary = $_POST['basic_salary'];
$annual_income = $_POST['annual_income'];

$spouse_name = $_POST['spouse_name'];

$loan_type = $_POST['loan_type'];
$loan_amount = $_POST['loan_amount'];
$loan_purpose = $_POST['loan_purpose'];
$loan_terms = $_POST['loan_terms'];
$collateral = $_POST['collateral'];
$interest_rate = $_POST['interest_rate'];

$primary_card_name = $_POST['primary_card_name'];
$primary_card_number = $_POST['primary_card_number'];
$secondary_card_name = $_POST['secondary_card_name'];
$secondary_card_number = $_POST['secondary_card_number'];

/* =========================
   INSERT / UPDATE BORROWER
========================= */

if ($id == '') {

    $sql = "INSERT INTO loan_applications (
        last_name, first_name, middle_name,
        date_of_birth, civil_status, gender,
        place_of_birth, citizenship,
        tel_no, tin_no, id_presented,
        mobile_no, id_no, email_address,
        home_address, company_school,
        employer_name, company_address,
        employment_date, position_name,
        basic_salary, annual_income,
        spouse_name,
        loan_type, loan_amount, loan_purpose,
        loan_terms, collateral, interest_rate,primary_card_name,primary_card_number,secondary_card_name,secondary_card_number
    ) VALUES (
        '$last_name', '$first_name', '$middle_name',
        '$date_of_birth', '$civil_status', '$gender',
        '$place_of_birth', '$citizenship',
        '$tel_no', '$tin_no', '$id_presented',
        '$mobile_no', '$id_no', '$email_address',
        '$home_address', '$company_school',
        '$employer_name', '$company_address',
        '$employment_date', '$position_name',
        '$basic_salary', '$annual_income',
        '$spouse_name',
        '$loan_type', '$loan_amount', '$loan_purpose',
        '$loan_terms', '$collateral', '$interest_rate',
        '$primary_card_name','$primary_card_number','$secondary_card_name',
        '$secondary_card_number'
    )";

    $conn->query($sql);
    $loan_id = $conn->insert_id;

} else {

    $conn->query("UPDATE loan_applications SET
        last_name='$last_name',
        first_name='$first_name',
        middle_name='$middle_name',
        date_of_birth='$date_of_birth',
        civil_status='$civil_status',
        gender='$gender',
        place_of_birth='$place_of_birth',
        citizenship='$citizenship',
        tel_no='$tel_no',
        tin_no='$tin_no',
        id_presented='$id_presented',
        mobile_no='$mobile_no',
        id_no='$id_no',
        email_address='$email_address',
        home_address='$home_address',
        company_school='$company_school',
        employer_name='$employer_name',
        company_address='$company_address',
        employment_date='$employment_date',
        position_name='$position_name',
        basic_salary='$basic_salary',
        annual_income='$annual_income',
        spouse_name='$spouse_name',
        loan_type='$loan_type',
        loan_amount='$loan_amount',
        loan_purpose='$loan_purpose',
        loan_terms='$loan_terms',
        collateral='$collateral',
        interest_rate='$interest_rate',
        primary_card_name='$primary_card_name',
        primary_card_number='$primary_card_number',
        secondary_card_name='$secondary_card_name',
        secondary_card_number='$secondary_card_number'
        WHERE id='$id'
    ");

    $loan_id = $id;
}

/* =========================
   CO-MAKER INSERT (SEPARATE TABLE)
========================= */

if (!empty($_POST['cm_name'])) {

    $count = count($_POST['cm_name']);

    for ($i = 0; $i < $count; $i++) {

        $name = $_POST['cm_name'][$i] ?? '';
        $phone = $_POST['cm_phone'][$i] ?? '';
        $address = $_POST['cm_address'][$i] ?? '';

        if ($name == '') continue;

        $conn->query("
            INSERT INTO co_makers (
                loan_application_id,
                name,
                phone,
                address
            ) VALUES (
                '$loan_id',
                '$name',
                '$phone',
                '$address'
            )
        ");
    }
}

header("Location: index.php");
exit;
?>