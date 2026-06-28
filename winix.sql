create table winix(
    name varchar(15),
    hp varchar(20) not null,
    id varchar(30) not null,
    pass varchar(50) not null,
    email varchar(255),
    addr varchar(100),
    addr_detail varchar(100),
    PRIMARY KEY(id)
)engine=innoDB charset=utf8;