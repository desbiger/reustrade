<?
	class forms
	{
		static function StringArrayASort($values)
		{
			$values_enum = array();
			foreach ($values as $vol) {
				$values_enum[] = (int)$vol;
			}
			asort($values_enum);
			foreach($values_enum as $vol){
				$result[] = $vol;
			}
			return $result;
		}

		static function select($values, $name, $title, $ed_izm = null)
		{

			$str = "<h3><span>{$title}</span></h3>";
			$str .= "<select name='{$name}'>";
			foreach ($values as $item) {
				$selected = $_REQUEST[$name] == $title ? "selected='selected'" : '';
				$str .= "<option {$selected} value='{$item}'>{$item}</option>";
			}

			$str .= "</select>";
			return $str;
		}

		static function interval($values, $name, $title, $ed_izm = null)
		{
			$values_enum = self::StringArrayASort($values);
			$min         = $values_enum[0];
			$max         = $values_enum[count($values_enum) - 1];
			$str         = "
			<h3><span>" . $title . "</span></h3>
			<script type='text/javascript'>
			$(function(){
			jQuery('#slider_" . $name . "').slider({
			    min: " . $min . ",
			    max: " . $max . ",
			    values: [" . $min . "," . $max . "],
			    range: true,
			    stop: function(event, ui) {
			            jQuery('input#minCost_" . $name . "').val(jQuery('#slider_" . $name . "').slider('values',0));
			            jQuery('input#maxCost_" . $name . "').val(jQuery('#slider_" . $name . "').slider('values',1));
			        },
			        slide: function(event, ui){
			            jQuery('input#minCost_" . $name . "').val(jQuery('#slider_" . $name . "').slider('values',0));
			            jQuery('input#maxCost_" . $name . "').val(jQuery('#slider_" . $name . "').slider('values',1));
			        }
			});
			});
			</script>


			";
			$str .= "
			<div class='formCost'>
			
			от<input type='text' id='minCost_" . $name . "' value='" . $min . "'/>
			до<input type='text' id='maxCost_" . $name . "' value='" . $max . "'/>" .$ed_izm."
			</div>
			<div class='sliderCont'>
			<div id='slider_" . $name . "'></div>
			</div>
			";
			return $str;

		}


		static function checkbox($values, $name, $title, $ed_izm = null)
		{
			$str = "<h3><span>" . $title . "</span></h3>";
			foreach ($values as $items) {
				$sel = $_REQUEST[$name] == $items ? "checked = 'checked'" : '';
				$str .= "<div class='node'>
				<input {$sel} name = '{$name}[]' type='checkbox' value='{$items}'>{$items}</div>";

			}
			;

			return $str;
		}
	}
