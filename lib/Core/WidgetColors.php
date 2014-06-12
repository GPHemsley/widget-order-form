<?php

namespace Core;

class WidgetColors
{
	public $widget_colors = array();

	public function getWidgetColors()
	{
		global $Database;

		$sql = 'SELECT widget_color_id, widget_color_name
			FROM ' . DB_TABLE_WIDGET_COLORS . '
			ORDER BY widget_color_name ASC';

		foreach ($Database->query($sql) as $row) {
			$this->widget_colors[$row['widget_color_id']] = $row['widget_color_name'];
		}

		return $this->widget_colors;
	}

	public function getWidgetColorNameById($widget_color_id)
	{
		global $Database;

		$sql = 'SELECT widget_color_name
			FROM ' . DB_TABLE_WIDGET_COLORS . '
			WHERE widget_color_id = :widget_color_id';

		$stmt = $Database->prepare($sql);

		$stmt->bindParam(':widget_color_id', $widget_color_id, \PDO::PARAM_INT);

		if ($stmt->execute()) {
			$result = $stmt->fetch();

			return $result['widget_color_name'];
		} else {
			throw new \Exception('Could not get widget color name.');
		}
	}
}

