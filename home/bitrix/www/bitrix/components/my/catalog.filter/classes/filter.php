<?
	class filter
	{
		static function GetValues($description)
		{
			global $DB;
			$sql = "SELECT
		  prop.VALUE
		FROM
		  `b_iblock_element_property` AS prop
		WHERE prop.`IBLOCK_ELEMENT_ID` IN
		  (SELECT
		    el.`ID`
		  FROM
		    `b_iblock_element` AS el
		  WHERE el.`IBLOCK_SECTION_ID` = 1398)
		  AND prop.`DESCRIPTION` = '{$description}'
		  GROUP BY prop.`VALUE`";
			$res = $DB->Query($sql);
			while ($tep = $res->Fetch()) {
				$result[] = $tep['VALUE'];
			}
			return $result;
		}

		static function GetHTMLForm($description, $values, $name,$types)
		{
			if (($config = $types[$description]['TYPE']) != '' ) {
				if(method_exists('forms',$config)){
					return forms::$config($values, $name, $description,$types[$description]['ED_IZM']);
				}
			}
			else {
				return null;
			}
			;

		}

	}
