<?php

define('ROOT', './');

require ROOT . 'inc/inc.main.php';

$widget_quantity = (isset($_POST['quantity']) && !empty($_POST['quantity'])) ? (int) $_POST['quantity'] : 1;
$widget_type = (isset($_POST['widget_type']) && !empty($_POST['widget_type'])) ? (int) $_POST['widget_type'] : NULL;
$widget_color = (isset($_POST['widget_color']) && !empty($_POST['widget_color'])) ? (int) $_POST['widget_color'] : NULL;

$date_requested_parts = array(
	'month' => (isset($_POST['date_needed']['month']) && !empty($_POST['date_needed']['month'])) ? (int) $_POST['date_needed']['month'] : (int) date('n'),
	'day' => (isset($_POST['date_needed']['day']) && !empty($_POST['date_needed']['day'])) ? (int) $_POST['date_needed']['day'] : (int) date('j'),
	'year' => (isset($_POST['date_needed']['year']) && !empty($_POST['date_needed']['year'])) ? (int) $_POST['date_needed']['year'] : (int) date('Y'),
);
$date_requested = mktime(0, 0, 0, $date_requested_parts['month'], $date_requested_parts['day'], $date_requested_parts['year']);
$next_available_date = strtotime('+1 week');
$date_needed = ($date_requested < $next_available_date) ? $next_available_date : $date_requested;
$date_needed_parts = array(
	'month' => (int) date('n', $date_needed),
	'day' => (int) date('j', $date_needed),
	'year' => (int) date('Y', $date_needed),
);

if (isset($_POST['submit'])) {
	$order_id = $Orders->addOrder($widget_quantity, $widget_type, $widget_color, $date_needed);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Widget Order Form</title>

	<style type="text/css">
		header, main, footer {
			width: 80vw;
			margin: auto;
		}

		header, footer {
			text-align: center;
		}

		dt {
			font-weight: bolder;
		}

		dd + dt {
			margin-top: 1em;
		}
	</style>
</head>
<body>
	<header>
		<h1>Widget Order Form</h1>
	</header>
	<main>
<?php

if (isset($order_id)) {
	printf("\t\t" . '<div id="confirmation"><p>Your order of <b>%d %s %s widget(s)</b> has been placed successfully and will be fulfilled by <b>%s</b>. Your order ID number is: <b>%d</b>.</p></div>' . "\n", $widget_quantity, $WidgetColors->getWidgetColorNameById($widget_color), $WidgetTypes->getWidgetTypeNameById($widget_type), date('F j, Y', $date_needed), $order_id);
}

?>
		<form method="post">
			<dl>
				<dt><label for="quantity">Quantity</label></dt>
				<dd><input type="number" id="quantity" name="quantity" min="1" step="1" value="<?= $widget_quantity ?>" required /></dd>

				<dt><label for="widget_type">Type</label></dt>
				<dd>
					<select id="widget_type" name="widget_type" required>
						<option value="">&nbsp;</option>
<?php

foreach ($WidgetTypes->getWidgetTypes() as $widget_type_id => $widget_type_name) {
	$widget_type_selected = ($widget_type_id === $widget_type) ? ' selected' : '';

	printf("\t\t\t\t\t\t" . '<option value="%d"%s>%s</option>' . "\n", $widget_type_id, $widget_type_selected, $widget_type_name);
}

?>
					</select>
				</dd>

				<dt><label for="widget_color">Color</label></dt>
				<dd>
					<select id="widget_color" name="widget_color" required>
						<option value="">&nbsp;</option>
<?php

foreach ($WidgetColors->getWidgetColors() as $widget_color_id => $widget_color_name) {
	$widget_color_selected = ($widget_color_id === $widget_color) ? ' selected' : '';

	printf("\t\t\t\t\t\t" . '<option value="%d"%s>%s</option>' . "\n", $widget_color_id, $widget_color_selected, $widget_color_name);
}

?>
					</select>
				</dd>

				<dt><label for="date_needed[month] date_needed[day] date_needed[year]">Date Needed By</label></dt>
				<dd>
					<select id="date_needed[month]" name="date_needed[month]">
<?php

for ($month = 1; $month <= 12; $month++) {
	$month_selected = ($month === $date_needed_parts['month']) ? ' selected' : '';

	printf("\t\t\t\t\t\t" . '<option value="%d"%s>%s</option>' . "\n", $month, $month_selected, date('F', mktime(0, 0, 0, $month)));
}

?>
					</select>
					<select id="date_needed[day]" name="date_needed[day]">
<?php

for ($day = 1; $day <= 31; $day++) {
	$day_selected = ($day === $date_needed_parts['day']) ? ' selected' : '';

	printf("\t\t\t\t\t\t" . '<option value="%d"%s>%d</option>' . "\n", $day, $day_selected, $day);
}

?>
					</select>
					<input type="number" id="date_needed[year]" name="date_needed[year]" min="<?= date('Y') ?>" step="1" value="<?= $date_needed_parts['year'] ?>" />
				</dd>
			</dl>

			<input type="submit" id="submit" name="submit" value="Submit" />
		</form>
	</main>
	<footer>
		<small id="copyright">Copyright &copy; 2014<br /><b>Gordon P. Hemsley</b><br />on behalf of<br /><b>Kforce, Inc.</b><br />and<br /><b>Penn Medicine Academic Computing Services (PMACS) at the Perelman School of Medicine</b></small>
	</footer>
</body>
</html>
<?php

