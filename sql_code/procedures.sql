-- use collinolDB;
-- Procedure 1
-- modify the database such that we take one match
-- that had 3 games, and change the numberOfGames to 300
drop procedure if exists AddLotsOfGamesToMatch;
DELIMITER $$
CREATE PROCEDURE AddLotsOfGamesToMatch()
BEGIN
update PlaysAgainstIn
set numberOfGames = 300 where numberOfGames = 3 limit 1;
END$$
DELIMITER ;

-- Procedure 2
-- recreate the view and subsequent query from week 6
-- to find the player and his/her nationality who won the most games in the last 10 years
drop procedure if exists FirstQueryFromLastWeek;
DELIMITER $$
CREATE PROCEDURE FirstQueryFromLastWeek()
BEGIN
drop view MostWinner;
create view MostWinner as 
(select a.winner_id,count(winner_id) as total from (
select * from Games where dateOf between 7 and 17) a 
group by a.winner_id having total >= 
all(select count(winner_id) from Games 
where dateOf between 7 and 17 group by winner_id));

select name, Nations.name_abbrev as country,MostWinner.total as number_of_wins from Player inner join
MostWinner on Player.player_id = MostWinner.winner_id inner join
Nations on Player.nation_id = Nations.nation_id;
END$$
DELIMITER ;

-- Procedure 3 
-- return a table that shows the user all the currently existing views
drop procedure if exists ShowAllViews;
DELIMITER $$
CREATE PROCEDURE ShowAllViews()
BEGIN
select * from information_schema.tables
where table_type = "view";
END$$
DELIMITER ;

-- Procedure 4
-- modify the view FullMatchUps to replace the most common game type
-- with "Collin's Game"
drop procedure if exists SwitchMostFreqGameType;
DELIMITER $$
CREATE PROCEDURE SwitchMostFreqGameType()
BEGIN
update FullMatchUps
set game_type = "Collin's Game" 
where game_type = (select game_type from (select game_type,count(game_type) from FullMatchUps group by game_type 
having count(game_type) >= all(select count(game_type) from FullMatchUps group by game_type))a);
END$$
DELIMITER ;

-- Procedure 5
-- Create a view of each nation and it's population as a percent relative to
-- the total population of all nations involved
drop procedure if exists PopulationRelativity;
DELIMITER $$
CREATE PROCEDURE PopulationRelativity()
BEGIN
drop view if exists Relative_Populations;
create view Relative_Populations as
select name_abbrev,population / (select population from Nations 
having population >= all(select population from Nations)) )rel_pop from Nations order by rel_pop ;
END$$
DELIMITER ;
