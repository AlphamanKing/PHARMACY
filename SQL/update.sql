-- Update four records in customers table
UPDATE customers
SET name = 'John Doe', email = 'johndoe@example.com', phone = '1234567890', address = '123 Main Street'
WHERE customer_id = 1;

UPDATE customers
SET name = 'Jane Smith', email = 'janesmith@example.com', phone = '0987654321', address = '456 High Street'
WHERE customer_id = 2;

UPDATE customers
SET name = 'Alice Cooper', email = 'alicecooper@example.com', phone = '1112223333', address = '789 Low Street'
WHERE customer_id = 3;

UPDATE customers
SET name = 'Bob Marley', email = 'bobmarley@example.com', phone = '4445556666', address = '1011 Park Avenue'
WHERE customer_id = 4;

-- Update four records in doctors table
UPDATE doctors
SET name = 'Dr. House', specialization = 'Diagnostic Medicine'
WHERE doctor_id = 1;

UPDATE doctors
SET name = 'Dr. Watson', specialization = 'General Practitioner'
WHERE doctor_id = 2;

UPDATE doctors
SET name = 'Dr. Strange', specialization = 'Neurosurgeon'
WHERE doctor_id = 3;

UPDATE doctors
SET name = 'Dr. Who', specialization = 'Time Lord'
WHERE doctor_id = 4;

-- Update four records in prescriptions table
UPDATE prescriptions
SET customer_id = 2, doctor_id = 3, prescription_date = '2024-01-28', status = 'filled', notes = 'Take one pill daily'
WHERE prescription_id = 1;

UPDATE prescriptions
SET customer_id = 4, doctor_id = 1, prescription_date = '2024-01-27', status = 'pending', notes = 'Need further tests'
WHERE prescription_id = 2;

UPDATE prescriptions
SET customer_id = 3, doctor_id = 2, prescription_date = '2024-01-26', status = 'cancelled', notes = 'Allergic reaction'
WHERE prescription_id = 3;

UPDATE prescriptions
SET customer_id = 1, doctor_id = 4, prescription_date = '2024-01-25', status = 'filled', notes = 'Do not blink'
WHERE prescription_id = 4;

-- Update four records in reports table
UPDATE reports
SET prescription_id = 4, report_date = '2024-01-28 08:16:40', report_type = 'Blood Test', report_content = 'Normal'
WHERE report_id = 1;

UPDATE reports
SET prescription_id = 3, report_date = '2024-01-27 09:15:30', report_type = 'X-Ray', report_content = 'Fracture'
WHERE report_id = 2;

UPDATE reports
SET prescription_id = 2, report_date = '2024-01-26 10:14:20', report_type = 'MRI', report_content = 'Tumor'
WHERE report_id = 3;

UPDATE reports
SET prescription_id = 1, report_date = '2024-01-25 11:13:10', report_type = 'Urine Test', report_content = 'Infection'
WHERE report_id = 4;

-- Update four records in inventory table
UPDATE inventory
SET product_name = 'Aspirin', manufacturer = 'Bayer', description = 'Painkiller', category = 'Medicine', price = 10.00, quantity = 100, expiry_date = '2024-12-31'
WHERE product_id = 1;

UPDATE inventory
SET product_name = 'Band-Aid', manufacturer = 'Johnson & Johnson', description = 'Adhesive Bandage', category = 'First Aid', price = 5.00, quantity = 200, expiry_date = NULL
WHERE product_id = 2;

UPDATE inventory
SET product_name = 'Cough Syrup', manufacturer = 'Robitussin', description = 'Cough Suppressant', category = 'Medicine', price = 15.00, quantity = 50, expiry_date = '2024-06-30'
WHERE product_id = 3;

UPDATE inventory
SET product_name = 'Dental Floss', manufacturer = 'Oral-B', description = 'Dental Care', category = 'Hygiene', price = 3.00, quantity = 300, expiry_date = NULL
WHERE product_id = 4;

-- Update four records in pharmacy table
UPDATE pharmacy
SET pharmacy_name = 'Happy Pharmacy', location = 'Murang\'a', phone = '0712345678', email = 'happypharmacy@example.com'
WHERE pharmacy_id = 1;

UPDATE pharmacy
SET pharmacy_name = 'Healthy Pharmacy', location = 'Nairobi', phone = '0723456789', email = 'healthypharmacy@example.com'
WHERE pharmacy_id = 2;

UPDATE pharmacy
SET pharmacy_name = 'Hearty Pharmacy', location = 'Mombasa', phone = '0734567890', email = 'heartypharmacy@example.com'
WHERE pharmacy_id = 3;

UPDATE pharmacy
SET pharmacy_name = 'Honest Pharmacy', location = 'Kisumu', phone = '0745678901', email = 'honestpharmacy@example.com'
WHERE pharmacy_id = 4;

-- Update four records in sales table
UPDATE sales
SET product_id = 4, pharmacy_id = 1, customer_id = 1, sale_date = '2024-01-28 08:16:40', quantity = 10, total_amount = 30.00
WHERE sale_id = 1;

UPDATE sales
SET product_id = 3, pharmacy_id = 2, customer_id = 2, sale_date = '2024-01-27 09:15:30', quantity = 5, total_amount = 75.00
WHERE sale_id = 2;

UPDATE sales
SET product_id = 2, pharmacy_id = 3, customer_id = 3, sale_date = '2024-01-26 10:14:20', quantity = 20, total_amount = 100.00
WHERE sale_id = 3;

UPDATE sales
SET product_id = 1, pharmacy_id = 4, customer_id = 4, sale_date = '2024-01-25 11:13:10', quantity = 15, total_amount = 150.00
WHERE sale_id = 4;

-- Update four records in settings table
UPDATE settings
SET setting_name = 'theme', setting_value = 'dark'
WHERE setting_id = 1;

UPDATE settings
SET setting_name = 'language', setting_value = 'English'
WHERE setting_id = 2;

UPDATE settings
SET setting_name = 'currency', setting_value = 'KES'
WHERE setting_id = 3;

UPDATE settings
SET setting_name = 'timezone', setting_value = 'Africa/Nairobi'
WHERE setting_id = 4;

-- Update four records in users table
UPDATE users
SET username = 'admin', password = 'admin123', email = 'admin@example.com', full_name = 'Administrator', role = 'admin'
WHERE user_id = 1;

UPDATE users
SET username = 'pharm1', password = 'pharm123', email = 'pharm1@example.com', full_name = 'Pharmacist One', role = 'pharmacist'
WHERE user_id = 2;

UPDATE users
SET username = 'doc1', password = 'doc123', email = 'doc1@example.com', full_name = 'Doctor One', role = 'doctor'
WHERE user_id = 3;

UPDATE users
SET username = 'cust1', password = 'cust123', email = 'cust1@example.com', full_name = 'Customer One', role = 'customer'
WHERE user_id = 4;

