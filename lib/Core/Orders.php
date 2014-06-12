<?php

namespace Core;

class Orders
{
	public $orders = array();

	public function addOrder($quantity, $widget_type, $widget_color, $date_needed = NULL)
	{
		global $Database;

		// The date needed must be at least one week from now.
		if (is_null($date_needed)) {
			$date_needed = strtotime('+1 week');
		}

		$sql = 'INSERT INTO ' . DB_TABLE_ORDERS . ' (widget_quantity, widget_type_id, widget_color_id, date_needed)
			VALUES (:widget_quantity, :widget_type_id, :widget_color_id, :date_needed)';

		$stmt = $Database->prepare($sql);

		$stmt->bindParam(':widget_quantity', $quantity, \PDO::PARAM_INT);
		$stmt->bindParam(':widget_type_id', $widget_type, \PDO::PARAM_INT);
		$stmt->bindParam(':widget_color_id', $widget_color, \PDO::PARAM_INT);
		$stmt->bindParam(':date_needed', $date_needed, \PDO::PARAM_INT);

		if ($stmt->execute()) {
			return $Database->lastInsertId();
		} else {
			throw new \Exception('Could not add order.');
		}
	}
}

