CREATE TABLE organising_committee (
  person_ID  int not null,
  first_name varchar(20),
  last_name varchar(50),
  primary key (person_ID)
);

CREATE TABLE company (
  company_ID int not  null,
  name varchar(50),
  emails_sent int,
  primary key (company_ID)
);

CREATE TABLE sponsorship_tier (
  tier_ID varchar(20) not  null,
  fee int,
  max_emails int,
  primary key (tier_ID)
);

CREATE TABLE sub_committee (
  sub_committee_ID int not null,
  sub_committee_name varchar(50),
  chair_ID int,
  primary key (sub_committee_ID)
);

CREATE TABLE hotel_room (
  room_number int not null,
  number_of_beds int,
  primary key (room_number)
);

CREATE TABLE attendees (
  attendee_ID int not null,
  first_name varchar(20),
  last_name varchar(50),
  type varchar(20),
  fee int,
  primary key (attendee_ID)
);

CREATE TABLE session (
  session_ID int not null,
  name varchar(50),
  primary key (session_ID)
);

CREATE TABLE participation (
  person_ID int not null,
  sub_committee_ID int not null,
  first_name varchar(20),
  last_name varchar(50),
  sub_committee_name varchar(50),
  primary key (person_ID),
  foreign key (person_ID) references organising_committee (person_ID),
  foreign key (sub_committee_ID) references sub_committee (sub_committee_ID)
);

CREATE TABLE attending (
  attendee_ID int not null,
  person_ID int not null,
  first_name varchar(20),
  last_name varchar(50),
  primary key (attendee_ID),
  foreign key (attendee_ID) references attendees (attendee_ID),
  foreign key (person_ID) references organising_committee (person_ID)
);

CREATE TABLE representing (
  attendee_ID int not null,
  company_ID int not null,
  first_name varchar(20),
  last_name varchar(50),
  company_name varchar(50),
  primary key (attendee_ID),
  foreign key (attendee_ID) references attendees (attendee_ID),
  foreign key (company_ID) references company (company_ID)
);

CREATE TABLE accommodation (
  attendee_ID int not null,
  room_number int not null,
  first_name varchar(20),
  last_name varchar(50),
  primary key (attendee_ID),
  foreign key (attendee_ID) references attendees (attendee_ID),
  foreign key (room_number) references hotel_room (room_number)
);

CREATE TABLE time_slot (
  slot_ID int not null,
  session_ID int not null,
  session_name varchar(20),
  slot_date date,
  start_time time,
  end_time time,
  location varchar(50),
  primary key (slot_ID),
  foreign key (session_ID) references session (session_ID)
);

CREATE TABLE presenting (
  attendee_ID int not null,
  session_ID int not null,
  first_name varchar(20),
  last_name varchar(50),
  primary key (attendee_ID),
  foreign key (attendee_ID) references attendees (attendee_ID),
  foreign key (session_ID) references session (session_ID)
);

CREATE TABLE job_ads (
  job_ID int not null,
  company_ID int not null,
  position varchar(50),
  city varchar(20),
  province varchar(20),
  pay_rate decimal(4,2),
  primary key (job_ID),
  foreign key (company_ID) references company (company_ID)
);

CREATE TABLE sponsorship_level (
  company_ID int not null,	
  tier_ID varchar(20) not  null,
  primary key (company_ID),
  foreign key (tier_ID) references sponsorship_tier (tier_ID)
);

insert into organising_committee values
  (1, 'Erin', 'Battle'),
  (2, 'Braeden', 'Ng'),
  (3, 'Adam', 'Hardy'),
  (4, 'Caelum', 'Kamps'),
  (5, 'Alex', 'Amos');

insert into company values
  (1, 'Amazon', 0),
  (2,'Microsoft',0),
  (3, 'Snapchat',0),
  (4, 'Facebook',0),
  (5, 'Google',0),
  (6,'Instagram',0),
  (7,'Apple',0),
  (8,'Bell',0),
  (9,'Rogers',0),
  (10,'Shopify',0);


