<?php

/**
 * @author Stefan Meier
 * @copyright Stefan Meier (Université de Lausanne - FBM - SI)
 *
 * @version 2011.02.18
 *
 * @uses ErrorHandler
 * @example $db = new DbHelper();
 *          $return = $db->select("maRequeteSQL");
 *          $return = $db->select("maRequeteSQL", true, MYSQL_NUM);
 *
 *          $return = $db->insert("maRequeteSQL", false);
 *
 *
 * Cette classe gère de manière centrale tous les accès à la base de données.
 *
 */
include_once("helpers" . DIRECTORY_SEPARATOR . "ErrorHandler.php");

class Db {

    private $conn;
    private $host;
    private $db;
    private $user;
    private $password;

    /**
     * @method constructor
     * @access public
     * @param (String)$db : default = null
     * @param (String)$user : default = null
     * @param (String)$password : default = null
     * @param (String)$hots : default = null
     */
    function __construct($db = null, $user = null, $password = null, $host = null) {
        /*
         * Si le host, la db, le user, le password ne sont pas défini, on
         * regarde les variables de session.
         */
        if (isset($_SESSION['DB_HOST']) && $host == null) {
            $this->host = $_SESSION['DB_HOST'];
        } else {
            $this->host = $host;
        }
        if (isset($_SESSION['DB_NAME']) && $db == null) {
            $this->db = $_SESSION['DB_NAME'];
        } else {
            $this->db = $db;
        }
        if (isset($_SESSION['DB_USER']) && $user == null) {
            $this->user = $_SESSION['DB_USER'];
        } else {
            $this->user = $user;
        }
        if (isset($_SESSION['DB_PASSWORD']) && $password == null) {
            $this->password = $_SESSION['DB_PASSWORD'];
        } else {
            $this->password = $password;
        }
        // Aucune connexion n'est ouverte lors de l'instantiation
        $this->conn = null;
    }

    /**
     * Etablit la connexion
     *
     * @return boolean
     * @access private
     */
    private function open() {
        $conn = $this->conn;
        try {
            if ($conn == null) {
                $conn = mysql_connect($this->host, $this->user, $this->password);
                if (!$conn) {
                    throw new Exception(mysql_error());
                    $conn == null;
                } else {
                    $select_db = mysql_select_db($this->db);
                    if (!$select_db) {
                        throw new Exception(mysql_error());
                    }
                }
            }
        } catch (Exception $e) {
            ErrorHandler::Error($e);
        }
        $this->conn = $conn;
    }

    /**
     * Ferme la connexion
     *
     * @return void
     * @access private
     */
    private function close() {
        try {
            $can_close = mysql_close($this->conn);

            if (!$can_close) {
                throw new Exception(mysql_error());
            }

            $this->conn = null;
        } catch (Exception $e) {
            ErrorHandler::Error($e);
        }
    }

    /**
     *
     * Effectue un SELECT et envoie le résultat dans un tableau
     * associatif
     *
     * @param String $sql : rêquete SELECT
     * @param boolean $isLast : si true, la connexion est fermée après cette requête)
     * @param $returnType : MYSQL_ASSOC, MYSQL_NUM, MYSQL_BOTH
     * @return array Or false
     */
    public function select($sql, $isLast = true, $returnType = MYSQL_ASSOC) {
        $return = false;
        $this->open();
        if (null != $this->conn) {

            try {
                mysql_query("SET NAMES 'utf8'");

                $result = mysql_query($sql);
                if (!$result) {
                    throw new Exception(mysql_error());
                } else {
                    $return = array();
                    $r = mysql_fetch_array($result, $returnType);
                    while ($r) {
                        $return[] = $r;
                        $r = mysql_fetch_array($result, $returnType);
                    }
                    $free = mysql_free_result($result);
                    if (!$free) {
                        throw new Exception(mysql_error());
                    }
                }
            } catch (Exception $e) {
                ErrorHandler::Error($e);
            }



            if ($isLast) {
                $this->close();
            }
        }

        return $return;
    }

    /**
     * @param $sql : requête UPDATE, INSERT, DELETE
     * @param $isLast : si true, la connexion se ferme après l'exécution de la requête
     */
    private function dml($sql, $isLast) {
        $return = true;
        $this->open();
        if (null != $this->conn) {
            try {
                mysql_query("SET NAMES 'utf8'");
                $return = mysql_query($sql);

                if (!$return) {
                    throw new Exception(mysql_error());
                }
            } catch (Exception $e) {
                ErrorHandler::Error($e);
            }
            if ($isLast) {
                $this->close();
            }
        } else {
            $return = false;
        }
        return $return;
    }

    /**
     *
     * Effectue un INSERT
     *
     * @param String $sql
     * @param boolean $isLast
     * @return booelan
     */
    public function insert($sql, $isLast = true) {
        return $this->dml($sql, $isLast);
    }

    /**
     *
     * Effectue un UPDATE
     *
     * @param String $sql
     * @param boolean $isLast
     * @return booelan
     */
    public function update($sql, $isLast = true) {
        return $this->dml($sql, $isLast);
    }

    /**
     *
     * Effectue un DELETE
     *
     * @param String $sql
     * @param boolean $isLast
     * @return booelan
     */
    public function delete($sql, $isLast = true) {
        return $this->dml($sql, $isLast);
    }

}

?>