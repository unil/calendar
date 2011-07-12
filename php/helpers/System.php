<?php

/**
 * Description of System
 *
 * @author smeier
 */
class System {

	
    public static function authLevel() {

        $authLevel = 0;

        if (isset($_SESSION['ADMIN']) && isset($_SESSION['SUPER_ADMIN']) && isset($_SESSION['ACCEPT_STUDENTS'])) {
            $adminGroups = explode(";", $_SESSION['ADMIN']);
            $superAdminGroups = explode(";", $_SESSION['SUPER_ADMIN']);
            $acceptStudents = $_SESSION['ACCEPT_STUDENTS'];

            if (isset($_SERVER['HTTP_SHIB_EP_AFFILIATION']) && isset($_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'])) {


                if (!(isset($_SERVER['HTTP_SHIB_EP_AFFILIATION']) == "student" && !$acceptStudents)) {


                    ##On récupère les groupes UNIL et on en fait un array
                    $aai_groups = explode(";", $_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF']);
                    #$aai_groups = preg_split("[/*]", $_SERVER['HTTP_SHIB_EP_ENTITLEMENT, -1, PREG_SPLIT_NO_EMPTY);
                    ##si un des groupes de ADMIN_GROUPS est contenu dans les attributs AAI, on est admin

                    foreach ($superAdminGroups as $group) {
                        if (in_array($group, $aai_groups)) {
                            $authLevel = 2;
                        }
                    }

                    if ($authLevel < 2) {
                        foreach ($adminGroups as $group) {

                            if (in_array($group, $aai_groups)) {
                                $authLevel = 1;
                            }
                        }
                    }
                }
            }
        }

        return 2;
    }

}

?>
