-- ===================================================================
-- ESYCON Conference Management System Database Schema (MySQL)
-- ===================================================================
-- Create the main database (change name as desired)
CREATE DATABASE IF NOT EXISTS esycon_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE esycon_db;

-- ===================================================================
-- 1. Admin Table
--    Stores admin user credentials for managing the system.
-- ===================================================================
CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  full_name VARCHAR(100),
  email VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ===================================================================
-- 2. Users Table
--    Conference participants / authors registering in the system.
-- ===================================================================
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  middle_name VARCHAR(50),
  last_name VARCHAR(50) NOT NULL,
  affiliation VARCHAR(150),
  email VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ===================================================================
-- 3. Tracks Table
--    Defines conference tracks or topics.
-- ===================================================================
CREATE TABLE IF NOT EXISTS tracks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ===================================================================
-- 4. Papers Table
--    Stores submitted papers.
-- ===================================================================
CREATE TABLE IF NOT EXISTS papers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  abstract TEXT,
  submission_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  status ENUM('submitted', 'under_review', 'accepted', 'rejected') NOT NULL DEFAULT 'submitted',
  -- optionally store a file path/URL if storing uploads:
  file_path VARCHAR(255),
  CONSTRAINT fk_paper_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===================================================================
-- 5. Paper_Tracks Junction Table
--    Many-to-many: a paper can belong to multiple tracks.
-- ===================================================================
CREATE TABLE IF NOT EXISTS paper_tracks (
  paper_id INT NOT NULL,
  track_id INT NOT NULL,
  PRIMARY KEY (paper_id, track_id),
  CONSTRAINT fk_pt_paper
    FOREIGN KEY (paper_id) REFERENCES papers(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_pt_track
    FOREIGN KEY (track_id) REFERENCES tracks(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===================================================================
-- 6. Keywords Table
--    Optionally store multiple keywords per paper.
-- ===================================================================
CREATE TABLE IF NOT EXISTS paper_keywords (
  id INT AUTO_INCREMENT PRIMARY KEY,
  paper_id INT NOT NULL,
  keyword VARCHAR(100) NOT NULL,
  CONSTRAINT fk_kw_paper
    FOREIGN KEY (paper_id) REFERENCES papers(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===================================================================
-- 7. Registrations Table
--    Conference registration for users.
-- ===================================================================
CREATE TABLE IF NOT EXISTS registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  registration_type ENUM('regular', 'student', 'workshop_only', 'virtual') NOT NULL DEFAULT 'regular',
  payment_status ENUM('pending', 'paid', 'cancelled') NOT NULL DEFAULT 'pending',
  amount DECIMAL(10,2) DEFAULT 0.00,
  registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_reg_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===================================================================
-- 8. Travel Grants Table
--    Users apply for travel grants; admin reviews.
-- ===================================================================
CREATE TABLE IF NOT EXISTS travel_grants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  application_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  amount_requested DECIMAL(10,2) NOT NULL,
  justification TEXT,
  status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
  review_notes TEXT,
  reviewed_at DATETIME,
  CONSTRAINT fk_tg_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===================================================================
-- 9. Notifications Table (Optional)
--    To record system notifications/email logs.
-- ===================================================================
CREATE TABLE IF NOT EXISTS notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,            -- nullable if notification for admin or system-wide
  type VARCHAR(50),       -- e.g., 'paper_status', 'registration', 'grant_decision'
  message TEXT NOT NULL,
  is_read BOOLEAN NOT NULL DEFAULT FALSE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_notif_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===================================================================
-- 10. Activity Logs Table (Optional)
--     Audit trail for admin actions.
-- ===================================================================
CREATE TABLE IF NOT EXISTS activity_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_id INT NOT NULL,
  action VARCHAR(100) NOT NULL,
  details TEXT,
  action_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_log_admin
    FOREIGN KEY (admin_id) REFERENCES admin(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===================================================================
-- 11. Help/FAQ Table (Optional)
--     For dynamic help content in “Help” section.
-- ===================================================================
CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  display_order INT DEFAULT 0,
  is_active BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- ===================================================================
-- 12. Sample Data Inserts (Optional)
--    Insert initial admin user or sample tracks.
-- ===================================================================
-- Example: initial admin
INSERT INTO admin (username, password_hash, full_name, email)
VALUES ('admin', '<hashed_password_here>', 'ESYCON Admin', 'admin@esycon.org');

-- Example: sample tracks
INSERT INTO tracks (name, description) VALUES
  ('Artificial Intelligence', 'Papers on AI, ML, data mining, etc.'),
  ('Cybersecurity', 'Security, privacy, cryptography topics'),
  ('Software Engineering', 'SE methodologies, DevOps, testing, etc.'),
  ('Networks & Communications', 'Networking, IoT, telecom topics');

-- ===================================================================
-- End of Schema
-- ===================================================================
