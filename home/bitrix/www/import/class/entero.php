<?
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	require_once(ROOT . "/include/simple_html_dom.php");

	class entero
	{
		static function ListSections()
		{
			$folder = scandir($_SERVER['DOCUMENT_ROOT'] . "/import/items/");
			return $folder;
		}

		static function ListTovars()
		{
			$folder = scandir($_SERVER['DOCUMENT_ROOT'] . "/import/tovars/");
			return $folder;
		}

		/**
		 * @param $id
		 * @return array
		 */
		static function GetItem($id)
		{
			$result = array();
			echo $url = "http://www.entero.ru{$id}";
			$htmldom = file_get_html($url);


			foreach ($htmldom->find('table.ch td.name') as $names) {
				$description            = explode("<span>", $names->innertext);
				$prop['DESCRIPTIONS'][] = $description[1];
			}
			foreach ($htmldom->find('table.ch tr td.value') as $values) {
				$prop['VALUES'][] = $values->plaintext;
			}


			$img      = $htmldom->find('div.nozoom img', 0);
			$name     = $htmldom->find('h1.navi', 0)->plaintext;
			$price    = $htmldom->find('div.num span', 0)->plaintext;
			$opisanie = $htmldom->find('div.htmlcontent', 0)->plaintext;

			$big_img = $htmldom->find("div.zoomable", 0);


			$photo  = array(
				'BASE_IMG' => $img->src,
				'IMG_ALT' => $img->alt
			);
			$result = array(
				'ID' => preg_replace("/\/item\/([0-9]+)/", "$1", $id),
				'OPISANIE' => str_replace("Описание", "", $opisanie),
				'NAME' => $name,
				'PHOTO' => $photo,
				'PHOTOS' => "http://www.entero.ru/photos/xxxl/" . $big_img->id,
				'PRICE' => $price,
				'PROPERTIES' => $prop,
			);

			//			unset($htmldom);
			return $result;
		}


		static function GetItemReg($id)
		{
			echo $url = "http://www.entero.ru{$id}";
			$id   = preg_replace("|/item/([0-9]+)|is", "$1", $id);
			$page = str_replace(array(
				"\r",
				"\n",
				"&nbsp;"
			), array(
				"",
				"",
				" "
			), file_get_contents($url));

			preg_match_all("/<div[^>]+zoomable[^>]+id=([0-9]+)[^>]*>/isu", $page, $photos);
			preg_match_all("|<td[^>]+value[^>]*>([^>]+)<\/td>|isu", $page, $values);
			preg_match_all("|<[^>]+><span>([^>]+)<span><\/[^>]+>|isu", $page, $names);
			preg_match_all("|<h1[^>]+navi[^>]*>([^>]+)<\/h1>|isu", $page, $title);
			preg_match_all("|<img[^>]+(\/photos\/l\/[0-9]+)[^>]*>|isu", $page, $photo2);
			preg_match_all("|<span>([^>]+)<\/span>|isu", $page, $price);
			preg_match_all("|>Торговая марка ([^>]+)<|isu", $page, $brend);
			$page                        = '';
			$properties                  = array(
				'DESCRIPTIONS' => $names[1],
				'VALUES' => $values[1],
			);
			$properties['DESCRIPTIONS'][] = 'Бренд';
			$properties['VALUES'][]      = $brend[1][0];
			return array(
				'ID' => $id,
				'NAME' => $title[1][0],
				'PRICE' => $price[1][0],
				'BREND' => $brend[1][0],
				'PROPERTIES' => $properties,
				'PHOTO' => array(
					'BASE_IMG' => $photo2[1][0],
				),
				'PHOTOS' => "http://www.entero.ru/photos/xxxl/" . $photos[1][0]
			);
		}

		/**
		 * @param $section_id
		 * @return array
		 */
		static function GetItems($section_id)
		{
			$url     = "http://www.entero.ru/list/{$section_id}";
			$htmldom = new simple_html_dom();
			$htmldom->load_file($url);
			$count = 0;
			foreach ($htmldom->find('div.numpages') as $pages) {
				$count = count($pages->children());
			}
			if ($count == 0) {
				foreach ($htmldom->find('div.m a') as $hrefs) {
					$result[] = array(
						'NAME' => $hrefs->plaintext,
						'lINK' => $hrefs->href
					);
				}

			}
			else {
				$i = 0;
				while ($i < $count) {
					$i++;
					$htmldom->clear();
					$page_url = $url . "?p={$i}";
					$htmldom->load_file($page_url);
					foreach ($htmldom->find('div.m a') as $hrefs) {
						$result[] = array(
							'NAME' => $hrefs->plaintext,
							'lINK' => $hrefs->href
						);
					}
				}
			}
			if (count($result) > 0) {
				//				file_put_contents(ROOT . "/import/items/{$section_id}.php", serialize($result));
			}
			//			unset($htmldom);
			return $result;

		}

		static function GetItemsFromOnePage($url)
		{
			$res  = '';
			$html = file_get_contents("http://www.entero.ru" . $url);
			preg_match_all("|<a[^>]+(\/item\/[0-9]+)[^>]+title=\"Подробное описание\">|ius", $html, $res);
			foreach ($res[1] as $v) {
				$result[] = array(
					'lINK' => $v
				);
			}
			return $result;
		}

		static function add_to_array($array1, $array2)
		{
			foreach ($array2 as $vol) {
				$array1[] = $vol;
			}
			return $array1;

		}

		static function GetItemsReg($section_id)
		{
			$result  = array();
			$url     = "http://www.entero.ru/list/{$section_id}";
			$htmldom = str_replace(array(
				"\n",
				"&nbsp;",
				"\r"
			), array(
				'',
				' ',
				''
			), file_get_contents($url));

			preg_match_all("|<a[^>]+(\/list\/[0-9]+\?p\=[0-9]+)>|", $htmldom, $pages);
			$links  = self::GetItemsFromOnePage('/list/' . $section_id);
			$result = $links;
			if (count($pages[1]) > 0) {
				foreach ($pages[1] as $next_url) {
					$links  = self::GetItemsFromOnePage($next_url);
					$result = array_merge($result, $links);
				}
			}
			return $result;
		}

		/**
		 * @param $url
		 */
		static function redirect($url)
		{

			echo "	<script type = 'text/javascript'>
					document.location.href = '{$url}';
				</script>";
		}
	}
