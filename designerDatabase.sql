drop database if exists designerdatabase;
create database if not exists designerdatabase;
use designerdatabase;

create table users(
	# col_name data_type [key|attribute]
	user_id int unsigned not null auto_increment primary key,
    email varchar(255) NOT NULL,
    company_title varchar(255),
    first_name varchar(255) not null,
    middle_initial varchar(255),
    last_name varchar(255) not null,
    pass varchar(60) not null
);
create table image(
	img_id int unsigned auto_increment primary key,
    file_name nvarchar(255),
    file_type nvarchar(50),
    file_data longblob,
    user_id int unsigned not null,
    date_created datetime default current_timestamp,
    last_updated timestamp,
    foreign key (user_id)
		references users (user_id)
);
create table messages (
	message_id int unsigned not null auto_increment primary key,
    user_id int unsigned not null,
    title varchar(40) not null,
    message varchar(1000) not null,
    date_created datetime default current_timestamp,
    emailmsg bool not null,
    foreign key (user_id)
		references users (user_id)
);
create table msgimg (
	message_id int unsigned not null,
    img_id int unsigned not null,
    primary key (message_id, img_id)
);
select * from users;