
CREATE DATABASE IF NOT EXISTS indo_lending;
USE indo_lending;

CREATE TABLE loan_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    borrower_name VARCHAR(255),
    date_of_birth DATE,
    civil_status VARCHAR(100),
    gender VARCHAR(50),
    place_of_birth VARCHAR(255),
    citizenship VARCHAR(100),
    tel_no VARCHAR(100),
    tin_no VARCHAR(100),
    id_presented VARCHAR(255),
    mobile_no VARCHAR(100),
    id_no VARCHAR(100),
    email_address VARCHAR(255),
    home_address TEXT,

    company_school VARCHAR(255),
    employer_name VARCHAR(255),
    company_address TEXT,
    employment_date DATE,
    position_name VARCHAR(255),
    basic_salary DECIMAL(12,2),
    annual_income DECIMAL(12,2),

    spouse_name VARCHAR(255),
    co_maker_name VARCHAR(255),

    loan_type VARCHAR(100),
    loan_amount DECIMAL(12,2),
    loan_purpose TEXT,
    loan_terms VARCHAR(100),
    collateral VARCHAR(255),
    interest_rate VARCHAR(100),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
