<?php 

class Login {

    private $db;

    public function __construct($database){
        $this->db=$database;
    }     

    public function bestaatAl($gebruikersnaam){
        $query=$this->db->prepare(
            "SELECT COUNT(*) FROM accounts WHERE gebruikersnaam = ?"
        );

        $query->bindValue(1,$gebruikersnaam);

        try{
            $query->execute();
            $rows=$query->fetchColumn();
            if ($rows>0){
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }
	
	public function emailBestaatAl($mail){
        $query=$this->db->prepare(
            "SELECT COUNT(*) FROM accounts WHERE mail = ?"
        );

        $query->bindValue(1,$mail);

        try{
            $query->execute();
            $rows=$query->fetchColumn();
            if ($rows>0){
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function aanmelden($gebruikersnaam, $wachtwoord, $email, $dlm) {
        $query = $this->db->prepare(
            "INSERT INTO accounts (gebruikersnaam, ww, mail, dlm) VALUES (?,?,?,?)"
        );

        $query->bindValue(1,$gebruikersnaam);
        $query->bindValue(2,$wachtwoord);
        $query->bindValue(3,$email);
        $query->bindValue(4,$dlm);

        try{
            $query->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }    
    }
	
    public function login($gebruikersnaam, $password, $wwg) {
        $query = $this->db->prepare(
            "SELECT * FROM accounts WHERE gebruikersnaam=?;"
        );

        $query->bindValue(1,$gebruikersnaam);

        try{
            $query->execute();
            $rows=$query->fetchColumn();
            if ($rows>0){
               	if ($password==$wwg) {
                    return true;
                } else if ($password<>$wwg) {
                    return false;
                } else {
                    return false;
				}
            } else {
                return false;
			}		
        } catch(PDOException $e){
            die($e->getMessage());
        }

    }

}
?>
