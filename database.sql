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

CREATE TABLE empltypes (
	id INT(11) NOT NULL AUTO_INCREMENT,
    employment_type VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO empltypes (employment_type)
VALUES
('Тільки віддалено'),
('Офіс'),
('Офіс/віддалено');

CREATE TABLE vacancies (
	id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    vacancy_descr TEXT NOT NULL,    
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    recruiter_id INT(11),
    english_id INT(11),
    salary INT(5) UNSIGNED,
    category_id INT(11),
    skills VARCHAR(255),
    experience_id INT(11),
    country_id INT(11),
    empl_type_id INT(11),
    vacancy_status VARCHAR(100),
    responses INT(5) UNSIGNED,
    PRIMARY KEY (id),
    FOREIGN KEY (recruiter_id) REFERENCES recruiters (id),
    FOREIGN KEY (english_id) REFERENCES english (id),
    FOREIGN KEY (category_id) REFERENCES categories (id),
    FOREIGN KEY (experience_id) REFERENCES experience (id),
    FOREIGN KEY (country_id) REFERENCES countries (id),
    FOREIGN KEY (empl_type_id) REFERENCES empltypes (id)
);

INSERT INTO vacancies (title, vacancy_descr, recruiter_id, english_id, salary, category_id, skills, experience_id, country_id, empl_type_id, vacancy_status, responses)
VALUES
('Technical Support Engineer', 'On behalf of Cyrebro, SD Solutions is looking for', 7, 2, 750, 7, 'PHP,.NET,SQL,NoSQL,Java,Python', 3, 4, 1, "active", 0),
('Content Marketing Manager', 'We are a fintech startup providing cutting-edge software-as-a-service solutions to', 7, 1, 850, 2, 'PHP,.NET,SQL,NoSQL,Java,Python', 2, 2, 3, "active", 0),
('Solution Architect', 'Requirements: -Technical writing and documentation skills -English B2 -research and', 14, 2, 650, 2, 'PHP,.NET,SQL,GitHub,Java,Python', 2, 2, 2, "active", 0),
('Data Engineer', 'Iterasec works with clients worldwide, helping them find vulnerabilities and secure their products. Our projects range from mobile/web applications', 7, 1, 700, 5, 'PHP,.NET,SQL,GitHub,Java,Python', 1, 4, 2, "active", 0),
('Middle Fullstack Developer', 'Iterasec works with clients worldwide, helping them find vulnerabilities and secure their products.', 14, 2, 250, 1, 'PHP,.NET,SQL,NoSQL,Java,Python', 3, 1, 1, "active", 0),
('Junior UX/UI Designer / UX Researcher', 'Через розширення послуги "Netpeak Consulting" ми шукаємо досвідченого Marketing Manager`a', 14, 1, 150, 7, 'PHP,.NET,SQL,GitHub,Java,Python', 1, 4, 1, "active", 0),
('Trainee QA Engineer', 'Solidgate — це B2B продукт у сфері онлайн-платежів. Ми будуємо фінтех-екосистему', 14, 1, 700, 1, 'PHP,.NET,SQL,GitHub,Java,Python', 3, 1, 2, "active", 0),
('Trainee UI/UX Designer', 'Solidgate — це В2В продукт у сфері онлайн-платежів.', 7, 3, 700, 7, 'PHP,.NET,SQL,NoSQL,Java,Python', 3, 4, 2, "active", 0),
('Data Analyst', 'Become a Data Engineer at United Tech and explore technical development', 7, 3, 650, 3, 'PHP,.NET,SQL,NoSQL,Java,Python', 4, 4, 1, "active", 0),
('Customer Success Specialist', 'About job We are looking for a responsible (meaning: take responsibility for your words)', 14, 2, 850, 4, 'PHP,.NET,SQL,GitHub,Java,Python', 1, 5, 1, "active", 0),
('Senior Full Stack Engineer', 'Усім привіт🖖 Запрошуємо Дніпрян та гостей міста на стажування! Якщо ти хочеш', 7, 3, 850, 7, 'PHP,.NET,SQL,NoSQL,Java,Python', 4, 5, 3, "active", 0);