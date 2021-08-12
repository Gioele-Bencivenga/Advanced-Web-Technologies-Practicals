CREATE TABLE userer (
    username varchar(100) NOT NULL,
    phonenumber text NOT NULL,
    emailaddress text NOT NULL,
    passphrase text NOT NULL,
    PRIMARY KEY(username)
);

INSERT INTO
    userer (username, phonenumber, emailaddress, passphrase)
VALUES
    (
        'First',
        '1111111111',
        'firstuser@email.com',
        '$2y$10$m9XJODGnE7s/L/2A3HoJ5OhJxs7qmwu2E6yeJhEXAOja54m3iM/cm'
    )