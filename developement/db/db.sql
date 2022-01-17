Create database if not exists cabinet_rafik;

use cabinet_rafik;

create table if not exists Patient
(
    id          int auto_increment,
    firstname   varchar(255),
    lastName    varchar(255),
    email       varchar(255) unique key,
    birthdate   datetime NOT NULL,
    phoneNumber varchar(255),
    sickness    varchar(255),
    primary key (id)
);

create index idx_lastname on Patient (lastName);
create index idx_lastname on Patient (firstname);

create table if not exists Doctor
(
    id       int auto_increment primary key,
    username varchar(255) unique key,
    password varchar(255)
);


create index idx_username on Doctor (username);
