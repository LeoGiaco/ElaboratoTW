-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Mon Nov 21 20:13:31 2022 
-- * LUN file: C:\Users\andre\Desktop\ProgettoWEB\ElaboratoTW\database\ERTW.lun 
-- * Schema: Logico/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database Logico;
use Logico;


-- Tables Section
-- _____________ 

create table Commento (
     ID -- Index attribute not implemented -- not null,
     Testo varchar(200) not null,
     Data date not null,
     Post -- Index attribute not implemented -- not null,
     Utente varchar(50) not null,
     constraint IDCommento primary key (ID));

create table Conversazione (
     Username2 varchar(50) not null,
     Username1 varchar(50) not null,
     constraint IDConversazione_1 primary key (Username2, Username1));

create table Credenziali (
     Mail varchar(50) not null,
     Utente varchar(50) not null,
     Password varchar(50) not null,
     constraint IDCredenziali primary key (Mail),
     constraint FKPossesso_ID unique (Utente));

create table Follower (
     Seguito varchar(50) not null,
     Seguace varchar(50) not null,
     constraint IDFollower primary key (Seguito, Seguace));

create table Impostazione (
     Utente varchar(50) not null,
     LayoutClassico char not null,
     constraint FKScelta_ID primary key (Utente));

create table Inerente (
     Post -- Index attribute not implemented -- not null,
     Interesse varchar(50) not null,
     constraint IDInerente primary key (Post, Interesse));

create table Interesse (
     Nome varchar(50) not null,
     constraint IDInteresse primary key (Nome));

create table Messaggio (
     ID -- Index attribute not implemented -- not null,
     Testo varchar(200),
     Data date not null,
     Media varchar(50),
     Username2 varchar(50) not null,
     Username1 varchar(50) not null,
     Mittente varchar(50) not null,
     constraint IDMessaggio primary key (ID));

create table Notifica (
     ID -- Index attribute not implemented -- not null,
     Testo varchar(200) not null,
     Data date not null,
     Visualizzata char not null,
     Utente varchar(50) not null,
     Tipologia varchar(50) not null,
     constraint IDNotifica primary key (ID));

create table Post (
     ID -- Index attribute not implemented -- not null,
     Data date not null,
     Testo varchar(200),
     Media varchar(50),
     Tipologia varchar(50) not null,
     Utente varchar(50) not null,
     constraint IDPost primary key (ID));

create table Preferenze (
     Interesse varchar(50) not null,
     Utente varchar(50) not null,
     constraint IDEsprime primary key (Utente, Interesse));

create table Reazione (
     Utente varchar(50) not null,
     Post -- Index attribute not implemented -- not null,
     Like char,
     Dislike char,
     constraint IDReazione primary key (Utente, Post));

create table TipologiaNotifica (
     Nome varchar(50) not null,
     constraint IDTipologiaNotifica primary key (Nome));

create table TipologiaPost (
     Nome varchar(50) not null,
     constraint IDTipologiaPost primary key (Nome));

create table Utente (
     Username varchar(50) not null,
     Nome varchar(50) not null,
     Cognome varchar(50) not null,
     Sesso char(1) not null,
     DataNascita date not null,
     Online char not null,
     constraint IDUtente_ID primary key (Username));


-- Constraints Section
-- ___________________ 

alter table Commento add constraint FKRiferito
     foreign key (Post)
     references Post (ID);

alter table Commento add constraint FKScrittura
     foreign key (Utente)
     references Utente (Username);

alter table Conversazione add constraint FKPartecipante1
     foreign key (Username1)
     references Utente (Username);

alter table Conversazione add constraint FKPartecipante2
     foreign key (Username2)
     references Utente (Username);

alter table Credenziali add constraint FKPossesso_FK
     foreign key (Utente)
     references Utente (Username);

alter table Follower add constraint FKSeg
     foreign key (Seguace)
     references Utente (Username);

alter table Follower add constraint FKSeguito
     foreign key (Seguito)
     references Utente (Username);

alter table Impostazione add constraint FKScelta_FK
     foreign key (Utente)
     references Utente (Username);

alter table Inerente add constraint FKInteresse
     foreign key (Interesse)
     references Interesse (Nome);

alter table Inerente add constraint FKPost
     foreign key (Post)
     references Post (ID);

alter table Messaggio add constraint FKInclude
     foreign key (Username2, Username1)
     references Conversazione (Username2, Username1);

alter table Messaggio add constraint FKInvia
     foreign key (Mittente)
     references Utente (Username);

alter table Notifica add constraint FKAvviso
     foreign key (Utente)
     references Utente (Username);

alter table Notifica add constraint FKDi
     foreign key (Tipologia)
     references TipologiaNotifica (Nome);

alter table Post add constraint FKHa
     foreign key (Tipologia)
     references TipologiaPost (Nome);

alter table Post add constraint FKCreazione
     foreign key (Utente)
     references Utente (Username);

alter table Preferenze add constraint FKUtente
     foreign key (Utente)
     references Utente (Username);

alter table Preferenze add constraint FKInteresse
     foreign key (Interesse)
     references Interesse (Nome);

alter table Reazione add constraint FKPost
     foreign key (Post)
     references Post (ID);

alter table Reazione add constraint FKUtente
     foreign key (Utente)
     references Utente (Username);

-- Not implemented
-- alter table Utente add constraint IDUtente_CHK
--     check(exists(select * from Credenziali
--                  where Credenziali.Utente = Username)); 

-- Not implemented
-- alter table Utente add constraint IDUtente_CHK
--     check(exists(select * from Impostazione
--                  where Impostazione.Utente = Username)); 


-- Index Section
-- _____________ 

