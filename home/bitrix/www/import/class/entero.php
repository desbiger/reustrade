<?
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	require_once(ROOT . "/include/simple_html_dom.php");

	class entero
	{
		static function ListSections(){
			$folder = scandir($_SERVER['DOCUMENT_ROOT']."/import/items/");
			return $folder;
		}
		static function ListTovars(){
			$folder = scandir($_SERVER['DOCUMENT_ROOT']."/import/tovars/");
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
				$description = explode("<span>",$names->innertext);
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
