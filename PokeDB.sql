set Foreign_key_checks=0;

drop table Area;
drop table DBManager;
drop table GymLeader;
drop table Moves;
drop table Pokemon;
drop table PokemonMoves;
drop table StrongAgainst;
drop table Trainer;
drop table Type;
drop table WeakAgainst;

CREATE TABLE Area
(name VARCHAR(20) NOT NULL PRIMARY KEY,
region VARCHAR(20));

CREATE TABLE Trainer
(trainer_ID integer not null PRIMARY KEY,
TName varCHAR(20),
TGender varCHAR(6),
THometown varCHAR(40),
TWin integer,
TLoss integer,
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
FOREIGN KEY (aName) REFERENCES Area(name),
FOREIGN KEY (PTID) REFERENCES Trainer(trainer_ID) ON DELETE SET NULL,
FOREIGN KEY (Ptype) REFERENCES Type(name),
check (Pokemon_ID >= 0));

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
