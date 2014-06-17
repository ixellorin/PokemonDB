set Foreign_key_checks=0;

drop table if exists Area;
drop table if exists DBManager;
drop table if exists GymLeader;
drop table if exists Moves;
drop table if exists Pokemon;
drop table if exists PokemonMoves;
drop table if exists StrongAgainst;
drop table if exists Trainer;
drop table if exists Type;
drop table if exists WeakAgainst;
drop table if exists Species;

CREATE TABLE Area
(name VARCHAR(20) NOT NULL PRIMARY KEY,
region VARCHAR(20));

CREATE TABLE Trainer
(trainer_ID integer not null PRIMARY KEY,
TName varCHAR(20),
TGender varCHAR(6),
THometown varCHAR(20) not null,
TWin integer,
TLoss integer,
FOREIGN KEY (THometown) REFERENCES Area(name),
check (trainer_ID >= 0 AND TGender in ('Male', 'Female') AND TWin >=0 AND TLoss >=0));

CREATE TABLE GymLeader
(trainer_ID integer NOT NULL PRIMARY KEY,
gymName VARCHAR(20) NOT NULL,
badge VARCHAR(20) NOT NULL,
FOREIGN KEY (trainer_ID) REFERENCES Trainer(trainer_ID));

CREATE TABLE Type 
(name VARCHAR(20) NOT NULL PRIMARY KEY);

CREATE TABLE Pokemon
(Pokemon_ID integer not null PRIMARY KEY,
PName varchar(20),
PTID integer,
aName VARCHAR(20) not null,
Ptype VARCHAR(20) not null,
PSpecies VARCHAR(20) not null,
FOREIGN KEY (aName) REFERENCES Area(name),
FOREIGN KEY (PTID) REFERENCES Trainer(trainer_ID) ON DELETE SET NULL,
FOREIGN KEY (Ptype) REFERENCES Type(name),
FOREIGN KEY (PSpecies) REFERENCES Species(Species_Name),
check (Pokemon_ID >= 0));

CREATE TABLE Species
(Species_Name VARCHAR(20) not null PRIMARY KEY,
 Species_Num integer not null);

CREATE TABLE Moves
(mName VARCHAR(20) NOT NULL PRIMARY KEY,
moveLimit integer,
tmNum integer,
mType VARCHAR(20) NOT NULL,
FOREIGN KEY (mType) REFERENCES Type(name));

CREATE TABLE PokemonMoves(
pid integer,
mName VARCHAR(20),
PRIMARY KEY(pid, mName),
FOREIGN KEY (pid) REFERENCES Pokemon(Pokemon_ID),
FOREIGN KEY (mName) REFERENCES Moves(mName));

CREATE TABLE WeakAgainst(
attack_type_name VARCHAR(20),
defend_type_name VARCHAR(20),
PRIMARY KEY (attack_type_name, defend_type_name),
FOREIGN KEY (attack_type_name) REFERENCES Type(name),
FOREIGN KEY (defend_type_name) REFERENCES Type(name));
	   
CREATE TABLE StrongAgainst(
attack_type_name VARCHAR(20),
defend_type_name VARCHAR(20),
PRIMARY KEY (attack_type_name, defend_type_name),
FOREIGN KEY (attack_type_name) REFERENCES Type(name),
FOREIGN KEY (defend_type_name) REFERENCES Type(name));

CREATE TABLE DBManager
(trainer_ID integer not null PRIMARY KEY,
db_password VARCHAR(20) NOT NULL,
FOREIGN KEY (trainer_ID) REFERENCES Trainer(trainer_ID) ON DELETE CASCADE);

-- AREA

insert into Area values
('Pallet Town', 'Kanto');

insert into Area values
('Pewter City', 'Kanto');

insert into Area values
('Cerulean City', 'Kanto');

insert into Area values
('Vermilion City', 'Kanto');

insert into Area values
('Celadon City', 'Kanto');

insert into Area values
('Fuchsia City', 'Kanto');

