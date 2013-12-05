<?
	class forms
	{
		static function select($values, $name, $title)
		{

			$str = "<h3>{$title}</h3>";
			$str .= "<select name='{$name}'>";
			foreach ($values as $item) {
				$selected = $_REQUEST[$name] == $title ? "selected='selected'" : '';
				$str .= "<option {$selected} value='{$item}'>{$item}</option>";
			}

			$str .= "</select>";
			return $str;
		}


		static function checkbox($values, $name, $title)
		{
			$str = "<h3>" . $title . "</h3>";
			foreach ($values as $items) {
				$sel = $_REQUEST[$name] == $items ? "checked = 'checked'" : '';
				$str .= "<div class='node'>
				<input {$sel} name = '{$name}[]' type='checkbox' value='{$items}'>{$items}</div>";

			}
			;

			return $str;
		}
	}
