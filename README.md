# totito_v6

DB:

$ query

CREATE TABLE jugadas_ganadas(
    id int AUTO_INCREMENT primary key,
    jugador integer,
    primera varchar(200),
    segunda varchar(200),
    tercera varchar(200),
    created_ad date
)
 
