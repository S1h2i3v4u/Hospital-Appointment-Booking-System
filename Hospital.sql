-- Create Database
CREATE DATABASE IF NOT EXISTS medical;
USE medical;

-- =====================
-- Users Table
-- =====================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    city VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    date_of_registration DATE NOT NULL
);

-- =====================
-- Appointments Table
-- =====================
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_name VARCHAR(150) NOT NULL,
    time_slot VARCHAR(50) NOT NULL,
    patient_name VARCHAR(150) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    booking_time DATETIME NOT NULL,
    status VARCHAR(50) DEFAULT 'pending'
);

-- =====================
-- Queue Tracking Table
-- =====================
CREATE TABLE IF NOT EXISTS queue_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appointment_id INT NOT NULL,
    doctor_name VARCHAR(150) NOT NULL,
    date DATE NOT NULL,
    time_slot VARCHAR(50) NOT NULL,
    queue_position INT NOT NULL,
    estimated_wait_time INT NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE
);
