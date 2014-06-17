set Foreign_key_checks=0;

drop table if exists Area;
drop table if exists DBManager;
drop table if exists GymLeader;
drop table if exists Moves;
drop table if exists Pokemon;
drop table if exists PokemonMoves;
drop table if exists Trainer;
drop table if exists Type;
drop table if exists Matchups;
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
FOREIGN KEY (trainer_ID) REFERENCES Trainer(trainer_ID) ON DELETE CASCADE);

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
FOREIGN KEY (PSpecies) REFERENCES Species(Species_Name) ON DELETE CASCADE,
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
FOREIGN KEY (pid) REFERENCES Pokemon(Pokemon_ID) ON DELETE CASCADE,
FOREIGN KEY (mName) REFERENCES Moves(mName));

CREATE TABLE Matchups(
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
(00000006, 'Cio', null, 'Pallet Town', 'Fire', 'Charizard');

insert into Pokemon values
(00000007, 'Squirtle', 00000002, 'Pallet Town', 'Water', 'Squirtle');

insert into Pokemon values
(00000008, 'Wartortle', null, 'Pallet Town', 'Water', 'Wartortle');

insert into Pokemon values
(00000009, 'Blastoise', null, 'Pallet Town', 'Water', 'Blastoise');

insert into Pokemon values
(00000010,'Rattata', NULL, 'Pallet Town', 'Normal', 'Rattata');

insert into Pokemon values
(00000011,'Mankey', NULL, 'Pewter City', 'Fighting', 'Mankey');

insert into Pokemon values
(00000012,'Pidgey', NULL, 'Pallet Town', 'Flying', 'Pidgey');

insert into Pokemon values
(00000013,'Ekans', NULL, 'Cerulean City', 'Poison', 'Ekans');

insert into Pokemon values
(00000014,'Meowth', NULL, 'Pallet Town', 'Ground', 'Meowth');

insert into Pokemon values
(00000015,'Venonat', NULL, 'Viridian City', 'Bug', 'Venonat');

insert into Pokemon values
(00000016,'Gastly', NULL, 'Vermilion City', 'Ghost', 'Gastly');

insert into Pokemon values
(00000017,'Jomar', 00000001, 'Pallet Town', 'Electric', 'Pikachu');

insert into Pokemon values
(00000018,'Leo', NULL, 'Fuchsia City', 'Psychic', 'Abra');

insert into Pokemon values
(00000019,'Jynx', NULL, 'Saffron City', 'Ice', 'Jynx');

insert into Pokemon values
(00000020,'Dragonite', NULL, 'Pallet Town', 'Dragon', 'Dragonite');

insert into Pokemon values
(00000021, 'Johnnie', NULL, 'Pallet Town', 'Grass', 'Bulbasaur');

insert into Pokemon values
(00000022, 'Onix', 00000004, 'Pewter City', 'Rock', 'Onix');


-- SPECIES

insert into Species values
('Bulbasaur', 00000001);

insert into Species values
('Ivysaur', 00000002);

insert into Species values
('Venusaur', 00000003);

insert into Species values
('Rattata', 00000019);

insert into Species values
('Mankey', 00000056);

insert into Species values
('Pidgey', 00000016);

insert into Species values
('Ekans', 00000023);

insert into Species values
('Meowth', 00000052);

insert into Species values
('Venonat', 00000048);

insert into Species values
('Gastly', 00000092);

insert into Species values
('Pikachu', 00000025);

insert into Species values
('Abra', 00000063);

insert into Species values
('Jynx', 00000124);

insert into Species values
('Dragonite', 00000149);

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

insert into Type values
('Normal');

insert into Type values
('Fighting');

insert into Type values
('Flying');

insert into Type values
('Poison');

insert into Type values
('Ground');

insert into Type values
('Bug');

insert into Type values
('Ghost');

insert into Type values
('Electric');

insert into Type values
('Psychic');

insert into Type values
('Ice');

insert into Type values
('Dragon');

-- Moves

insert into Moves values
('Razor Leaf', 5, NULL, 'Grass');

insert into Moves values
('Vine Whip', 10, NULL, 'Grass');

insert into Moves values
('Solar Beam', 5, NULL, 'Grass');

insert into Moves values
('Swords Dance', 15, 03, 'Normal');

insert into Moves values
('Bullet Speed', 10, 09, 'Grass');

insert into Moves values
('Mega Drain', 10, 21, 'Grass');

insert into Moves values
('Ember', 15, NULL, 'Fire');

insert into Moves values
('Fire Fang', 15, NULL, 'Fire');

insert into Moves values
('Flame Burst', 10, NULL, 'Fire');

insert into Moves values
('Sunny Day', 5, 21, 'Fire');

insert into Moves values
('Flamethrower', 5, 35, 'Fire');

insert into Moves values
('Fire Blast', 5, 38, 'Fire');

insert into Moves values
('Bubble', 15, NULL, 'Water');

insert into Moves values
('Water Gun', 15, NULL, 'Water');

insert into Moves values
('Water Pulse', 10, NULL, 'Water');

insert into Moves values
('Brine', 5, 55, 'Water');

insert into Moves values
('Rock Throw', 15, NULL, 'Rock');

insert into Moves values
('Rock Tomb', 15, 39, 'Rock');

insert into Moves values
('Smack Down', 10, 23, 'Rock');

insert into Moves values
('Stone Edge', 5, 71, 'Rock');

insert into Moves values
('Quick Attack', 15, NULL, 'Normal');

insert into Moves values
('Hyper Fang', 15, NULL, 'Normal');

insert into Moves values
('Double Edge', 10, NULL, 'Normal');

insert into Moves values
('Frustration', 5, 21, 'Normal');

insert into Moves values
('Low Kick', 15, NULL, 'Fighting');

insert into Moves values
('Karate Chop', 15, NULL, 'Fighting');

insert into Moves values
('Cross Chop', 10, NULL, 'Fighting');

insert into Moves values
('Brick Break', 5, 31, 'Fighting');

insert into Moves values
('Wing Attack', 15, NULL, 'Flying');

insert into Moves values
('Air Slash', 10, NULL, 'Flying');

insert into Moves values
('Aerial Ace', 5, 40, 'Flying');

insert into Moves values
('Poison Sting', 15, NULL, 'Poison');

insert into Moves values
('Acid', 15, NULL, 'Poison');

insert into Moves values
('Acid Spray', 10, NULL, 'Poison');

insert into Moves values
('Venoshock', 5, 09, 'Poison');

insert into Moves values
('Fake Out', 15, NULL, 'Normal');

insert into Moves values
('Fury Swipes', 10, NULL, 'Normal');

insert into Moves values
('Pay Day', 5, NULL, 'Normal');

insert into Moves values
('Leech Life', 15, NULL, 'Bug');

insert into Moves values
('Signal Beam', 15, NULL, 'Bug');

insert into Moves values
('Poison Fang', 10, NULL, 'Poison');

insert into Moves values
('Lick', 15, NULL, 'Ghost');

insert into Moves values
('Shadow Ball', 15, NULL, 'Ghost');

insert into Moves values
('Hex', 10, NULL, 'Ghost');

insert into Moves values
('Thunder Shock', 15, NULL, 'Electric');

insert into Moves values
('Electro Ball', 15, NULL, 'Electric');

insert into Moves values
('Nuzzle', 15, NULL, 'Electric');

insert into Moves values
('Thunderbolt', 5, 24, 'Electric');

insert into Moves values
('Confusion', 15, NULL, 'Psychic');

insert into Moves values
('Psybeam', 15, NULL, 'Psychic');

insert into Moves values
('Psycho Cut', 15, NULL, 'Psychic');

insert into Moves values
('Psyshock', 5, 03, 'Psychic');

insert into Moves values
('Powder Kiss', 15, NULL, 'Ice');

insert into Moves values
('Ice Punch', 15, NULL, 'Ice');

insert into Moves values
('Heart Stamp', 5, NULL, 'Psychic');

insert into Moves values
('Hurricane', 5, 03, 'Flying');

insert into Moves values
('Twister', 15, NULL, 'Dragon');

insert into Moves values
('Dragon Tail', 15, NULL, 'Dragon');

insert into Moves values
('Dragon Claw', 5, NULL, 'Dragon');

-- PokemonMoves

insert into PokemonMoves values
(00000001, 'Razor Leaf');

insert into PokemonMoves values
(00000001, 'Vine Whip');

insert into PokemonMoves values
(00000001, 'Solar Beam');

insert into PokemonMoves values
(00000001, 'Swords Dance');

insert into PokemonMoves values
(00000002, 'Razor Leaf');

insert into PokemonMoves values
(00000002, 'Vine Whip');

insert into PokemonMoves values
(00000002, 'Solar Beam');

insert into PokemonMoves values
(00000002, 'Bullet Speed');

insert into PokemonMoves values
(00000003, 'Razor Leaf');

insert into PokemonMoves values
(00000003, 'Vine Whip');

insert into PokemonMoves values
(00000003, 'Solar Beam');

insert into PokemonMoves values
(00000003, 'Mega Drain');

insert into PokemonMoves values
(00000004, 'Ember');

insert into PokemonMoves values
(00000004, 'Fire Fang');

insert into PokemonMoves values
(00000004, 'Flame Burst');

insert into PokemonMoves values
(00000004, 'Sunny Day');

insert into PokemonMoves values
(00000005, 'Ember');

insert into PokemonMoves values
(00000005, 'Fire Fang');

insert into PokemonMoves values
(00000005, 'Flame Burst');

insert into PokemonMoves values
(00000005, 'Flamethrower');

insert into PokemonMoves values
(00000006, 'Ember');

insert into PokemonMoves values
(00000006, 'Fire Fang');

insert into PokemonMoves values
(00000006, 'Flame Burst');

insert into PokemonMoves values
(00000006, 'Fire Blast');

insert into PokemonMoves values
(00000007, 'Bubble');

insert into PokemonMoves values
(00000007, 'Water Gun');

insert into PokemonMoves values
(00000007, 'Water Pulse');

insert into PokemonMoves values
(00000007, 'Brine');

insert into PokemonMoves values
(00000008, 'Bubble');

insert into PokemonMoves values
(00000008, 'Water Gun');

insert into PokemonMoves values
(00000008, 'Water Pulse');

insert into PokemonMoves values
(00000008, 'Brine');

insert into PokemonMoves values
(00000009, 'Bubble');

insert into PokemonMoves values
(00000009, 'Water Gun');

insert into PokemonMoves values
(00000009, 'Water Pulse');

insert into PokemonMoves values
(00000009, 'Brine');

insert into PokemonMoves values
(00000010, 'Quick Attack');

insert into PokemonMoves values
(00000010, 'Hyper Fang');

insert into PokemonMoves values
(00000010, 'Double Edge');

insert into PokemonMoves values
(00000010, 'Frustration');

insert into PokemonMoves values
(00000011, 'Low Kick');

insert into PokemonMoves values
(00000011, 'Karate Chop');

insert into PokemonMoves values
(00000011, 'Cross Chop');

insert into PokemonMoves values
(00000011, 'Brick Break');

insert into PokemonMoves values
(00000012, 'Quick Attack');

insert into PokemonMoves values
(00000012, 'Wing Attack');

insert into PokemonMoves values
(00000012, 'Air Slash');

insert into PokemonMoves values
(00000012, 'Aerial Ace');

insert into PokemonMoves values
(00000013, 'Poison Sting');

insert into PokemonMoves values
(00000013, 'Acid');

insert into PokemonMoves values
(00000013, 'Acid Spray');

insert into PokemonMoves values
(00000013, 'Venoshock');

insert into PokemonMoves values
(00000014, 'Fake Out');

insert into PokemonMoves values
(00000014, 'Fury Swipes');

insert into PokemonMoves values
(00000014, 'Pay Day');

insert into PokemonMoves values
(00000014, 'Frustration');

insert into PokemonMoves values
(00000015, 'Leech Life');

insert into PokemonMoves values
(00000015, 'Signal Beam');

insert into PokemonMoves values
(00000015, 'Poison Fang');

insert into PokemonMoves values
(00000015, 'Venoshock');

insert into PokemonMoves values
(00000016, 'Lick');

insert into PokemonMoves values
(00000016, 'Shadow Ball');

insert into PokemonMoves values
(00000016, 'Hex');

insert into PokemonMoves values
(00000016, 'Venoshock');

insert into PokemonMoves values
(00000017, 'Thunder Shock');

insert into PokemonMoves values
(00000017, 'Electro Ball');

insert into PokemonMoves values
(00000017, 'Nuzzle');

insert into PokemonMoves values
(00000017, 'Thunderbolt');

insert into PokemonMoves values
(00000018, 'Confusion');

insert into PokemonMoves values
(00000018, 'Psybeam');

insert into PokemonMoves values
(00000018, 'Psycho Cut');

insert into PokemonMoves values
(00000018, 'Psyshock');

insert into PokemonMoves values
(00000019, 'Powder Snow');

insert into PokemonMoves values
(00000019, 'Ice Punch');

insert into PokemonMoves values
(00000019, 'Heart Stamp');

insert into PokemonMoves values
(00000019, 'Psyshock');

insert into PokemonMoves values
(00000020, 'Hurricane');

insert into PokemonMoves values
(00000020, 'Twister');

insert into PokemonMoves values
(00000020, 'Dragon Tail');

insert into PokemonMoves values
(00000020, 'Dragon Claw');

insert into PokemonMoves values
(00000021, 'Razor Leaf');

insert into PokemonMoves values
(00000021, 'Vine Whip');

insert into PokemonMoves values
(00000021, 'Solar Beam');

insert into PokemonMoves values
(00000021, 'Swords Dance');

insert into PokemonMoves values
(00000022, 'Rock Throw');

insert into PokemonMoves values
(00000022, 'Rock Tomb');

insert into PokemonMoves values
(00000022, 'Smack Down');

insert into PokemonMoves values
(00000022, 'Stone Edge');

-- DBManager

insert into DBManager values
(00000003, 'oak');


-- WEAK against

insert into Matchups values
('Fighting (S)', 'Normal (W)');

insert into Matchups values
('Normal (W)', 'Rock (S)');

insert into Matchups values
('Normal (W)', 'Ghost (S)');

insert into Matchups values
('Fighting (W)', 'Flying (S)');

insert into Matchups values
('Fighting (W)', 'Poison (S)');

insert into Matchups values
('Fighting (W)', 'Bug (S)');

insert into Matchups values
('Fighting (W)', 'Ghost (S)');

insert into Matchups values
('Fighting (W)', 'Psychic (S)');

insert into Matchups values
('Flying (S)','Fighting (W)');

insert into Matchups values
('Flying (W)', 'Rock (S)');

insert into Matchups values
('Flying (W)', 'Electric (S)');

insert into Matchups values
('Poison (W)', 'Poison (S)');

insert into Matchups values
('Poison (W)', 'Ground (S)');

insert into Matchups values
('Poison (W)', 'Rock (S)');

insert into Matchups values
('Poison (W)', 'Ghost (S)');

insert into Matchups values
('Ground (W)', 'Flying (S)');

insert into Matchups values
('Ground (W)', 'Bug (S)');

insert into Matchups values
('Ground (W)', 'Grass (S)');

insert into Matchups values
('Rock (W)', 'Fighting (S)');

insert into Matchups values
('Rock (W)', 'Ground (S)');

insert into Matchups values
('Bug (W)', 'Fighting (S)');

insert into Matchups values
('Bug (W)', 'Flying (S)');

insert into Matchups values
('Bug (W)', 'Ghost (S)');

insert into Matchups values
('Bug (W)', 'Fire (S)');

insert into Matchups values
('Ghost (W)', 'Normal (S)');

insert into Matchups values
('Ghost (W)', 'Psychic (S)');

insert into Matchups values
('Fire (W)', 'Rock (S)');

insert into Matchups values
('Fire (W)', 'Fire (S)');

insert into Matchups values
('Fire (W)', 'Water (S)');

insert into Matchups values
('Fire (W)', 'Dragon (S)');

insert into Matchups values
('Water (W)', 'Water (S)');

insert into Matchups values
('Water (W)', 'Grass (S)');

insert into Matchups values
('Water (W)', 'Dragon (S)');

insert into Matchups values
('Grass (W)', 'Flying (S)');

insert into Matchups values
('Grass (W)', 'Bug (S)');

insert into Matchups values
('Grass (W)', 'Fire (S)');

insert into Matchups values
('Grass (W)', 'Grass (S)');

insert into Matchups values
('Grass (W)', 'Dragon (S)');

insert into Matchups values
('Psychic (W)', 'Psychic (S)');

insert into Matchups values
('Ice (W)', 'Water (S)');

insert into Matchups values
('Ice (W)', 'Ice (S)');

insert into Matchups values
('Psychic (S)','Fighting (W)');

insert into Matchups values
('Rock (S)','Flying (W)');

insert into Matchups values
('Electric (S)','Flying (W)');

insert into Matchups values
('Ice (S)', 'Flying (W)');

insert into Matchups values
('Ground (S)', 'Poison (W)');

insert into Matchups values
('Bug (S)', 'Poison (W)');

insert into Matchups values
('Psychic (S)', 'Poison (W)');

insert into Matchups values
('Water (S)', 'Ground (W)');

insert into Matchups values
('Grass (S)', 'Ground (W)');

insert into Matchups values
('Ice (S)', 'Ground (W)');

insert into Matchups values
('Fighting (S)', 'Rock (W)');

insert into Matchups values
('Ground (S)', 'Rock (W)');

insert into Matchups values
('Water (S)', 'Rock (W)');

insert into Matchups values
('Grass (S)', 'Rock (W)');

insert into Matchups values
('Flying (S)', 'Bug (W)');

insert into Matchups values
('Poison (S)', 'Bug (W)');

insert into Matchups values
('Rock (S)', 'Bug (W)');

insert into Matchups values
('Fire (S)', 'Bug (W)');

insert into Matchups values
('Ghost (S)', 'Ghost (W)');

insert into Matchups values
('Ground (S)', 'Fire (W)');

insert into Matchups values
('Rock (S)', 'Fire (W)');

insert into Matchups values
('Water (S)', 'Fire (W)');

insert into Matchups values
('Grass (S)', 'Water (W)');

insert into Matchups values
('Electric (S)', 'Water (W)');

insert into Matchups values
('Flying (S)', 'Grass (W)');

insert into Matchups values
('Poison (S)', 'Grass (W)');

insert into Matchups values
('Bug (S)', 'Grass (W)');

insert into Matchups values
('Fire (S)', 'Grass (W)');

insert into Matchups values
('Ice (S)', 'Grass (W)');

insert into Matchups values
('Ground (S)','Electric (W)');

insert into Matchups values
('Bug (S)', 'Psychic (W)');

insert into Matchups values
('Fighting (S)', 'Ice (W)');

insert into Matchups values
('Rock (S)', 'Ice (W)');

insert into Matchups values
('Fire (S)', 'Ice (W)');

insert into Matchups values
('Ice (S)', 'Dragon (W)');

insert into Matchups values
('Dragon (S)', 'Dragon (W)');

-- ----------------------------------------------------------------------------

set Foreign_key_checks=1;