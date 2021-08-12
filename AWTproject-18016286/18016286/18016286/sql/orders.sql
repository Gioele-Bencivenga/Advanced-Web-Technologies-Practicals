CREATE TABLE carorder (
    ordernum int(11) AUTO_INCREMENT,
    custname text NOT NULL,
    custphone text NOT NULL,
    custmail text,
    ordereditem text NOT NULL,
    itemprice text NOT NULL,
    PRIMARY KEY(ordernum)
);