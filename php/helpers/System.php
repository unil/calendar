<?php

/**
 * Description of System
 *
 * @author smeier
 */
class System {

	private static function checkAttr($attr, $group, $aai_groups) {

		$ret = false;
		
		for ($i = 0; $i < count($group) && !$ret; $i++) {
			if (in_array($group[$i], $aai_groups)) {
				$ret = true;
			}
		}

		return $ret;
	}

	public static function auth($acl) {

		$auth = array("read" => false, "write" => false, "overwrite" => false, "admin" => false);

		if (in_array("*", $acl["read"])) {
			$auth["read"] = true;
		}
		if (isset($_SERVER['HTTP_SHIB_EP_AFFILIATION']) && isset($_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'])) {
			##On récupère les groupes UNIL et on en fait un array
			$aai_groups = explode(";", $_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF']);
			$isDenied = in_array($_SERVER['HTTP_SHIB_EP_AFFILIATION'], $acl["denyShibAttrib"]);

			##si un des groupes de ADMIN_GROUPS est contenu dans les attributs AAI, on est admin

			if (!$auth["read"]) {
				$auth["read"] = self::checkAttr("read", $acl["read"], $aai_groups);
			}
			
			if (!$auth["overwrite"]) {
				$auth["overwrite"] = self::checkAttr("overwrite", $acl["overwrite"], $aai_groups) && !$isDenied;
				$auth["write"] = $auth["overwrite"];
			}
			if (!$auth["write"]) {
				$auth["write"] = self::checkAttr("write", $acl["write"], $aai_groups);
			}

			if (!$auth["admin"]) {
				$auth["admin"] = self::checkAttr("admin", $acl["admin"], $aai_groups);
			}

		}

		return $auth;
	}

}

?>
