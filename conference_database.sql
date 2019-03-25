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
  (1000, 'Erin', 'Battle'),
  (1001, 'Braeden', 'Ng'),
  (1002, 'Adam', 'Hardy'),
  (1003, 'Caelum', 'Kamps'),
  (1004, 'Alex', 'Amos');

insert into company values
  (3000, 'Amazon', 0);

insert into sponsorship_tier values
  ('7000', 1000, 0),
  ('7001', 3000, 3),
  ('7002', 5000, 4),
  ('7003', 10000, 5);

insert into sub_committee values
  (5000, 'Speakers', 1000),
  (5001, 'Sponsorship', 1004);

insert into hotel_room values
  (101, 2),
  (102, 1);

insert into attendees values
  (2000, 'Liam', 'Beckman', 'student', 50),
  (2001, 'Jeff', 'Bezos', 'sponsor', 0),
  (2002, 'Chris', 'Maltais', 'professional', 100),
  (2003, 'Graeme', 'Strathdee', 'student', 50),
  (2004, 'Brendan ', 'May', 'professional ', 100),
  (2005, 'Rachel', 'Ng', 'sponsor', 0),
  (2006, 'Erin', 'Battle', 'student', 50);

insert into session values
  (6000, 'Web development'),
  (6001, 'Dynamic Programming');

insert into participation values
  (1000, 5000, 'Erin', 'Battle', 'Speakers'),
  (1001, 5000, 'Braeden', 'Ng', 'Speakers'),
  (1002, 5001, 'Adam', 'Hardy', 'Sponsorship'),
  (1003, 5000, 'Caelum', 'Kamps', 'Speakers'),
  (1004, 5001, 'Alex', 'Amos', 'Sponsorship');

insert into attending values
  (2006, 1000, 'Erin', 'Battle');

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
  (2002, 6000, 'Chris ', 'Maltais'),
  (2001, 6001, 'Jeff ', 'Bezos');

insert into job_ads values
  (4000, 3000, 'Database developer', 'Vancouver', 'BC', 32),
  (5000, 3000, 'Marketing Intern', 'Toronto', 'ON', 16);

insert into sponsorship_level values
  (3000, '7002');