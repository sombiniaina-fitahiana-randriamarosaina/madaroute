CREATE DATABASE madaroute;
CREATE ROLE admin_madaroute LOGIN password '123456';
ALTER DATABASE madaroute OWNER TO admin_madaroute;

psql -U admin_madaroute madaroute

create sequence admin_seq start with 1;
create sequence utilisateur_seq start with 1;
create sequence route_seq start with 1;
create sequence portion_seq start with 1;
create sequence etatPortion_seq start with 1;
create sequence budget_seq start with 1;
create sequence reparation_seq start with 1;

create table admin (
  idAdmin int primary key default nextval('admin_seq'),
  nom varchar(50),
  mail varchar(50),
  mdp char(32)
);

create table utilisateur (
  idUtilisateur int primary key default nextval('utilisateur_seq'),
  nom varchar(50),
  mail varchar(50),
  mdp char(32)
);

create table etatPortion (
  idEtatPortion int primary key default nextval('etatPortion_seq'),
  etat int,
  libelleEtat varchar(50),
  coutReparation numeric(18, 2) default 0,
  dureeReparation int default 0,
  coeffDeg numeric(18, 2) default 0,
  color varchar(30) default 'black'
);

create table route (
  idRoute int primary key default nextval('route_seq'),
  numRoute varchar(10),
  villeDepart varchar(50),
  villeArrivee varchar(50),
  distance numeric(18, 2) default 0,
  etat varchar(30) default 'modifiable'
);

create table portion (
  idPortion int primary key default nextval('portion_seq'),
  idRoute int,
  pkDebut numeric(18, 2) default 0,
  pkFin numeric(18, 2) default 0,
  idEtatPortion int,
  foreign key (idRoute) references route(idRoute),
  foreign key (idEtatPortion) references etatPortion(idEtatPortion)
);

create table budget (
  idBudget int primary key default nextval('budget_seq'),
  budget numeric(18, 2) default 0
);

create table reparation (
  idReparation int primary key default nextval('reparation_seq'),
  idPortion int,
  montant numeric(18, 2) default 0,
  dateReparation timestamp,
  foreign key (idPortion) references portion(idPortion)
);

insert into admin values (default, 'Jean', 'jean@gmail.com', md5('jean'));
insert into admin values (default, 'Soa', 'soa@gmail.com', md5('soa'));

insert into utilisateur values (default, 'John', 'John@gmail.com', md5('john'));
insert into utilisateur values (default, 'Rakoto', 'Rakoto@gmail.com', md5('rakoto'));

insert into etatPortion values (default, 1, 'Tres bien', 0, 0, 0, 'green');
insert into etatPortion values (default, 2, 'Bien', 300000, 2, 20, 'lightgreen');
insert into etatPortion values (default, 3, 'Moyen', 500000, 4, 40, 'orange');
insert into etatPortion values (default, 4, 'Mauvais', 800000, 6, 80, 'red');

insert into route values (default, 'RN1', 'Antananarivo', 'Antsirabe', 130, 'validee');
insert into route values (default, 'RN2', 'Antananarivo', 'Toamasina', 460, 'modifiable');
insert into route values (default, 'RN3', 'Majunga', 'Diego', 320, 'modifiable');

insert into portion values (default, 1, 0, 30, 1);
insert into portion values (default, 1, 30, 100, 3);
insert into portion values (default, 1, 100, 110, 1);
insert into portion values (default, 1, 110, 130, 4);
insert into portion values (default, 2, 0, 100, 2);
insert into portion values (default, 2, 100, 300, 3);
insert into portion values (default, 2, 300, 460, 1);
insert into portion values (default, 3, 0, 200, 4);
insert into portion values (default, 3, 200, 320, 2);

insert into budget values (default, 100000000);

create or replace view portion_etatPortion as (
    select idPortion, idRoute, pkDebut, pkFin, portion.idEtatPortion, etat, libelleEtat, coutReparation, dureeReparation
    from portion
    join etatPortion on etatPortion.idEtatPortion = portion.idEtatPortion
);


create or replace view route_distance as (
    select idRoute, sum(pkFin-pkDebut) as distance
    from portion
    group by idRoute
);

create or replace view route_sommeEtat as (
    select portion.idRoute, sum((pkFin-pkDebut) * (100-coeffDeg)) as sommeEtat
    from portion
    join etatPortion on etatPortion.idEtatPortion = portion.idEtatPortion
    join route_distance on route_distance.idRoute = portion.idRoute
    group by portion.idRoute
);

create or replace view route_etatGlobal as (
    select route_sommeEtat.idRoute, sommeEtat / distance as etatGlobal
    from route_sommeEtat
    join route_distance on route_distance.idRoute = route_sommeEtat.idRoute
);

create or replace view route_etatGlobal_view as (
    select route.idRoute, numroute, villedepart, villearrivee, distance, etatGlobal, etat
    from route_etatGlobal
    join route on route.idRoute = route_etatGlobal.idRoute
);


create or replace view route_portions_details as (
    select idPortion, idRoute, pkDebut, pkFin, (pkFin-pkDebut) as distance,
            portion.idEtatPortion, etat, libelleEtat, color, coutReparation, dureeReparation,
            (pkFin-pkDebut)*coutReparation as montant, (pkFin-pkDebut)*dureeReparation as dureeReparationEnsemble
    from portion
    join etatPortion on etatPortion.idEtatPortion = portion.idEtatPortion
);

create or replace view route_entretien_total as (
    select idRoute, sum(montant) as montantTotal, sum(dureeReparationEnsemble) as dureeReparationTotal
    from route_portions_details
    group by idRoute
);


create or replace view historique_reparation as (
    select portion.idPortion, route.idRoute, numroute, pkDebut, pkFin, (pkFin-pkDebut) as distance, montant, dateReparation
    from reparation
    join portion on portion.idPortion = reparation.idPortion
    join route on route.idRoute = portion.idRoute
);

create or replace view route_fiche as (
    select route.*, etatGlobal
    from route
    join route_etatGlobal on route_etatGlobal.idRoute = route.idRoute
);
