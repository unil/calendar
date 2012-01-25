<?php

/**
 * Description of System
 * shib test for write only
 * if * returns true event if shib denied
 * @author smeier
 */
class System {

	private static function checkAttr($attr, $group, $aai_groups) {
		$ret = false;

		if (in_array("*", $group)) {
			$ret = true;
		}
		else {
			for ($i = 0; $i < count($group) && !$ret; $i++) {
				if (in_array($group[$i], $aai_groups)) {
					$ret = true;
				}
			}
		}

		return $ret;
	}

	public static function auth($acl) {

		$auth = array("read" => false, "write" => false, "overwrite" => false, "admin" => false);
		$aai_groups = array();
		$isDenied = false;

		if (isset($_SERVER['HTTP_SHIB_EP_AFFILIATION']) && isset($_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'])) {
			##On récupère les groupes UNIL et on en fait un array
			$aai_groups = explode(";", $_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF']);

			$isDenied = in_array($_SERVER['HTTP_SHIB_EP_AFFILIATION'], $acl["denyShibAttrib"]);
		}

		$auth["read"] = self::checkAttr("read", $acl["read"], $aai_groups);

		$auth["overwrite"] = !$isDenied && self::checkAttr("overwrite", $acl["overwrite"], $aai_groups);
		$auth["write"] = $auth["overwrite"];

		if (!$auth["write"]) {
			$auth["write"] = !$isDenied && self::checkAttr("write", $acl["write"], $aai_groups);
		}

		$auth["admin"] = self::checkAttr("admin", $acl["admin"], $aai_groups);

		return $auth;
	}
}

?>
