CREATE TABLE candidates (
	id INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    pwd VARCHAR(255) NOT NULL,    
    full_name VARCHAR(100),	
    photo_path VARCHAR(255),
    position VARCHAR(100),   
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    resume_path VARCHAR(255),
    english_id INT(11),
    salary INT(5) UNSIGNED,
    category_id INT(11),
    skills VARCHAR(255),
    experience_id INT(11),
    country_id INT(11),
    user_status VARCHAR(100),
    PRIMARY KEY (id),
    FOREIGN KEY (english_id) REFERENCES english (id),
    FOREIGN KEY (category_id) REFERENCES categories (id),
    FOREIGN KEY (experience_id) REFERENCES experience (id),
    FOREIGN KEY (country_id) REFERENCES countries (id)
);

CREATE TABLE english (
	id INT(11) NOT NULL AUTO_INCREMENT,
    level_lang VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE categories (
	id INT(11) NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE experience (
	id INT(11) NOT NULL AUTO_INCREMENT,
    months INT(3) UNSIGNED NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE countries (
	id INT(11) NOT NULL AUTO_INCREMENT,
    country_name VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE skills (
	id INT(11) NOT NULL AUTO_INCREMENT,
    skill_title VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE recruiters (
	id INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    pwd VARCHAR(255) NOT NULL,    
    full_name VARCHAR(100),	
    my_photo VARCHAR(255),
    position VARCHAR(100),   
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,  
    company_name VARCHAR(100),
    company_photo VARCHAR(100),
    company_descr TEXT,
    country_id INT(11),
    user_status VARCHAR(100),
    PRIMARY KEY (id),    
    FOREIGN KEY (country_id) REFERENCES countries (id)
);

CREATE TABLE contacts (
	id INT(11) NOT NULL AUTO_INCREMENT,        
    full_name VARCHAR(100) NOT NULL,	
    phone VARCHAR(20),
    telegram VARCHAR(255),   
    linkedIn VARCHAR(255),  
    about_me TEXT,
    links VARCHAR(255),
    user_id INT(11) NOT NULL,
    user_type VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO english (level_lang) VALUES ('Intermediate');

INSERT INTO experience (months) VALUES (6);

INSERT INTO countries (countries.country_name)
VALUES
('Germany'),
('Ukraine'),
('Romania'),
('Czech Republic (Czechia)'),
('Hungary'),
('Austria'),
('Moldova'),
('Lithuania'),
('Latvia'),
('Estonia'),
('Poland');

INSERT INTO categories (category_name)
VALUES
('JavaScript / Front-End'),
('Java'),
('C# / .NET'),
('Python'),
('PHP'),
('Node.js'),
('iOS'),
('QA Manual'),
('QA Automation'),
('Design / UI/UX'),
('Project Manager'),
('Product Manager'),
('Security'),
('C / C++ / Embedded'),
('Gamedev / Unity');

INSERT INTO skills (skill_title)
VALUES
('JavaScript'),
('Java'),
('.NET'),
('Python'),
('PHP'),
('Node.js'),
('GitHub'),
('SQL'),
('NoSQL'),
('UI/UX'),
('MVC'),
('Postman'),
('Security'),
('C/C++/Embedded'),
('Unity');