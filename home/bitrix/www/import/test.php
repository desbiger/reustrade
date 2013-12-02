<?
include_once($_SERVER['DOCUMENT_ROOT']."/include/simple_html_dom.php");

	function GetItems($section_id)
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
					'SECTION_EXT_ID' => $section_id,
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
						'SECTION_EXT_ID' => $section_id,
						'NAME' => $hrefs->plaintext,
						'lINK' => $hrefs->href
					);
				}
			}
		}
		if (count($result) > 0) {
//			file_put_contents(ROOT . "/import/items/{$section_id}.php", serialize($result));
		}
		return $result;
	}
$result = GetItems('337');
?>
<pre><?print_r($result)?></pre>