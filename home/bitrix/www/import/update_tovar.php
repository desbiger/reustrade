<? require_once($_SERVER["DOCUMENT_ROOT"] . "/import/class/import.php"); ?>
<? require_once($_SERVER["DOCUMENT_ROOT"] . "/import/class/entero.php"); ?>
<?
ini_set('allow_url_fopen','1');
$sections = unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/import/sections.php"));
foreach ($sections as $vol) {
	if (count($vol['SUBSECTIONS']) > 0) {
		foreach ($vol['SUBSECTIONS'] as $razdel) {
			$razdel_id = preg_replace("/\/list\/([0-9]+)/", "$1", $razdel['LINK']);
			if (count($result = entero::GetItems($razdel_id)) > 0) {
				foreach ($result as $key => $item) {
					set_time_limit(0);
					if ($key) {
						$item_id     = preg_replace("/\/item\/([0-9]+)/", "$1", $item['lINK']);
						$tovar_array = entero::GetItem($item['lINK']);
						?>gbvmnj       
						<pre><?print_r($tovar_array)?></pre>
						<?
						file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/import/tovars/{$razdel_id}_{$item_id}.php", serialize($tovar_array));
					}
				}
			}

		}
	}
}


?>
