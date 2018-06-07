/*use collinolDB;


delete from Games;
delete from GameTypes;
delete from isRatedIn;
delete from Matches;
delete from Nations;
delete from Player;
delete from PlaysAgainstIn;
delete from Season;
delete from TournamentOccurrence;
delete from Tournaments;
*/


LOAD DATA
    LOCAL INFILE "data/Player.txt"
    REPLACE INTO TABLE Player
    FIELDS TERMINATED BY ','
    (player_id, name, nation_id);
   
LOAD DATA
    LOCAL INFILE "data/NationFile.txt"
    REPLACE INTO TABLE Nations
    FIELDS TERMINATED BY ','
    (nation_id, name_abbrev,population);

 
LOAD DATA
    LOCAL INFILE "data/GameTypes.txt"
    REPLACE INTO TABLE GameTypes
    FIELDS TERMINATED BY '|'
    (game_type_id,name,notation);
   
   
LOAD DATA
    LOCAL INFILE "data/Tournaments.txt"
    REPLACE INTO TABLE Tournaments
    FIELDS TERMINATED BY ','
    (tournament_id,name);

LOAD DATA
    LOCAL INFILE "data/TournamentOccurrence.txt"
    REPLACE INTO TABLE TournamentOccurrence
    FIELDS TERMINATED BY ','
    (dateOf,numberOfPlayers,tournament_id);


LOAD DATA
    LOCAL INFILE "data/Matches.txt"
    REPLACE INTO TABLE Matches
    FIELDS TERMINATED BY ','
    (match_id,tournament_id,dateOf,matchNumber);
    


LOAD DATA
    LOCAL INFILE "data/PlaysAgainstIn.txt"
    REPLACE INTO TABLE PlaysAgainstIn
    FIELDS TERMINATED BY ','
    (player1_id,player2_id,match_id,numberOfGames,winner_id);
    
    
LOAD DATA
    LOCAL INFILE "data/Season.txt"
    REPLACE INTO TABLE Season
    FIELDS TERMINATED BY ','
    (year,numberOfTournaments);

LOAD DATA
    LOCAL INFILE "data/isRatedIn.txt"
    REPLACE INTO TABLE isRatedIn
    FIELDS TERMINATED BY ','
    (year,player_id,rating);

LOAD DATA
    LOCAL INFILE "data/Games.txt"
    REPLACE INTO TABLE Games
    FIELDS TERMINATED BY ','
    (game_number,white_player_id,black_player_id,winner_id,game_type,match_id,tournament_id,dateOf);

    
    

    
    
    