insert into Area values
('Saffron City', 'Kanto');

insert into Area values
('Cinnabar Island', 'Kanto');

insert into Area values
('Viridian City', 'Kanto');


-- POKEMON

insert into Pokemon values
(00000001,'Bulbasaur', 00000003, 'Pallet Town', 'Grass', 'Bulbasaur');

insert into Pokemon values
(00000002,'Ivysaur', null, 'Pallet Town', 'Grass', 'Ivysaur');

insert into Pokemon values
(00000003,'Venusaur', null, 'Pallet Town', 'Grass', 'Venusaur');

insert into Pokemon values
(00000004, 'Charmander', 00000001, 'Pallet Town', 'Fire' ,'Charmander');

insert into Pokemon values
(00000005, 'Charmeleon', null, 'Pallet Town', 'Fire', 'Charmeleon');

insert into Pokemon values
(00000006, 'Charizard', null, 'Pallet Town', 'Fire', 'Charizard');

insert into Pokemon values
(00000007, 'Squirtle', 00000002, 'Pallet Town', 'Water', 'Squirtle');

insert into Pokemon values
(00000008, 'Wartortle', null, 'Pallet Town', 'Water', 'Wartortle');

insert into Pokemon values
(00000009, 'Blastoise', null, 'Pallet Town', 'Water', 'Blastoise');

insert into Pokemon values
(00000094, 'Johnnie', 00000001, 'Pallet Town', 'Grass', 'Bulbasaur');

insert into Pokemon values
(00000095, 'Onix', 00000004, 'Pewter City', 'Rock', 'Onix');


-- SPECIES

insert into Species values
('Bulbasaur', 00000001);

insert into Species values
('Ivysaur', 00000002);

insert into Species values
('Venusaur', 00000003);

-- TRAINERS

insert into Trainer values
(00000001, 'Red', 'Male', 'Pallet Town', 100, 0);

insert into Trainer values
(00000002, 'Blue', 'Male', 'Pallet Town', 99, 1);

insert into Trainer values
(00000003, 'Frigo Oak', 'Male', 'Pallet Town', 0, 0);

insert into Trainer values
(00000004, 'Brock', 'Male', 'Pewter City', 1, 0);

insert into Trainer values
(00000005, 'Misty', 'Female', 'Cerulean City', 1, 0);

insert into Trainer values
(00000006, 'Lt. Surge', 'Male', 'Vermilion City', 1, 0);

insert into Trainer values
(00000007, 'Erika', 'Female', 'Celadon City', 1, 0);

insert into Trainer values
(00000008, 'Koga', 'Male', 'Fuchsia City', 1, 0);

insert into Trainer values
(00000009, 'Sabrina', 'Female', 'Saffron City', 1, 0);

insert into Trainer values
(00000010, 'Blaine', 'Male', 'Cinnabar Island', 1, 0);

insert into Trainer values
(00000011, 'Giovanni', 'Male', 'Viridian City', 1, 0);


-- GYM LEADERS

insert into GymLeader values
(00000004, 'Pewter Gym', 'Boulder Badge');

insert into GymLeader values
(00000005, 'Cerulean Gym', 'Cascade Badge');

insert into GymLeader values
(00000006, 'Vermilion Gym', 'Thunder Badge');

insert into GymLeader values
(00000007, 'Celadon Gym', 'Rainbow Badge');

insert into GymLeader values
(00000008, 'Fuchsia Gym', 'Soul Badge');

insert into GymLeader values
(00000009, 'Saffron Gym', 'Marsh Badge');

insert into GymLeader values
(00000010, 'Cinnabar Gym', 'Volcano Badge');

insert into GymLeader values
(00000011, 'Viridian Gym', 'Earth Badge');


-- TYPES

insert into Type values
('Grass');

insert into Type values
('Fire');

insert into Type values
('Water');

insert into Type values
('Rock');

insert into DBManager values
(00000003, 'oak');

set Foreign_key_checks=1;