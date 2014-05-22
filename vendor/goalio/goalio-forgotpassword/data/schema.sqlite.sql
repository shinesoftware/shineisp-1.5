CREATE TABLE user_password_reset
(
    request_key VARCHAR(32) NOT NULL,
    user_id INT(11) NOT NULL,
    request_time DATETIME NOT NULL,
    PRIMARY KEY(request_key),
    UNIQUE(user_id)
);