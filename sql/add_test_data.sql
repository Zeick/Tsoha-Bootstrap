-- Lisää INSERT INTO lauseet tähän tiedostoon
-- KOULUTTAJA
INSERT INTO Kouluttaja (nimi, salasana) VALUES ('admin', 'pass1');
INSERT INTO Kouluttaja (nimi, salasana) VALUES ('Ash', 'pikachu');
INSERT INTO Kouluttaja (nimi, salasana) VALUES ('Misty','togepi');
-- POKEMON
INSERT INTO Pokemon (tunnusluku, nimi, pituus, paino, kuvaus) VALUES (1, 'Bulbasaur' ,50,10,'Bulbapedian maskotti');
INSERT INTO Pokemon (tunnusluku, nimi, pituus, paino, kuvaus) VALUES (4, 'Charmander',70,12,'Suosittu aloituspokémon');
INSERT INTO Pokemon (tunnusluku, nimi, pituus, paino, kuvaus) VALUES (7, 'Squirtle'  ,60,18,'Kilpikonnamainen vesipokémon');
-- OMAPOKEMON
INSERT INTO OmaPokemon (atk, def, speed, spatk, spdef, hp, lvl, sukupuoli, esine, kuvaus, pid, kid) VALUES (12, 11, 9,  14, 14, 31, 9,'U','Berry', 'joo', 1, 'admin');
INSERT INTO OmaPokemon (atk, def, speed, spatk, spdef, hp, lvl, sukupuoli, esine, kuvaus, pid, kid) VALUES (10, 10, 10, 10, 10, 22, 6,'N','Quick Claw', 'juu', 4, 'Ash');
INSERT INTO OmaPokemon (atk, def, speed, spatk, spdef, hp, lvl, sukupuoli, esine, kuvaus, pid, kid) VALUES (113,121,114,190,170,99,39,'U','Leftovers', 'jaa', 7, 'Misty');
-- LIIGA
INSERT INTO Liiga (nimi, johtaja) VALUES ('Kantoliiga','Ash');
INSERT INTO Liiga (nimi, johtaja) VALUES ('Vesiliiga','Misty');
INSERT INTO Liiga (nimi, johtaja) VALUES ('Rikollisliiga','admin');
