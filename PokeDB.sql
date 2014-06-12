--Database Table Creation
drop table Creates;
drop table Modifies;
drop table Account;
drop table DBManager;
drop table Trainer;
drop table Pokemon;

CREATE TABLE Pokemon
(Pokemon_ID integer not null PRIMARY KEY,
PName varchar(20),
PPop integer,
check (Pokemon_ID >= 0));

CREATE TABLE TrainedPokemon
(Pokemon_ID integer not null PRIMARY KEY,
PName varchar(20),
PTrainer varCHAR(30) not null,
PTID integer not null,
FOREIGN KEY (trainer_ID) REFERENCES Trainer ON DELETE CASCADE
check (Pokemon_ID >= 0));

CREATE TABLE Trainer
(trainer_ID integer not null PRIMARY KEY,
TName varCHAR(20),
TGender varCHAR(6),
THometown varCHAR(30),
TWin integer,
TLoss integer,
check (trainer_ID >= 0 AND TGender in ('Male', 'Female') AND TWin >=0 AND TLoss >=0));

CREATE TABLE DBManager
(trainer_ID integer not null PRIMARY KEY,
FOREIGN KEY (trainer_ID) REFERENCES Trainer ON DELETE CASCADE);

insert into Pokemon values
(00000001,'Bulbasaur', 1);

insert into Pokemon values
(00000002,'Ivysaur', 1);

insert into Pokemon values
(00000003,'Venusaur', 1);

insert into TrainedPokemon values
(00000001,'Bulbasaur', 'Red', 0000001);

insert into Trainer values
(00000001, 'Red', 'Male', 'Pallet Town', 100, 0);

insert into DBManager values
(00000001);

commit;