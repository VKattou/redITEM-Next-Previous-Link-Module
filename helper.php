<?php

/**
 * Helper for mod_reditem_next_prev_link
 *
 * @since  1.0
 */
class ModReditemNextPrevLinkHelper
{
	/**
	 * Find the surrounding items
	 *
	 * @param   int     $itemid    ID of the current item
	 * @param   int     $category  Category to sort
	 * @param   string  $sort      Column to sort after
	 *
	 * @return  string
	 */
	public static function getItems($itemid, $category, $sort)
	{
		// Query to find previous row
		$db = JFactory::getDbo();
		$q1 = $db->getQuery(true)
		->select('a.id')
		->from($db->qn('#__reditem_items', 'a'))
		->join('INNER', $db->qn('#__reditem_item_category_xref', 'b') . ' ON (' . $db->qn('a.id') . '=' . $db->qn('b.item_id') . ')')
		->where('b.category_id=' . $db->q($category))
		->where('id <' . $db->q($itemid))
		->where('published = 1')
		->order($db->qn($sort) . ' DESC')
		->setLimit('1');

		// Query to find next row
		$q2 = clone $q1;
		$q2->clear('where')
		->clear('order')
		->where('b.category_id=' . $db->q($category))
		->where('id >' . $db->q($itemid))
		->where('published = 1')
		->order($db->qn($sort) . ' ASC');

		// Load results
		$prevRow = $db->setQuery($q1)->loadResult();
		$nextRow = $db->setQuery($q2)->loadResult();

		// If results were found, put them into an array and return it
		if (!empty($prevRow) || !empty($nextRow))
		{
			$results = array(
				'prev' => $prevRow,
				'next' => $nextRow,
			);

			return $results;
		}
	}
}
