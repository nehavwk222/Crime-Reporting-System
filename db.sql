-- Users table (for login/registration)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Reports table (for crime reports)
CREATE TABLE reports (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    crime_type VARCHAR(100) NOT NULL,
    crime_date VARCHAR(10) NOT NULL,
    crime_location VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    suspect_details TEXT,
    victim_name VARCHAR(100) NOT NULL,
    victim_email VARCHAR(100) NOT NULL,
    victim_phone VARCHAR(20) NOT NULL,
    status ENUM('pending', 'in_progress', 'resolved') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Home content table
CREATE TABLE home_content (
    id INT PRIMARY KEY AUTO_INCREMENT,
    welcome_message TEXT NOT NULL,
    description TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- FAQ table
CREATE TABLE faqs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question VARCHAR(255) NOT NULL,
    answer TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact Us table
CREATE TABLE contact_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);