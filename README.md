# Curierat
App for couriers. (PHP + MySql and HTML&CSS)

**Proiect Baze de Date**

Cerinta :

Aplicatie web – Firma de curierat

Etapa de proiectare :

- Alegerea mediului de dezvoltare (Server Apache 2.4)
- Alegerea limbajului de programare (PHP (5.4) + HTML &amp; CSS)
- Proiectarea si implementarea bazei de date
- Indeplinirea cerintelor prin crearea propriu-zisa a aplicatiei

Tabele :

- Adresa  (IdAdresa(PK), Judet, Localitate, Strada, Numar, Bloc, Scara, Apartament, CodPostal)
- Client (IdClient(PK), IdUser(FK), Nume, Prenume, Telefon, Email, PersoanaContact)
- ClientAdresa (IdClientAdresa(PK), IdClient(FK), IdAdresa(FK), AdresaPrincipala)
- Continut (IdContinut(PK), Greutate, Lungime, Latime, Inaltime)
- Detalii (IdDetalii (PK), Suma, Observatii, Continut)
- Users (IdUser(PK), Email, Password, IsAdmin)
- Expediere (IdExpediere(PK), IdClientE(FK), IdAdresaE(FK), IdClientD(FK), IdAdresaD(FK), IdContinut(FK), IdDetalii(FK), Status, Data)

Fiecare cheie primara are constangerea auto-increment aplicata asupra ei

**Functionarea Aplicatiei :**

Aplicatia Curierat are ca scop trimiterea organizata a coletelor, de la un expeditor la unul sau mai multi destinatari. Odata ce un nou utilizator isi creaza cont in aplicatie, acesta este indrumat sa-si completeze adresa actuala si datele de contact ale acestuia. Un user este vazut ca un client iar atunci cand acesta efectueaza un transfer de colete catre alta persoana, noua persoana va fi retinuta in baza de date, ca un alt potential client (chiar daca aceasta noua persoana nu este si user in aplicatie). Un client poate avea una sau mai multe adrese, iar adresa actuala este identificata in baza de date prin valoarea TRUE a coloanei AdresaPrincipala din tabelul ClientAdresa. Dupa acelasi rationament, userul ce are atributiuni de admin, va fi identificat prin valoarea TRUE a coloanei IsAdmin din tabelul Users . Atunci cand un client efectueaza un transfer a unui colet, acesta va fi indrumat sa introduca datele de contact ale destinatarului, adresa acestuia dar si detalii despre colet si despre livrare. Toate informatiile sunt stocate in tabela Expediere, generand un IdExpediere, id ce poate fi utilizat pentru a urmari comanda fiecaruia. Administrarea aplicatiei se face intr-un mod intuitiv, administratorul putand vedea si modifica informatiile foarte usor.

**Relatiile intre tabele**

![alt text](https://i.ibb.co/RpnRbQ2/baza-de-date.png)


