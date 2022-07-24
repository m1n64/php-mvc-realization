CREATE TABLE todo_list (
    id int PRIMARY KEY AUTO_INCREMENT,
    task_name VARCHAR (255) NOT NULL,
    task_text TEXT DEFAULT '',
    is_done INT DEFAULT 0
);