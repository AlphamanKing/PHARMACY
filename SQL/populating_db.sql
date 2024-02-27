-- Table: customers
INSERT INTO customers (name, email, phone, address) VALUES
('Alice Mwangi', 'alice@gmail.com', '+254 700 123 456', 'P.O. Box 123, Murang\'a'),
('Bob Omondi', 'bob@yahoo.com', '+254 711 234 567', 'P.O. Box 456, Nairobi'),
('Charles Kimani', 'charles@outlook.com', '+254 722 345 678', 'P.O. Box 789, Mombasa'),
('Diana Njeri', 'diana@bing.com', '+254 733 456 789', 'P.O. Box 1011, Kisumu');

-- Table: doctors
INSERT INTO doctors (name, specialization) VALUES
('Dr. Esther Wanjiku', 'Cardiologist'),
('Dr. Francis Kamau', 'Dermatologist'),
('Dr. Grace Wairimu', 'Neurologist'),
('Dr. Henry Karanja', 'Pediatrician');

-- Table: prescriptions
INSERT INTO prescriptions (customer_id, doctor_id, prescription_date, status, notes) VALUES
(1, 3, '2024-01-25', 'pending', 'Patient has severe headache and dizziness'),
(2, 4, '2024-01-26', 'filled', 'Patient has mild fever and cough'),
(3, 1, '2024-01-27', 'cancelled', 'Patient did not show up for appointment'),
(4, 2, '2024-01-28', 'pending', 'Patient has rash and itching');

-- Table: reports
INSERT INTO reports (prescription_id, report_type, report_content) VALUES
(1, 'MRI Scan', 'No signs of brain tumor or stroke'),
(2, 'Blood Test', 'Normal levels of white blood cells and platelets'),
(4, 'Skin Biopsy', 'Positive for contact dermatitis');

-- Table: inventory
INSERT INTO inventory (product_name, manufacturer, description, category, price, quantity, expiry_date) VALUES
('Paracetamol', 'Acme Pharmaceuticals', 'Pain reliever and fever reducer', 'Analgesic', 50.00, 100, '2024-12-31'),
('Ibuprofen', 'Beta Pharmaceuticals', 'Anti-inflammatory and pain reliever', 'NSAID', 100.00, 50, '2024-06-30'),
('Loratadine', 'Gamma Pharmaceuticals', 'Antihistamine for allergy relief', 'Antiallergic', 150.00, 25, '2024-03-31'),
('Cetirizine', 'Delta Pharmaceuticals', 'Antihistamine for allergy relief', 'Antiallergic', 200.00, 20, '2024-02-28');

-- Table: pharmacy
INSERT INTO pharmacy (pharmacy_name, location, phone, email) VALUES
('Alpha Pharmacy', 'Murang\'a Town, Kenyatta Road', '+254 700 111 222', 'alpha@pharmacy.com'),
('Beta Pharmacy', 'Nairobi City, Moi Avenue', '+254 711 222 333', 'beta@pharmacy.com'),
('Gamma Pharmacy', 'Mombasa City, Digo Road', '+254 722 333 444', 'gamma@pharmacy.com'),
('Delta Pharmacy', 'Kisumu City, Oginga Odinga Street', '+254 733 444 555', 'delta@pharmacy.com');

-- Table: sales
INSERT INTO sales (product_id, pharmacy_id, customer_id, quantity, total_amount) VALUES
(1, 1, 2, 2, 100.00),
(2, 2, 3, 1, 100.00),
(3, 3, 4, 3, 450.00),
(4, 4, 1, 4, 800.00);

-- Table: settings
INSERT INTO settings (setting_name, setting_value) VALUES
('tax_rate', '0.16'),
('currency', 'KES'),
('language', 'English'),
('theme', 'Light');

-- Table: users
INSERT INTO users (username, password, email, full_name, role) VALUES
('admin', 'admin123', 'admin@pharmacy.com', 'Admin User', 'admin'),
('pharm1', 'pharm123', 'pharm1@pharmacy.com', 'Pharmacist One', 'pharmacist'),
('doc1', 'doc123', 'doc1@pharmacy.com', 'Doctor One', 'doctor'),
('cust1', 'cust123', 'cust1@pharmacy.com', 'Customer One', 'customer');

