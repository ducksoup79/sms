<!DOCTYPE html>
<html>
    <head>
        <title>Setting up database</title>
    </head>

    <body>
        <h3>Setting up....</h3>

        <?php
          require_once 'functions.php';

          createTable('members',                //stores all pilots
                      'user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       user_name VARCHAR(20),
                       user_surname VARCHAR(20),
                       pass VARCHAR(40),
                       user_role VARCHAR(10),
                       e_mail VARCHAR(30),
                       cell VARCHAR(15),
                       lic_number VARCHAR(10)');

          createTable('incident_reports',       //stores all incidents
                      'inc_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      inc_num INT,
                      inc_date DATE,
                      inc_time TIME,
                      duty_time TIME,
                      flight_time TIME,
                      location VARCHAR(4),
                      aircraft_reg VARCHAR(6),
                      aircraft_type VARCHAR(5),
                      departure VARCHAR(10),
                      destination VARCHAR(10),
                      type_flight VARCHAR(15),
                      phase VARCHAR(20),
                      airspeed VARCHAR(6),
                      altitude INT(10),
                      heading INT(3),
                      flight_rules VARCHAR(3),
                      flight_conditions VARCHAR(3),
                      turbulance VARCHAR(10),
                      winds_gusts VARCHAR(10),
                      rain VARCHAR(10),
                      other_info VARCHAR(100),
                      pic VARCHAR(30),
                      training_captain VARCHAR(30),
                      description_mulf_item VARCHAR(100),
                      details_mulf_item VARCHAR(100),
                      event_description TEXT,
                      name VARCHAR(30),
                      lic_number VARCHAR(10),
                      contact_number int(20),
                      e_mail VARCHAR(30),
                      report_date DATETIME,
                      closed_date DATETIME,
                      closed_responsible VARCHAR(10),
                      status VARCHAR(10),
                      feedback VARCHAR(10)');

          createTable('hazard_reports',    //stores all hazard reports
                      'hazreport_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      hazard_num INT(10),
                      haz_date DATE,
                      aircraft_reg VARCHAR(6),
                      aircraft_type VARCHAR(5),
                      departure VARCHAR(10),
                      arrival VARCHAR(10),
                      hazard_detail TEXT,
                      name VARCHAR(20),
                      tel_number INT(10),
                      e_mail VARCHAR(30),
                      lic_number VARCHAR(10),
                      status VARCHAR(1)');

          createTable('hazards',              //stores all hazards
                      'haz_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      risk_ass_id INT(10),
                      category INT(10),
                      description TEXT,
                      likelihood INT(1),
                      severity INT(1),
                      risk INT(2),
                      mitigation TEXT,
                      mitigated_likelihood INT(2),
                      mitigated_severity INT(2),
                      mitigated_risk INT(2),
                      monitor VARCHAR(10),
                      active VARCHAR(10)');

         createTable('risk_assesment',
                     'assm_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                     occurence_num INT(5),
                     root_cause TEXT,
                     defence TEXT,
                     defence_req TEXT,
                     action_taken TEXT');

          createTable('tickets',
                      'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      user_id INT(11),
                      message TEXT,
                      is_active TINYINT,
                      created_at DATETIME,
                      time_spent INT(5)');

          createTable('comments',
                     'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      ticket_id INT(11),
                      user_id INT(11),
                      comment TEXT,
                      created_at datetime');

        createTable('human_factors',
                    '');
        ?>
    </body>
</html>
