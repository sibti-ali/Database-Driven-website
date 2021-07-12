<?php

$header_query = "SELECT COUNT(DISTINCT(competitions.event_id)) AS Events,  COUNT(DISTINCT(dogs.owner_id)) AS Owners, COUNT(DISTINCT(entries.dog_id)) AS Dogs
FROM competitions
JOIN entries, dogs
WHERE competitions.id = entries.competition_id
AND  entries.dog_id = dogs.id;
";

$leaderboard_query = "WITH records
AS
(
    SELECT  a.id, a.name, cast((AVG(c.score)) as decimal (10,2)) Avg_score, b.name Breed, o.name Owner, o.email Email, o.id OwnersId,
            DENSE_RANK() OVER (ORDER BY AVG(c.score) DESC) 
    FROM    dogs a
    		INNER JOIN breeds b
    				ON a.breed_id = b.id
            INNER JOIN entries c
                ON a.id = c.dog_id
    		INNER JOIN owners o
    			ON a.owner_id = o.id
    		
    
    GROUP   BY a.id, a.name
    HAVING	COUNT(c.dog_id) > 1
)
SELECT  Name, Avg_Score, Breed , Owner , Email, OwnersId
FROM    records
ORDER   BY Avg_score DESC, Name
LIMIT	10;";

?>