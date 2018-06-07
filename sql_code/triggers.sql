-- drop triggers if they exist
-- use collinolDB;
DROP TRIGGER IF EXISTS playerIdInsert;
DROP TRIGGER IF EXISTS playerIdUpdate;


DELIMITER $$
-- trigger 1 enforces constraint
-- reject player1 = player2 insert
CREATE TRIGGER playerIdInsert
BEFORE INSERT ON PlaysAgainstIn
FOR EACH ROW
        BEGIN
                IF New.player1_id = New.player2_id THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'player ids must be different';
                END IF;
        END$$
DELIMITER ;
DELIMITER $$
-- trigger 2
-- keep old values when attempt to update player1 = player2
CREATE TRIGGER playerIdUpdate
BEFORE UPDATE ON PlaysAgainstIn
FOR EACH ROW
        BEGIN
                IF (New.player1_id = Old.player2_id) THEN
                        SET NEW.player1_id = OLD.player1_id;
                END IF;
                IF (New.player2_id = Old.player1_id) THEN
                        SET NEW.player2_id = OLD.player2_id;
                END IF;
        END$$

-- set delimiter back to semicolon
DELIMITER ;
DROP TRIGGER IF EXISTS RatedChangeTracker;

-- trigger 3
-- create log table and trigger trigger to keep track of changes
drop table if exists RatedChangeLog;
create table RatedChangeLog(
	Id INT auto_increment primary key ,
    command nchar(6) not null,
    timeOfChange datetime NOT NULL DEFAULT NOW(),
    oldyear varchar(255),
    newyear varchar(255),
    oldplayer_id varchar(255),
    newplayer_id varchar(255),
    oldrating varchar(255),
    newrating varchar(255)
);
delimiter $$
CREATE TRIGGER RatedChangeTracker 
after update
on isRatedIn
for each row
begin
   
	insert into RatedChangeLog (command, oldyear,newyear,oldplayer_id,newplayer_id,oldrating,newrating)
    select 'update',old.year,new.year, old.player_id,new.player_id, old.rating,new.rating;
    
end $$
delimiter ;

        







