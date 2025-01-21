-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Sun Jan 19 19:19:04 2025 
-- * LUN file: C:\Users\mpagg\Desktop\TW24-ScoutShop\ScoutShop.lun 
-- * Schema: ScoutShopDatabase/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database ScoutShopDatabase;
use ScoutShopDatabase;


-- Tables Section
-- _____________ 

create table Carrello (
     E_mail char(64) not null,
     Di_Codice_prodotto char(64) not null,
     Codice_prodotto char(64) not null,
     constraint ID_Carrello_ID primary key (E_mail, Di_Codice_prodotto, Codice_prodotto));

create table CATEGORIA_GENERALE (
     Nome_categoria char(64) not null,
     constraint ID_CATEGORIA_GENERALE_ID primary key (Nome_categoria));

create table CATEGORIA_PRODOTTO (
     Nome_categoria char(64) not null,
     Div_Nome_categoria char(64) not null,
     constraint ID_CATEGORIA_PRODOTTO_ID primary key (Nome_categoria));

create table DETTAGLIO_ORDINE (
     Di_Codice_prodotto char(64) not null,
     Codice_prodotto char(64) not null,
     Codice_ordine char(64) not null,
     Quantita_ int not null,
     Prezzo_d_acquisto float not null,
     constraint ID_DETTAGLIO_ORDINE_ID primary key (Codice_ordine, Di_Codice_prodotto, Codice_prodotto));

create table ORDINE (
     Codice_ordine char(64) not null,
     Data_ordine date not null,
     LettoCompratoreYN char not null,
     LettoVenditoreYN char not null,
     E_mail_compratore char(64) not null,
     E_mail_venditore char(64) not null,
     Tipo_spedizione char(64) not null,
     constraint ID_ORDINE_ID primary key (Codice_ordine));

create table PRODOTTO (
     Codice_prodotto char(64) not null,
     Nome_prodotto char(64) not null,
     Nome_categoria char(64) not null,
     constraint ID_PRODOTTO_ID primary key (Codice_prodotto));

create table SPEDIZIONE (
     Tipo_spedizione char(64) not null,
     Tempo_di_arrivo int not null,
     Costo_spedizione float not null,
     constraint ID_SPEDIZIONE_ID primary key (Tipo_spedizione));

create table UTENTE_COMPRATORE (
     E_mail char(64) not null,
     Password char(64) not null,
     Nome char(64) not null,
     Cognome char(64) not null,
     Indirizzo char(64) not null,
     constraint ID_UTENTE_COMPRATORE_ID primary key (E_mail));

create table UTENTE_VENDITORE (
     E_mail char(64) not null,
     Password char(64) not null,
     constraint ID_UTENTE_VENDITORE_ID primary key (E_mail));

create table VERSIONE_PRODOTTO (
     Di_Codice_prodotto char(64) not null,
     Codice_prodotto char(64) not null,
     Marchio char(64) not null,
     Descrizione text not null,
     Colore char(64),
     Taglia char(10),
     Prezzo float not null,
     Disponibilita bigint not null,
     Sconto float,
     Nome_immagine char(64) not null,
     constraint ID_VERSIONE_PRODOTTO_ID primary key (Di_Codice_prodotto, Codice_prodotto));


-- Constraints Section
-- ___________________ 

alter table Carrello add constraint FKCar_VER_FK
     foreign key (Di_Codice_prodotto, Codice_prodotto)
     references VERSIONE_PRODOTTO (Di_Codice_prodotto, Codice_prodotto);

alter table Carrello add constraint FKCar_UTE
     foreign key (E_mail)
     references UTENTE_COMPRATORE (E_mail);

alter table CATEGORIA_PRODOTTO add constraint FKDivisione_FK
     foreign key (Div_Nome_categoria)
     references CATEGORIA_GENERALE (Nome_categoria);

alter table DETTAGLIO_ORDINE add constraint FKComposizione
     foreign key (Codice_ordine)
     references ORDINE (Codice_ordine);

alter table DETTAGLIO_ORDINE add constraint FKPer_FK
     foreign key (Di_Codice_prodotto, Codice_prodotto)
     references VERSIONE_PRODOTTO (Di_Codice_prodotto, Codice_prodotto);

-- Not implemented
-- alter table ORDINE add constraint ID_ORDINE_CHK
--     check(exists(select * from DETTAGLIO_ORDINE
--                  where DETTAGLIO_ORDINE.Codice_ordine = Codice_ordine)); 

alter table ORDINE add constraint FKRichiesta_FK
     foreign key (E_mail_compratore)
     references UTENTE_COMPRATORE (E_mail);

alter table ORDINE add constraint FKRicezione_FK
     foreign key (E_mail_venditore)
     references UTENTE_VENDITORE (E_mail);

alter table ORDINE add constraint FKCon_FK
     foreign key (Tipo_spedizione)
     references SPEDIZIONE (Tipo_spedizione);

alter table PRODOTTO add constraint FKAppartenenza_FK
     foreign key (Nome_categoria)
     references CATEGORIA_PRODOTTO (Nome_categoria);

alter table VERSIONE_PRODOTTO add constraint FKDi
     foreign key (Di_Codice_prodotto)
     references PRODOTTO (Codice_prodotto);


-- Index Section
-- _____________ 

create unique index ID_Carrello_IND
     on Carrello (E_mail, Di_Codice_prodotto, Codice_prodotto);

create index FKCar_VER_IND
     on Carrello (Di_Codice_prodotto, Codice_prodotto);

create unique index ID_CATEGORIA_GENERALE_IND
     on CATEGORIA_GENERALE (Nome_categoria);

create unique index ID_CATEGORIA_PRODOTTO_IND
     on CATEGORIA_PRODOTTO (Nome_categoria);

create index FKDivisione_IND
     on CATEGORIA_PRODOTTO (Div_Nome_categoria);

create unique index ID_DETTAGLIO_ORDINE_IND
     on DETTAGLIO_ORDINE (Codice_ordine, Di_Codice_prodotto, Codice_prodotto);

create index FKPer_IND
     on DETTAGLIO_ORDINE (Di_Codice_prodotto, Codice_prodotto);

create unique index ID_ORDINE_IND
     on ORDINE (Codice_ordine);

create index FKRichiesta_IND
     on ORDINE (E_mail_compratore);

create index FKRicezione_IND
     on ORDINE (E_mail_venditore);

create index FKCon_IND
     on ORDINE (Tipo_spedizione);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (Codice_prodotto);

create index FKAppartenenza_IND
     on PRODOTTO (Nome_categoria);

create unique index ID_SPEDIZIONE_IND
     on SPEDIZIONE (Tipo_spedizione);

create unique index ID_UTENTE_COMPRATORE_IND
     on UTENTE_COMPRATORE (E_mail);

create unique index ID_UTENTE_VENDITORE_IND
     on UTENTE_VENDITORE (E_mail);

create unique index ID_VERSIONE_PRODOTTO_IND
     on VERSIONE_PRODOTTO (Di_Codice_prodotto, Codice_prodotto);

