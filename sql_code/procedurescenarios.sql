-- use collinolDB;

-- before and after procedure 1
delete from PlaysAgainstIn where numberOfGames = 300;
select * from PlaysAgainstIn where numberOfGames = 300; #returns empty
call AddLotsOfGamesToMatch();
select * from PlaysAgainstIn where numberOfGames = 300; #return 1

-- Procedure 2
-- find the player and his/her nationality who won the most games 
-- in the last 10 years, via procedure
call FirstQueryFromLastWeek();

-- Procedure 3
-- display current existing views
call ShowAllViews();

-- Procedure 4 - before and after modifying the view

-- before: Name of most popular game_type in FullMatchUps view
select game_type from (select game_type,count(game_type) from FullMatchUps group by game_type 
having count(game_type) >= all(select count(game_type) from FullMatchUps group by game_type))a;

call SwitchMostFreqGameType();

-- after: Name of most popular game_type in FullMatchUps view
select game_type from (select game_type,count(game_type) from FullMatchUps group by game_type 
having count(game_type) >= all(select count(game_type) from FullMatchUps group by game_type))a;

-- Procedure 5
-- before - should not have view Relative_Population (uncomment the query below to show that it terminates the query because the view doesn't exist
-- select * from Relative_Populations;
drop view if exists  Relative_Populations;
call PopulationRelativity();
-- after: shows in increasing order, each nation and their relative population
select * from  Relative_Populations;