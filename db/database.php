<?php
    class DatabaseHelper {
        private $db;
        
        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
        }
        
        // Ritorna tutte le versioni prodotto (pagina venditore)
        public function getProductVerions() {
            $query = "SELECT P.*, VP.* FROM VERSIONE_PRODOTTO VP INNER JOIN PRODOTTO P ON VP.Di_Codice_prodotto = P.Codice_prodotto";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna dei prodotti in ordine casuale (home buyer)
        public function getRandomProducts($n=-1) {
            $query = "SELECT * FROM prodotto P INNER JOIN VERSIONE_PRODOTTO VP ON P.Codice_prodotto = VP.Di_Codice_prodotto ORDER BY RAND()";
            if ($n > 0) {
                $query .= " LIMIT ?";
            }
            
            $stmt = $this->db->prepare($query);
            
            if ($n > 0) {
                $stmt->bind_param("i", $n);
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna i prodotti più venduti (home buyer)
        public function getTopProducts($n=-1) {
            $query = "SELECT P.*, VP.*, SUM(DO.Quantita_) AS Quantita_Venduta FROM DETTAGLIO_ORDINE DO INNER JOIN VERSIONE_PRODOTTO VP INNER JOIN PRODOTTO P ON DO.Di_Codice_prodotto = VP.Di_Codice_prodotto AND DO.Codice_prodotto = VP.Codice_prodotto AND P.Codice_prodotto = VP.Di_Codice_prodotto GROUP BY VP.Di_Codice_prodotto, VP.Codice_prodotto, VP.Marchio, VP.Descrizione ORDER BY Quantita_Venduta DESC
            ";
            
            if ($n > 0) {
                $query .= " LIMIT ?";
            }
            $stmt = $this->db->prepare($query);
            if ($n > 0) {
                $stmt->bind_param("i", $n);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna i prodotti venduti più recentemente (home buyer)
        public function getRecentProducts($n=-1, $email) {
            $query = "SELECT P.*, VP.* FROM DETTAGLIO_ORDINE DO INNER JOIN VERSIONE_PRODOTTO VP INNER JOIN PRODOTTO P ON DO.Di_Codice_prodotto = VP.Di_Codice_prodotto AND DO.Codice_prodotto = VP.Codice_prodotto AND P.Codice_prodotto = VP.Di_Codice_prodotto INNER JOIN ORDINE O ON DO.Codice_ordine = O.Codice_ordine WHERE O.E_mail_compratore != ? ORDER BY O.Data_ordine DESC";
            
            if ($n > 0) {
                $query .= " LIMIT ?";
            }
            $stmt = $this->db->prepare($query);
            if ($n > 0) {
                $stmt->bind_param("si", $email, $n);
            } else {
                $stmt->bind_param("s", $email);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna i prodotti di una categoria (header)
        public function getProductsFromCategory($categoria) {
            $query = "SELECT P.*, VP.* FROM VERSIONE_PRODOTTO VP INNER JOIN PRODOTTO P ON VP.Di_Codice_prodotto = P.Codice_prodotto WHERE P.Nome_categoria = ? GROUP BY VP.Di_Codice_prodotto";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $categoria);
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna uno specifico prodotto (pagina prodotto)
        public function getSingleProcuct($nome_prodotto) {
            $query = "SELECT P.*, VP.* FROM PRODOTTO P INNER JOIN VERSIONE_PRODOTTO VP ON P.Codice_prodotto = VP.Di_Codice_prodotto WHERE P.Nome_prodotto = ?";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $nome_prodotto);
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna prodotti in base alla stringa (search bar/profilo venditore)
        public function getProductsFromSearch($string) {
            $query = "SELECT P.*, VP.* FROM PRODOTTO P INNER JOIN VERSIONE_PRODOTTO VP ON P.Codice_prodotto = VP.Di_Codice_prodotto WHERE Nome_prodotto LIKE CONCAT('%', ?, '%')";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $string);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna la versione del prodotto dati i codici (profilo venditore)
        public function getProductFromCode($codice_prodotto, $codice_versione) {
            $query = "SELECT P.*, VP.* FROM VERSIONE_PRODOTTO VP INNER JOIN PRODOTTO P ON VP.Di_Codice_prodotto = P.Codice_prodotto WHERE P.Codice_prodotto = ? AND VP.Codice_prodotto = ?";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $codice_prodotto, $codice_versione);
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Inserisci una nuova versione prodotto (profilo venditore)
        public function insertProductVersion($codice_prodotto, $nome_prodotto, $categoria, $codice_versione, $marchio, $descrizione, $colore, $taglia, $prezzo, $disponibilita, $sconto, $immagine) {
            $query = "INSERT INTO `VERSIONE_PRODOTTO`(`Di_Codice_prodotto`, `Codice_prodotto`, `Marchio`, `Descrizione`, `Colore`, `Taglia`, `Prezzo`, `Disponibilita`, `Sconto`, `Nome_immagine`) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssssssssss", $codice_prodotto, $nome_prodotto, $categoria, $codice_versione, $marchio, $descrizione, $colore, $taglia, $prezzo, $disponibilita, $sconto, $immagine);
            return $stmt->execute();
        }
        
        // Aggiungi un prodotto (profilo venditore)
        public function addProduct($codice_prodotto, $nome_prodotto, $categoria, $codice_versione, $marchio, $descrizione, $colore, $taglia, $prezzo, $disponibilita, $sconto, $immagine) {
            if (getSingleProcuct($nome_prodotto)) {
                return insertProductVersion($codice_prodotto, $nome_prodotto, $categoria, $codice_versione, $marchio, $descrizione, $colore, $taglia, $prezzo, $disponibilita, $sconto, $immagine);
            } else {
                $query = "INSERT INTO `PRODOTTO`(`Codice_prodotto`, `Nome_prodotto`, `Nome_categoria`) VALUES (?,?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("ssss", $codice_prodotto, $nome_prodotto, $categoria);
                if ($stmt->execute()) {
                    return insertProductVersion($codice_prodotto, $nome_prodotto, $categoria, $codice_versione, $marchio, $descrizione, $colore, $taglia, $prezzo, $disponibilita, $sconto, $immagine);
                } else {
                    return 0;
                }
            }
        }
        
        // Modifica una versione prodotto (profilo venditore)
        public function updateProductVersion($codice_prodotto, $codice_versione, $descrizione, $prezzo, $disponibilita, $sconto, $immagine) {
            $query = "UPDATE VERSIONE_PRODOTTO SET Descrizione = COALESCE(?, Descrizione), Prezzo = COALESCE(?, Prezzo), Disponibilita = COALESCE(?, Disponibilita), Sconto = COALESCE(?, Sconto), Nome_immagine = COALESCE(?, Nome_immagine) WHERE Di_Codice_prodotto = ? AND Codice_prodotto = ?";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssssss", $descrizione, $prezzo, $disponibilita, $sconto, $immagine, $codice_prodotto, $codice_versione);
            return $stmt->execute();
        }

        // Ottieni disponibilità di una versione prodotto (prodotto singolo/carrello)
        public function getProductVersionDisponibility($codice_prodotto, $codice_versione) {
            $query = "SELECT Disponibilita FROM VERSIONE_PRODOTTO WHERE Di_Codice_prodotto = ? AND Codice_prodotto = ?";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $codice_prodotto, $codice_versione);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_row();
        }
        
        // Rimuovi un prodotto (profilo venditore)
        public function removeProduct($codice_prodotto, $codice_versione) {
            $query = "DELETE FROM VERSIONE_PRODOTTO WHERE Di_Codice_prodotto = ? AND Codice_prodotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $codice_prodotto, $codice_versione);
            $stmt->execute();
        }

        // Visualizza prodotti nel carrello (carrello)
        public function getUserProductsInCart($email) {
            $query = "SELECT * FROM CARRELLO WHERE E_mail = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Inserimento prodotti nel carrello (carrello)
        public function insertProductInCart($email, $codice_prodotto, $codice_versione, $quantita) {
            $query = "INSERT INTO CARRELLO (E_mail, Di_Codice_prodotto, Codice_prodotto, Quantita_) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssi", $email, $codice_prodotto, $codice_versione, $quantita);
            return $stmt->execute();
        }
        
        // Rimozione prodotti dal carrello (carrello)
        public function removeProductFromCart($email, $codice_prodotto, $codice_versione) {
            $query = "DELETE FROM CARRELLO WHERE E_mail = ? AND Di_Codice_prodotto = ? AND Codice_prodotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sss", $email, $codice_prodotto, $codice_versione);
            return $stmt->execute();
        }
        
        // Modifica quantità prodotti nel carrello (carrello)
        public function updateProductQuantityInCart($email, $codice_prodotto, $codice_versione, $quantita) {
            $query = "UPDATE CARRELLO SET Quantita_ = ? WHERE E_mail = ? AND Di_Codice_prodotto = ? AND Codice_prodotto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("isss", $quantita, $email, $codice_prodotto, $codice_versione);
            return $stmt->execute();
        }
        
        // Inserimenti dettagli ordine (pagamento)
        public function addOrderDetails($dettaglio_ordine) {
            $query = "INSERT INTO `DETTAGLIO_ORDINE`(`Di_Codice_prodotto`, `Codice_prodotto`, `Codice_ordine`, `Quantita_`, `Prezzo_d_acquisto`) VALUES (?,?,?,?,?)";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $dettaglio_ordine["Di_Codice_prodotto"], $dettaglio_ordine["Codice_prodotto"], $dettaglio_ordine["Codice_ordine"], $dettaglio_ordine["Quantita_"], $dettaglio_ordine["Prezzo_d_acquisto"]);
            return $stmt->execute();
        }
        
        // Creazione di un ordine (pagamento)
        public function newOrder($codice_ordine, $data_ordine, $email_compratore, $email_venditore, $tipo_spedizione, $dettagli_ordine) {
            $query = "INSERT INTO `ORDINE`(`Codice_ordine`, `Data_ordine`, `LettoCompratoreYN`, `LettoVenditoreYN`, `E_mail_compratore`, `E_mail_venditore`, `Tipo_spedizione`) VALUES (?,?,0,0,?,?,?)";
            
            $success = 1;
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $codice_ordine, $data_ordine, $email_compratore, $email_venditore, $tipo_spedizione);
            $success = $stmt->execute();
            if ($success) {
                foreach($dettagli_ordine as $dettaglio) {
                    if ($success) {
                        $success = addOrderDetails($dettaglio);
                    } else {
                        break;
                    }
                }
            }
            
            return $success;
        }
        
        // Ritorna tutte le notifiche di un utente (notifiche)
        public function getAllNotifies($email) {
            $query = "SELECT * FROM `ORDINE` WHERE (E_mail_compratore = ? AND EliminatoCompratoreYN = 0) OR (E_mail_venditore = ? AND EliminatoVenditoreYN = 0) ORDER BY Data_ordine DESC ";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $email, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Segna notifica come visualizzata (notifiche)
        public function updateNotify($codice_ordine, $is_client) {
            if ($is_client) {
                $query = "UPDATE `ORDINE` SET `LettoCompratoreYN`=1 WHERE Codice_ordine = ?";
            } else {
                $query = "UPDATE `ORDINE` SET `LettoVenditoreYN`=1 WHERE Codice_ordine = ?";
            }
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $codice_ordine);
            return $stmt->execute();
        }

        // Elimina notifica (notifiche)
        public function deleteNotify($codice_ordine, $is_client) {
            if ($is_client) {
                $query = "UPDATE `ORDINE` SET `EliminatoCompratoreYN`=1 WHERE Codice_ordine = ?";
            } else {
                $query = "UPDATE `ORDINE` SET `EliminatoVenditoreYN`=1 WHERE Codice_ordine = ?";
            }
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $codice_ordine);
            return $stmt->execute();
        }
        
        // Segna tutte le notifiche di un utente come visualizzate (notifiche)
        public function updateAllNotify($codice_ordine, $is_client) {
            if ($is_client) {
                $query = "UPDATE `ORDINE` SET `LettoCompratoreYN`=1";
            } else {
                $query = "UPDATE `ORDINE` SET `LettoVenditoreYN`=1";
            }
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $codice_ordine);
            return $stmt->execute();
        }
        
        // Ritorna tutti gli ordini di un utente (profilo compratore/venditore)
        public function getUserOrders($email, $is_client) {
            if ($is_client) {
                $query = "SELECT O.*, DO.* FROM ORDINE O INNER JOIN DETTAGLIO_ORDINE DO ON O.Codice_ordine = DO.Codice_ordine WHERE E_mail_compratore = ? ORDER BY O.Data_ordine DESC";
            } else {
                $query = "SELECT O.*, DO.* FROM ORDINE O INNER JOIN DETTAGLIO_ORDINE DO ON O.Codice_ordine = DO.Codice_ordine WHERE E_mail_venditore = ? ORDER BY O.Data_ordine DESC";
            }
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Ritorna un utente (login)
        public function getUser($email) {
            $query = "SELECT * FROM UTENTE_COMPRATORE WHERE E_mail = ?";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // Crea un nuovo account (login)
        public function createAccount($email, $password, $nome, $cognome) {
            $query = "INSERT INTO `UTENTE_COMPRATORE` (`E_mail`, `Password`, `Nome`, `Cognome`, `Indirizzo`) VALUES (?, ?, ?, ?, 'Via dell\'Università 50 47521 Cesena FC')";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssss", $email, $password, $nome, $cognome);
            return $stmt->execute();
        }
        
        // Modifica dati personali (profilo compratore)
        public function updateAccount($nome, $cognome, $email, $password, $indirizzo) {
            $query = "UPDATE UTENTE_COMPRATORE SET Nome = COALESCE(?, Nome), Cognome = COALESCE(?, Cognome), Indirizzo = COALESCE(?, Indirizzo), Password = COALESCE(?, Password) WHERE E_mail = ?";
            
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $nome, $cognome, $indirizzo, $password, $email);
            
            return $stmt->execute();
        }
    }
?>