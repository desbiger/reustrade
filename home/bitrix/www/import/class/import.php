<?
	class import
	{
		static $iblock_id = 14;

		static function inc()
		{
			CModule::IncludeModule('iblock');
		}

		static function loadSections()
		{
			$sections = unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/import/sections.php'));
			return $sections;
		}

		static function uploadSections()
		{
			$sections = self::loadSections();
			self::inc();
			$sect_obj = new CIBlockSection();
			foreach ($sections as $key => $section) {
				$fields  = array(
					'NAME' => $key,
					'IBLOCK_ID' => self::$iblock_id,
					'XML_ID' => $section['ID'],
				);
				$root_id = $sect_obj->add($fields);
				if (is_array($section['SUBSECTIONS'])) {
					foreach ($section['SUBSECTIONS'] as $subkey => $subsection) {
						$subfields = array(
							'IBLOCK_SECTION_ID' => $root_id,
							'NAME' => $subsection['NAME'],
							'IBLOCK_ID' => self::$iblock_id,
							'XML_ID' => $subsection['ID'],
						);
						$sect_obj->add($subfields);
					}
				}

			}
		}
	}
