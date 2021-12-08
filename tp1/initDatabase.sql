-- Structure
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;

CREATE TABLE posts
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(31) NOT NULL,
    description VARCHAR(255),
    active TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comments
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255),
    post_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE comments ADD CONSTRAINT fk_comments_post_id FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE;

-- data
INSERT INTO posts(id, title, description) VALUES
    (1, "Mon post 1", "La description de mon post 1"),
    (2, "Mon post 2", "La description de mon post 2"),
    (3, "Mon post 3", "La description de mon post 3");

INSERT INTO comments(description, post_id) VALUES
    ("Commentaire 1 post 1", 1),
    ("Commentaire 2 post 1", 1),
    ("Commentaire 3 post 1", 1),
    ("Commentaire 1 post 2", 2),
    ("Commentaire 1 post 3", 3),
    ("Commentaire 2 post 3", 3);
