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

		static function SectionID_ByXML_ID($xml_id)
		{
			self::inc();
			$result = CIBlockSection::GetList(null, array('XML_ID' => $xml_id))
					->Fetch();
			return $result['ID'];
		}

		static function TovarAdd($array, $file_name)
		{
			self::inc();
			$razdel_xml_id = preg_replace("/([0-9]+)_([0-9]+)\.php/", "$1", $file_name);
			$tovar_xml_id  = preg_replace("/([0-9]+)_([0-9]+)\.php/", "$2", $file_name);
			$el            = new CIBlockElement();
			$SECTION_ID    = self::SectionID_ByXML_ID($razdel_xml_id);
			foreach ($array['PROPERTIES']['VALUES'] as $key => $vol) {
				$PROP['XML_PROP'][] = array(
					'VALUE' => $vol,
					'DESCRIPTION' => $array['PROPERTIES']['DESCRIPTIONS'][$key]
				);
			}
			$PROP['PRICE'] = $array['PRICE'];
			$img_name      = $razdel_xml_id . "_" . $tovar_xml_id;

			$photo = $array['PHOTO']['BASE_IMG'] ? "http://www.entero.ru" . $array['PHOTO']['BASE_IMG'] : $array['PHOTOS'] != 'http://www.entero.ru/photos/xxxl/' ? $array['PHOTOS'] : "";
			$picture = CFile::MakeFileArray($photo);
			$picture['name'] = $picture['name'].".jpg";
			$fields = array(
				'XML_ID' => $tovar_xml_id,
				'IBLOCK_ID' => 14,
				'NAME' => $array['NAME'],
				'PROPERTY_VALUES' => $PROP,
				'IBLOCK_SECTION_ID' => $SECTION_ID,
				'DETAIL_PICTURE' => $picture
			);
			if ($id = $el->Add($fields)) {
				return $id;
			}
			else {
				return $el->LAST_ERRORS;
			}
		}
	}
