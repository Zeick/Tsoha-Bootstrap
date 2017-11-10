-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Pokemon(
    id SERIAL PRIMARY KEY,
    nimi varchar(20) NOT NULL,
    pituus INTEGER,
    paino INTEGER
);

CREATE TABLE Kouluttaja(
    nimi varchar(20) PRIMARY KEY,
    salasana varchar(20)
);

CREATE TABLE OmaPokemon(
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
    FOREIGN KEY(pid) REFERENCES Pokemon(id),
    FOREIGN KEY(kid) REFERENCES Kouluttaja(nimi)
);

CREATE TABLE Liiga(
    nimi varchar(20) PRIMARY KEY,
    FOREIGN KEY(johtaja) REFERENCES Kouluttaja(nimi)
);

CREATE TABLE Jasenyys(
    FOREIGN KEY(jasen) REFERENCES Kouluttaja(nimi),
    FOREIGN KEY(liiganimi) REFERENCES Liiga(nimi) 
);