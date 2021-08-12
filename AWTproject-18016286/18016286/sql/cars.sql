CREATE TABLE car (
    id int(11) AUTO_INCREMENT NOT NULL,
    model text NOT NULL,
    brand text NOT NULL,
    price int(11) NOT NULL,
    info text NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO
    car (id, model, brand, price, info)
VALUES
    (
        '1',
        'Alpina',
        'BMW',
        '143200',
        'Great car with built-in tires.'
    ),
    (
        '2',
        'I3',
        'BMW',
        '150500',
        'A solid man-moving option.'
    ),
    (
        '3',
        'M5',
        'BMW',
        '122000',
        'A car that makes you forget.'
    ),
    (
        '4',
        'Corolla',
        'Toyota',
        '170300',
        "You won't be able to leave this car."
    ),
    (
        '5',
        'Prius',
        'Toyota',
        '135700',
        'Steering wheel sold separately.'
    ),
    (
        '6',
        'Yaris',
        'Toyota',
        '110600',
        'This car does stuff occasionally.'
    )