insert into sponsorship_tier values
  ('1', 1000, 0),
  ('2', 3000, 3),
  ('3', 5000, 4),
  ('4', 10000, 5);

insert into sub_committee values
  (1, 'Speakers', 1),
  (2, 'Sponsorship', 2),
  (3, 'Logistics',4);

insert into hotel_room values
(101,2),
(102,1),
(103,2),
(104,2),
(105,2),
(106,2),
(107,2),
(108,2);


insert into attendees values
  (1, 'Liam', 'Beckman', 'student', 50),
  (2, 'Jeff', 'Bezos', 'sponsor', 0),
  (3, 'Chris', 'Maltais', 'professional', 100),
  (4, 'Graeme', 'Strathdee', 'student', 50),
  (5, 'Brendan ', 'May', 'professional ', 100),
  (6, 'Rachel', 'Ng', 'sponsor', 0),
  (7, 'Erin', 'Battle', 'student', 50),
  (8, 'Caelum', 'Kamps',  'student', 50),
  (9,'Michael','Bennett','professional ', 100),
  (10,'Sam','Strike','student', 50),
  (11,'John','Doe', 'sponsor', 0),
  (12,'Jimmy','Johnson', 'sponsor', 0),
  (13,'William','Kent', 'student', 50),
  (14,'Thom','Stark','professional', 100),
  (15,'Holden','Chang','student', 50),
  (16,'Sim','Sam','student', 50),
  (17,'Kate','Perry','student', 50),
  (18,'Brian','Sam','student', 50),
  (19,'Kit','Harrington','professional', 100),
  (20,'Tony','Michaels','student', 100);



insert into session values
(1, 'Web development 1'),
(2, 'HTML Programming'),
(3, 'Python Programming'),
(4,'Apple Release Event'),
(5,'Microsoft Demos'),
(6, 'Web development 2'),
(7, 'Dynamic Programming'),
(8,'Advanced Algorithms');


insert into participation values
  (1, 1, 'Erin', 'Battle', 'Speakers'),
  (2, 1, 'Braeden', 'Ng', 'Speakers'),
  (3, 2, 'Adam', 'Hardy', 'Sponsorship'),
  (4, 3, 'Caelum', 'Kamps', 'Logistics'),
  (5, 3, 'Alex', 'Amos', 'Logistics');

insert into attending values
  (7, 1, 'Erin', 'Battle');

insert into representing values
  (2001, 3000, 'Jeff', 'Bezos', 'Amazon');

insert into accommodation values
  (2000, 101, 'Liam', 'Beckman'),
  (2003, 101, 'Graeme ', 'Strathdee'),
  (2006, 102, 'Erin', 'Battle');

insert into time_slot values
  (7000, 6000, 'Web Development', '2019/05/03', '09:00:00', '10:30:00', 'Jeffery Hall Rm 120'),
  (7001, 6001, 'Dynamic Programming', '2019/05/03', '13:00:00', '14:30:00', 'Jeffery Hall Rm 121');

insert into presenting values
  (3, 1, 'Chris ', 'Maltais'),
  (2, 2, 'Jeff ', 'Bezos');
  (12, 3, 'Jimmy ', 'Johnson');
  (11, 4, 'John ', 'Doe');
  (6, 5, 'Rachel ', 'Ng');
  (3, 6, 'Chris ', 'Maltais');
  (2, 7, 'Jeff ', 'Bezos');
  (12, 8, 'Jimmy ', 'John');


insert into job_ads values
  (1, 1, 'Database developer', 'Vancouver', 'BC', 32),
  (2, 2, 'Marketing Intern', 'Toronto', 'ON', 16);

insert into sponsorship_level values
  (1, '3'),
  (2,'1'),
  (3,'2'),
  (4,'4'),
  (5,'1'),
  (6,'2'),
  (7,'2'),
  (8,'1'),
  (9,'3'),
  (10,'4');