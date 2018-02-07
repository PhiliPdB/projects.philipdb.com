CREATE DATABASE IF NOT EXISTS website;
USE website;

DROP TABLE IF EXISTS old_projects_categories;
CREATE TABLE old_projects_categories (
    opc_id INT(11) NOT NULL AUTO_INCREMENT,
    opc_name VARCHAR(255) NOT NULL,
    opc_priority INT(11) NOT NULL, -- Lower is better

    PRIMARY KEY (opc_id)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS old_projects;
CREATE TABLE old_projects (
    old_project_id INT(11) NOT NULL AUTO_INCREMENT,
    old_project_opc_id INT(11) NOT NULL,
    old_project_name VARCHAR(255) NOT NULL,
    old_project_url VARCHAR(255) NOT NULL,

    PRIMARY KEY (old_project_id),
    FOREIGN KEY (old_project_opc_id) REFERENCES old_projects_categories(opc_id) ON DELETE CASCADE
) ENGINE = InnoDB;

DROP TABLE IF EXISTS old_projects_category_links;
CREATE TABLE old_projects_category_links (
    opcl_id INT(11) NOT NULL AUTO_INCREMENT,
    opcl_opc_id INT(11) NOT NULL,
    opcl_name VARCHAR(255) NOT NULL,
    opcl_url VARCHAR(255) NOT NULL,

    PRIMARY KEY (opcl_id),
    FOREIGN KEY (opcl_opc_id) REFERENCES old_projects_categories(opc_id) ON DELETE CASCADE
) ENGINE = InnoDB;
