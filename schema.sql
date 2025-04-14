-- Database schema for Vehicle Assistance application

CREATE DATABASE vehicle_assistance;

USE vehicle_assistance;

CREATE TABLE service_providers (
    
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    license VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE,
    location VARCHAR(255) NOT NULL,
    bank_account VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    service_provided VARCHAR(255) NOT NULL
);

CREATE TABLE service_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service VARCHAR(255) NOT NULL,
    customer_location VARCHAR(255) NOT NULL,
    provider_id INT,
    FOREIGN KEY (provider_id) REFERENCES service_providers(id)

CREATE TABLE service_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service VARCHAR(255) NOT NULL,
    customer_location VARCHAR(255) NOT NULL,
    customer_id INT NOT NULL,
    provider_id INT DEFAULT NULL,
    status ENUM('Pending', 'Accepted', 'Rejected') DEFAULT 'Pending',
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (provider_id) REFERENCES service_providers(id)
);
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10, 2) NOT NULL,
    provider_id INT,
    customer_id INT,
    FOREIGN KEY (provider_id) REFERENCES service_providers(id)
);
-- Table for storing email subscriptions
CREATE TABLE email_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing registered users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);