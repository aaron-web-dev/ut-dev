# Summary

The two modules here are a base-level representation of workflows.

The 'publish' module provides an example of capturing user input. The 'review' modules provides an example of manipulating stored data.

Missing from this model is interaction with a database, which is instead discussed below.

# Previewing the modules

The modules can be displayed from a server with php. The .php files in the publish/ and review/ directories \(rather than the nested directories\) will render to a web browser

# The missing database interaction

Wthout access to a database, the modules can best be understood as a proof of concept for the necessary interactions.

The remainder of this file describes the necessary database tables, and provides examples of MySQL scripts that would allow for interactions

## Database tables
Table descriptions here show only the relevant fields. Most tables, especially those that already exist in the system, likely contain additional fields.

### Table 1 - user

| Field     | Type                                           | Description                           |
|-----------|------------------------------------------------|---------------------------------------|
| user-id   | int NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT | auto-generated user identifier        |
| username  | string NOT NULL                                | username for public display           |
| user-role | string                                         | assigned to control access/privileges |

### Table 2 - project
| Field           | Type                                                | Description                                                       |
|-----------------|-----------------------------------------------------|-------------------------------------------------------------------|
| project-id      | int NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT      | auto-generated identifier                                         |
| project-name    | string NOT NULL                                     | user-assigned project name                                        |
| author          | int NOT NULL FOREIGN KEY REFERENCES user\(user-id\) | the author who submitted the project                              |
| date-created    | int                                                 | generated from code, unix timestamp                               |
| date-updated    | int                                                 | generated from code, unix timestamp, the most recent update date  |
| last-updated-by | int FOREIGN KEY REFERENCES user\(user-id\)          | captured only on updates to project                               |
| status          | string                                              | value from controlled vocabulary                                  |

### Table 3 - files
| Field     | Type                                                      | Description                         |
|-----------|-----------------------------------------------------------|-------------------------------------|
| file-id   | int NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT            | auto-generated identifier           |
| file-name | string NOT NULL                                           | stripped from file upload           |
| file-type | string NOT NULL                                           | stripped from file upload           |
| project   | int NOT NULL FOREIGN KEY REFERENCES project\(project-id\) | the associated project              |
| file-path | string NOT NULL                                           | relative path to file on filesystem |

## Example scripts
Statements in brackets are placeholders for data that will be pulled from form submissions or generated from the code

### A new project is created

INSERT INTO project \(project-name, author, date-created, status\)
VALUES \(\[project-name\], \[author\], \[date\], open\)

INSERT INTO files \(file-name, file-type, project, file-path\)
VALUES \(\[file-name\], \[file-type\], \[project\], \[file-path\]\)

### A project is updated by a reviewer
UPDATE project
SET \(date-updated = \[date\], last-updated-by = \[user-id\], status = \[status\]\)
WHERE project-id = \[project-id\]

\(An insert script for files may also be necessary\)

### A user logs in to see their projects
\(Code will select more columns than will be displayed to user\)
SELECT *
FROM project
WHERE author = \[user-id\]
