-- use collinolDB;
-- Trigger 1 enforce constraint
-- activated - should reject inserting into PlaysAgainstIn when
-- inserting player1_id = player2_d (a player playing against themselves)

-- Attention: This insert will end the program because of the trigger preventing the insertion
-- Please comment this out to continue with the rest of the scenarios.
insert ignore into PlaysAgainstIn
values (1,1,"1-1-1-06",4,1);
-- query should return empty result
select * from PlaysAgainstIn where player1_id = player2_id;

-- not activated - following query should return newly insert tuple
delete from PlaysAgainstIn where match_id = "3-2-1-05";
insert into PlaysAgainstIn
values(101,102,"3-2-1-05",4,101);
select * from PlaysAgainstIn where match_id = "3-2-1-05";

-- Trigger 2
-- activated - should keep current values the same when trying to 
-- update a player_id to be the same as the other player_id
update PlaysAgainstIn
set player1_id = 2 where player2_id = 2;
-- following query should return all results with player2_id = 2
-- and we'll see that player1_id remains what is was
select * from PlaysAgainstIn where player2_id = 2;

-- not activated
update PlaysAgainstIn
set player1_id = 100 where match_id = "3-2-1-05";
-- following query should return the same result as the first query
-- except with player1_id changed to 100
select * from PlaysAgainstIn where match_id = "3-2-1-05";

-- Trigger 3
-- activated -- trigger 3 records update changes in isRatedIn to the table RatedChangeLog
update isRatedIn
set rating = 300 where player_id = 11000 and year = 2007;
-- query should return one row, reflecting the changes for year,player_id and rating
-- only the new rating will be different
select * from RatedChangeLog;

-- not activated -- trigger only records updates, so inserts and deletes won't be recorded
insert into isRatedIn
values
(2008,1001,3000);
-- query should return the same result as before because trigger did not record another update
select * from RatedChangeLog;



