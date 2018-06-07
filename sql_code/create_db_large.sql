/*use collinolDB;

drop table if exists GameTypes;
drop table if exists contained;
drop table if exists played_in;
drop table if exists played;
drop table if exists Rounds;
drop table if exists Nations;
drop table if exists PlayerRating;
drop table if exists PlaysAgainstIn;
drop table if exists isRatedIn;
drop table if exists Season;
drop table if exists Player;
drop table if exists Games;
drop table if exists Matches;
drop table if exists TournamentOccurrence;
drop table if exists Tournaments;
*/

CREATE TABLE `GameTypes` (
  `game_type_id` VARCHAR(255),
  `name` VARCHAR(255),
  `notation` VARCHAR(255) ,
  PRIMARY KEY (`game_type_id`));

CREATE TABLE `Nations` (
	nation_id INT NOT NULL auto_increment,
    name_abbrev VARCHAR(45),
    population double, #in millions
    primary key (nation_id)
);

CREATE TABLE `Tournaments` (
	tournament_id INT NOT NULL,
    name varchar(255),
    primary key (tournament_id)
);

CREATE TABLE `TournamentOccurrence`(
	dateOf int ,
    numberOfPlayers int,
    tournament_id int,
    primary key (dateOf,tournament_id),
	foreign key(tournament_id) references Tournaments(tournament_id)
);
CREATE TABLE `Matches`(
	match_id VARCHAR(255) primary key, #noted as Roundnumber-Matchnumber-tournament_id-yearOf(last two digits)
    tournament_id int,
    dateOf int,
    matchNumber int,
    foreign key (tournament_id) references Tournaments(tournament_id),
    foreign key (dateOf) references TournamentOccurrence(dateOf)
    
);

CREATE TABLE `Games` (
	game_number int,
    white_player_id INT NOT NULL,
    black_player_id INT NOT NULL,
	winner_id INT NOT NULL,
    game_type varchar(255) NOT NULL,
    match_id VARCHAR(255),
    tournament_id int,
    dateOf int,
    primary key (game_number,match_id),
    foreign key (match_id) references Matches(match_id)
);

CREATE TABLE `Player` (
	player_id INT NOT NULL auto_increment,
    name varchar(255),
    nation_id int,
    primary key (player_id)
);


CREATE TABLE `PlaysAgainstIn` (
	player1_id INT NOT NULL,
    player2_id INT NOT NULL,
    match_id VARCHAR(255) NOT NULL references Matches(match_id),
    numberOfGames int,
    winner_id int
);



CREATE TABLE `Season`(
	year int primary key,
    numberOfTournaments int
);

CREATE TABLE `isRatedIn`(
	year int ,
    player_id int ,
	foreign key (year) references Season(year),
    foreign key (player_id) references Player(player_id),
    rating int
);




