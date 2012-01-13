<?php

/**
 * Description of System
 *
 * @author smeier
 */
class System {

	private static function checkAttr($attr, $group, $aai_groups) {

		for ($i = 0; $i <count($acl[$attr]) && $acl[$attr] != true; $i++) {
			if (in_array($group, $aai_groups)) {
				$auth[$attr] = true;
			}
		}

		return $auth[$attr];
	}

	public static function auth($acl) {

		$auth = array("read" => false, "write" => false, "overwrite" => false, "admin" => false);

		if ($acl["read"] == "*") {
			$auth["read"] = true;
		}
		if (isset($_SERVER['HTTP_SHIB_EP_AFFILIATION']) && isset($_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'])) {
				
			$auth["read"] = $auth["read"] && !in_array($_SERVER['HTTP_SHIB_EP_AFFILIATION'], $acl["denyShibAttr"]);

			##On récupère les groupes UNIL et on en fait un array
			$aai_groups = explode(";", $_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF']);

			##si un des groupes de ADMIN_GROUPS est contenu dans les attributs AAI, on est admin

			if (!$auth["read"]) {
				checkAttrib("read", $acl["read"], $aai_groups);
			}
			if (!$auth["write"]) {
				checkAttrib("write", $acl["write"], $aai_groups);
			}
			if (!$auth["overwrite"]) {
				checkAttrib("overwrite", $acl["overwrite"], $aai_groups);
			}
			if (!$auth["admin"]) {
				checkAttrib("admin", $acl["admin"], $aai_groups);
			}

		}

		return $auth;
	}

}

?>
