create database discordServers;

create
or
replace table `faq`
(
    faqId int (20) auto_increment
    primary key,
    Question varchar (999) not null,
    Answer varchar (999) not null
);

create
or
replace table `language`
(
    languageId int auto_increment
    primary key,
    language varchar (100) not null
);

create
or
replace table `partners`
(
    partnerId int (99) auto_increment
    primary key,
    title varchar (999) not null,
    description varchar (999) not null,
    link varchar (999) null
);

create
or
replace table `rules`
(
    idRules int (20) auto_increment
    primary key,
    Description varchar (999) not null,
    important tinyint (1) default 1 not null
);

create
or
replace table `servers`
(
    idServer int auto_increment
    primary key,
    serverName longtext not null,
    type varchar (200) not null,
    language varchar (200) not null,
    description varchar (600) not null,
    UserId int not null,
    invite_link varchar (300) not null,
    confirmed int (1) default 0 not null,
    votes int not null
);

create
or
replace table `types`
(
    typesId int auto_increment
    primary key,
    type varchar (100) not null
);

create
or
replace table `users`
(
    idUsers int auto_increment
    primary key,
    uidUsers tinytext not null,
    emailUsers tinytext not null,
    pwdUsers longtext not null,
    role varchar (100) default 'USER' not null,
    blocked tinyint (1) default 0 null
);

create
or
replace table `votestime`
(
    timeId int auto_increment
    primary key,
    ipAddress bigint not null,
    times datetime not null
);


