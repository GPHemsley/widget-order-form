<?php

namespace Core;

class WidgetTypes
{
	public $widget_types = array();

	public function getWidgetTypes()
	{
		global $Database;

		$sql = 'SELECT widget_type_id, widget_type_name
			FROM ' . DB_TABLE_WIDGET_TYPES . '
			ORDER BY widget_type_name ASC';

		foreach ($Database->query($sql) as $row) {
			$this->widget_types[$row['widget_type_id']] = $row['widget_type_name'];
		}

		return $this->widget_types;
	}

	public function getWidgetTypeNameById($widget_type_id)
	{
		global $Database;

		$sql = 'SELECT widget_type_name
			FROM ' . DB_TABLE_WIDGET_TYPES . '
			WHERE widget_type_id = :widget_type_id';

		$stmt = $Database->prepare($sql);

		$stmt->bindParam(':widget_type_id', $widget_type_id, \PDO::PARAM_INT);

		if ($stmt->execute()) {
			$result = $stmt->fetch();

			return $result['widget_type_name'];
		} else {
			throw new \Exception('Could not get widget type name.');
		}
	}
}

