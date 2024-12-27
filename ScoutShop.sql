-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Dec 27 12:53:27 2024 
-- * LUN file:  
-- * Schema: DatabaseWeb/4 
-- ********************************************* 


-- Database Section
-- ________________ 

create database DatabaseWeb;
use DatabaseWeb;


-- Tables Section
-- _____________ 

create table Carrello (
     E_mail char(64) not null,
     Di_Codice_prodotto char(64) not null,
     Codice_prodotto char(64) not null,
     constraint ID_Carrello_ID primary key (Di_Codice_prodotto, Codice_prodotto, E_mail));

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
     Quantita int not null,
     Prezzo_d_acquisto float not null,
     constraint ID_DETTAGLIO_ORDINE_ID primary key (Codice_ordine, Di_Codice_prodotto, Codice_prodotto));

create table NOTIFICA (
     Codice_ordine char(64) not null,
     Tipo_stato char(64) not null,
     Data_notifica date not null,
     E_mail char(64) not null,
     constraint ID_NOTIFICA_ID primary key (Codice_ordine, Tipo_stato));

create table ORDINE (
     Codice_ordine char(64) not null,
     Data_ordine date not null,
     E_mail char(64) not null,
     Ric_E_mail char(64) not null,
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

create table STATO_ORDINE (
     Tipo_stato char(64) not null,
     constraint ID_STATO_ORDINE_ID primary key (Tipo_stato));

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

alter table Carrello add constraint FKCar_VER
     foreign key (Di_Codice_prodotto, Codice_prodotto)
     references VERSIONE_PRODOTTO (Di_Codice_prodotto, Codice_prodotto);

alter table Carrello add constraint FKCar_UTE_FK
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

alter table NOTIFICA add constraint FKVisualizzazione_FK
     foreign key (E_mail)
     references UTENTE_COMPRATORE (E_mail);

alter table NOTIFICA add constraint FKRiferimento_FK
     foreign key (Tipo_stato)
     references STATO_ORDINE (Tipo_stato);

alter table NOTIFICA add constraint FKPrevisione
     foreign key (Codice_ordine)
     references ORDINE (Codice_ordine);

-- Not implemented
-- alter table ORDINE add constraint ID_ORDINE_CHK
--     check(exists(select * from DETTAGLIO_ORDINE
--                  where DETTAGLIO_ORDINE.Codice_ordine = Codice_ordine)); 

alter table ORDINE add constraint FKRichiesta_FK
     foreign key (E_mail)
     references UTENTE_COMPRATORE (E_mail);

alter table ORDINE add constraint FKRicezione_FK
     foreign key (Ric_E_mail)
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
     on Carrello (Di_Codice_prodotto, Codice_prodotto, E_mail);

create index FKCar_UTE_IND
     on Carrello (E_mail);

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

create unique index ID_NOTIFICA_IND
     on NOTIFICA (Codice_ordine, Tipo_stato);

create index FKVisualizzazione_IND
     on NOTIFICA (E_mail);

create index FKRiferimento_IND
     on NOTIFICA (Tipo_stato);

create unique index ID_ORDINE_IND
     on ORDINE (Codice_ordine);

create index FKRichiesta_IND
     on ORDINE (E_mail);

create index FKRicezione_IND
     on ORDINE (Ric_E_mail);

create index FKCon_IND
     on ORDINE (Tipo_spedizione);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (Codice_prodotto);

create index FKAppartenenza_IND
     on PRODOTTO (Nome_categoria);

create unique index ID_SPEDIZIONE_IND
     on SPEDIZIONE (Tipo_spedizione);

create unique index ID_STATO_ORDINE_IND
     on STATO_ORDINE (Tipo_stato);

create unique index ID_UTENTE_COMPRATORE_IND
     on UTENTE_COMPRATORE (E_mail);

create unique index ID_UTENTE_VENDITORE_IND
     on UTENTE_VENDITORE (E_mail);

create unique index ID_VERSIONE_PRODOTTO_IND
     on VERSIONE_PRODOTTO (Di_Codice_prodotto, Codice_prodotto);

