
# Valley View Daycare Website

## Overview
The **Valley View Daycare Website** provides parents with detailed information about daycare programs, event registration, and downloadable resources. This project emphasizes accessibility, responsive design, and user-friendliness to support parents in managing daycare interactions easily.

## Key Features
- **Program Information**: Details on daycare programs (Infants, Toddlers, Preschool, After-School).
- **Event Registration**: Special event registration for programs.
- **Downloadable Forms**: Easily accessible forms for enrollment and other resources.
- **Responsive Design**: Optimized for desktop, tablet, and mobile screens.
- **Accessibility**: Designed with WCAG guidelines for enhanced accessibility.

## Technology Stack
- **Frontend**: HTML5, CSS3 (including Bootstrap), JavaScript for interactivity and form validation.
- **Backend**: PHP for form submissions and database interactions.
- **Database**: MySQL tables for managing event registrations and tracking capacity limits.

## Installation and Setup

### Prerequisites
- A code editor, e.g., Visual Studio Code.
- A local server, e.g., XAMPP or WAMP for running PHP files.

### Local Setup
1. **Download the Repository from GitHub**:
    - Go to the repository on GitHub: Valley View Daycare Repository.
    - Click on the green **Code** button.
    - Select **Download ZIP**.
    - Extract the downloaded ZIP file to your desired location.

2. **Navigate to the Project Directory**:
    - Open the folder where you extracted the files (the `vvdc` folder).

3. **Open the Website in Your Browser**:
    - Locate the `index.html` file in the `vvdc` folder and double-click to open in your browser.

4. **Setting Up PHP (for event form functionality)**:
    - Install XAMPP or WAMP.
    - Place the `vvdc` folder in the `htdocs` directory (for XAMPP) or equivalent folder in WAMP.
    - Start the local server using Apache.

5. **Setup Database**:
    - Launch MySQL in XAMPP/WAMP.
    - Run the following SQL commands to create the database and tables:

    ```sql
    CREATE DATABASE daycare;
    USE daycare;

    CREATE TABLE registrationsform (
        id INT AUTO_INCREMENT PRIMARY KEY,
        parent_name VARCHAR(255),
        email VARCHAR(255),
        phone VARCHAR(20),
        child_name VARCHAR(255),
        child_age INT,
        event VARCHAR(255)
    );

    CREATE TABLE limits_event (
        event_name VARCHAR(255) PRIMARY KEY,
        max_limit INT DEFAULT 5,
        current_registrations INT DEFAULT 0
    );
    ```

    - Insert events data:

    ```sql
    INSERT INTO limits_event (event_name, max_limit, current_registrations) VALUES
    ('Sensory Play Day', 5, 0),
    ('Baby Music & Movement', 5, 0),
    ('Storytime & Tummy Time', 5, 0),
    ('Messy Art Day', 5, 0),
    ('Nature Walk & Discovery', 5, 0);
    ```

    - **Create Trigger** to manage registrations:

    ```sql
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
    ```

6. **Using Visual Studio Code**:
    - Open the project folder (`vvdc`) in Visual Studio Code.
    - Optionally, install the **Live Server** extension to view changes in real-time.

## Code Structure
- Organized with separate folders for HTML, CSS, PHP, images, and PDFs.

## Known Issues
- Form validation improvements needed for error messages.
- Some mobile layout elements need adjustments.

## Future Enhancements
1. **Improved Mobile Responsiveness**
2. **Enhanced Accessibility**

## Testing and Debugging
1. **Cross-Browser Compatibility**: Tested on Chrome, Firefox, Safari, and Edge.
2. **Responsive Testing**: Ensured compatibility with desktop, tablet, and mobile views.
3. **Usability Testing**: Users provided feedback on usability.

## Learning Outcomes
The usability testing approach allowed insights into user experience, and feedback was used for improvements in accessibility and mobile compatibility.
### Deepen My Understanding of User Experience: 
By observing real users interact with the website, I will learn to identify usability challenges and frustrations that parents may face.
### Gain Practical Experience: 
Designing user tests and scripts will enhance my skills in evaluating user interactions effectively.
### Apply Feedback for Improvement: 
The insights gathered will help me make data-driven decisions to enhance the website's usability and accessibility, ultimately leading to a better user experience.

