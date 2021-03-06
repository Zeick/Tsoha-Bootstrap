-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Pokemon(
--    id SERIAL PRIMARY KEY,
    tunnusluku INTEGER PRIMARY KEY,
    nimi varchar(20) NOT NULL,
    pituus INTEGER,
    paino INTEGER,
    kuvaus varchar(1000)
);

CREATE TABLE Kouluttaja(
    nimi varchar(20) PRIMARY KEY,
    salasana varchar(20),
    kuvaus varchar(1000)
);

CREATE TABLE OmaPokemon(
    id SERIAL PRIMARY KEY,
    atk INTEGER,
    def INTEGER,
    speed INTEGER,
    spatk INTEGER,
    spdef INTEGER,
    hp INTEGER,
    lvl INTEGER,
    sukupuoli varchar(1),
    lempinimi varchar(20),
    esine varchar(20),
    kuvaus varchar(1000),
    pid INTEGER REFERENCES Pokemon(tunnusluku),
    kid varchar(20) REFERENCES Kouluttaja(nimi)
);

CREATE TABLE Liiga(
    nimi varchar(20) PRIMARY KEY,
    johtaja varchar(20) REFERENCES Kouluttaja(nimi),
    kuvaus varchar(1000)
);

CREATE TABLE Jasenyys(
    jasen varchar(20) REFERENCES Kouluttaja(nimi),
    nimi varchar(20) REFERENCES Liiga(nimi) 
);