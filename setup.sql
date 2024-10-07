CREATE DATABASE daycare;

USE daycare;

CREATE TABLE IF NOT EXISTS registrationsform (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(20),
    child_name VARCHAR(255),
    child_age INT,
    event VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS limits_event (
    event_name VARCHAR(255) PRIMARY KEY,
    max_limit INT DEFAULT 5,
    current_registrations INT DEFAULT 0
);

INSERT INTO limits_event (event_name, max_limit, current_registrations) VALUES
('Music and Movement Class', 5, 0),
('Sensory Play Workshop', 5, 0),
('Parent-Baby Bonding Session', 5, 0);

DELIMITER //

CREATE TRIGGER after_registration_delete
AFTER DELETE ON registrationsform
FOR EACH ROW
BEGIN
    UPDATE limits_event
    SET current_registrations = current_registrations - 1
    WHERE event_name = OLD.event;
END; //

DELIMITER ;
