set Foreign_key_checks=0;

drop table Creates if exists enrolled cascade;
drop table Modifies if exists enrolled cascade;
drop table Account if exists enrolled cascade;
drop table DBManager if exists enrolled cascade;
drop table Trainer if exists enrolled cascade;
drop table Pokemon if exists enrolled cascade;

CREATE TABLE Pokemon
(Pokemon_ID integer not null PRIMARY KEY,
PName varchar(20),
PPop integer,
check (Pokemon_ID >= 0));

CREATE TABLE Trainer
(trainer_ID integer not null PRIMARY KEY,
TName varCHAR(20),
TGender varCHAR(6),
THometown varCHAR(40),
TWin integer,
TLoss integer,
check (trainer_ID >= 0 AND TGender in ('Male', 'Female') AND TWin >=0 AND TLoss >=0));

CREATE TABLE TrainedPokemon
(Pokemon_ID integer not null PRIMARY KEY,
PName varchar(20),
PTrainer varCHAR(30) not null,
PTID integer not null,
FOREIGN KEY (PTID) REFERENCES Trainer(trainer_ID) ON DELETE CASCADE,
check (Pokemon_ID >= 0));

CREATE TABLE GymLeader
(trainer_ID integer PRIMARY KEY,
gymName VARCHAR(20) NOT NULL,
badge VARCHAR(20) NOT NULL,
FOREIGN KEY (trainer_ID) REFERENCES Trainer(trainer_ID));

CREATE TABLE DBManager
(trainer_ID integer not null PRIMARY KEY,
FOREIGN KEY (trainer_ID) REFERENCES Trainer(trainer_ID) ON DELETE CASCADE);

insert into Pokemon values
(00000001,'Bulbasaur', 1);

insert into Pokemon values
(00000002,'Ivysaur', 1);

insert into Pokemon values
(00000003,'Venusaur', 1);

insert into Pokemon values
(00000004, 'Charmander', 1);

insert into Pokemon values
(00000005, 'Charmeleon', 1);

insert into Pokemon values
(00000006, 'Charizard', 1);

insert into Pokemon values
(00000007, 'Squirtle', 1);

insert into Pokemon values
(00000008, 'Wartortle', 1);

insert into Pokemon values
(00000009, 'Blastoise', 1);

insert into Pokemon values
(00000095, 'Onix', 1);

insert into Trainer values
(00000001, 'Red', 'Male', 'Pallet Town', 100, 0);

insert into Trainer values
(00000002, 'Blue', 'Male', 'Pallet Town', 99, 1);

insert into Trainer values
(00000003, 'Frigo Oak', 'Male', 'Pallet Town', 0, 0);

insert into Trainer values
(00000004, 'Brock', 'Male', 'Pewter City', 1, 0);

insert into TrainedPokemon values
(00000004,'Charmander', 'Red', 00000001);

insert into TrainedPokemon values
(00000007,'Squirtle', 'Blue', 00000002);

insert into TrainedPokemon values
(00000001,'Bulbasaur', 'Frigo Oak', 00000003);

insert into TrainedPokemon values
(00000095,'Onix', 'Brock', 00000004);

insert into GymLeader values
(00000004, 'Pewter Gym', 'Boulder Badge');

insert into DBManager values
(00000003);

set Foreign_key_checks=1;
