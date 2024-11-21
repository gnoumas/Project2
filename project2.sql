
create table Members (
member_id INT AUTO_INCREMENT PRIMARY key,
first_name varchar(50),
last_name varchar(50),
email varchar(100),
phone_number varchar(15),
membership_type varchar (50),
start_date date,
end_date date,
password varchar (255),
created_at Timestamp default current_timestamp 
);

create table Classes (
class_id INT AUTO_INCREMENT PRIMARY KEY,
class_name varchar (100),
instructor varchar (50),
schedule_time DateTime,
capacity INT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Create table Bookings (
booking_ID INT AUTO_INCREMENT PRIMARY KEY,
member_id int,
class_id int,
booking_date date,
FOREIGN KEY (member_id) REFERENCES Members(member_id) ON DELETE CASCADE,
FOREIGN KEY (class_id) REFERENCES Classes(class_id) ON DELETE CASCADE,
created_at timestamp default current_timestamp
);
create table Payments (
payment_id int AUTO_INCREMENT PRIMARY KEY,
member_id INT,
payment_date date,
amount DECIMAL(10,2),
payment_method varchar (50),
FOREIGN KEY (member_id) REFERENCES Members(member_id) ON DELETE CASCADE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table Users (
User_id INT AUTO_INCREMENT PRIMARY KEY,
username varchar (50) unique,
password varchar(255),
member_ID INT,
FOREIGN KEY (member_id) REFERENCES Members(member_id) ON DELETE CASCADE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //

CREATE TRIGGER check_class_capacity
BEFORE INSERT ON Bookings
FOR EACH ROW
BEGIN
    -- Declare all variables at the top
    DECLARE class_count INT;
    DECLARE class_capacity INT;
    
    -- Count current bookings for the class
    SELECT COUNT(*) INTO class_count FROM Bookings WHERE class_id = NEW.class_id;
    
    -- Get the capacity of the class
    SELECT capacity INTO class_capacity FROM Classes WHERE class_id = NEW.class_id;
    
    -- Check if the class is full
    IF class_count >= class_capacity THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class is full!';
    END IF;
END //

DELIMITER ;

-- Add a member
INSERT INTO Members (first_name, last_name, email, phone_number, membership_type, start_date, end_date, password)
VALUES ('Fatima', 'Saxon', 'fatima.saxon@gmail.com', '123-456-7890', 'Gold', '2024-01-01', '2024-12-31', MD5('securepassword', 256));

-- Add a class
INSERT INTO Classes (class_name, instructor, schedule_time, capacity)
VALUES ('Pilates', 'Alicia', '2024-11-15 10:00:00', 20);

-- Book a class for a member
INSERT INTO Bookings (member_id, class_id, booking_date)
VALUES (1, 1, '2024-11-13');


SELECT * FROM Members;



